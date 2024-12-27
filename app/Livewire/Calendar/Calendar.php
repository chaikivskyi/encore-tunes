<?php

namespace App\Livewire\Calendar;

use App\Event\Contracts\EventRepositoryInterface;
use App\Event\Enums\EventStateEnum;
use App\Event\Models\Event;
use App\Notifications\Traits\NotificationDispatcherTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Throwable;

class Calendar extends Component
{
    use NotificationDispatcherTrait;

    public ?int $userId;

    public array $events;

    public function mount(EventRepositoryInterface $eventRepository)
    {
        $this->userId = auth()->id();
        $this->events = $this->getEvents($eventRepository);
    }

    #[On('event-created')]
    public function eventAdded(array $params, EventRepositoryInterface $eventRepository): void
    {
        $eventId = $params['eventId'];
        $availabilityRequest = $eventRepository->getById($eventId);
        $this->events[] = $this->availabilityRequestToArray($availabilityRequest);
    }

    public function deleteEvent(int $eventId, EventRepositoryInterface $eventRepository): void
    {
        try {
            $event = $eventRepository->getById($eventId);
            $this->authorize('delete', $event);
            $eventRepository->delete($event);
            $this->addSuccessMessage('Availability request has been successfully deleted.');
            $this->events = array_filter($this->events, fn($event) => $event['id'] !== $eventId);
        } catch (AuthorizationException) {
            abort(403);
        } catch (Throwable $e) {
            Log::error('Error deleting event', ['exception' => $e]);
            $this->addErrorMessage('Something went wrong. Please try again later.');
        }
    }

    public function getEvents(EventRepositoryInterface $eventRepository): array
    {
        $requests = $eventRepository
            ->getActiveEvents();

        $events = [];

        foreach ($requests as $request) {
            $events[] = $this->availabilityRequestToArray($request);
        }

        return $events;
    }

    private function availabilityRequestToArray(Event $event): array
    {
        return [
            'id' => $event->id,
            'title' => $this->getEventNameByState($event->state),
            'start' => $event->date_from->toDateString(),
            'end' => $event->date_to->toDateString(),
            'color' => $this->getColorByState($event->state),
            'extendedProps' => [
                'user_id' => $event->user_id,
            ],
        ];
    }

    private function getEventNameByState(string $state)
    {
        return match ($state) {
            EventStateEnum::Pending->value => 'Pending Reservation',
            EventStateEnum::Approved->value => 'Reserved',
            default => 'Undefined State'
        };
    }

    private function getColorByState(string $state)
    {
        return match ($state) {
            EventStateEnum::Pending->value => '#3F83F880',
            EventStateEnum::Approved->value => '#008000',
            default => '#FF5733'
        };
    }
}
