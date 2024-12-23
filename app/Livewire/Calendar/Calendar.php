<?php

namespace App\Livewire\Calendar;

use App\Customer\Enums\RequestStateEnum;
use App\Customer\Models\AvailabilityRequest;
use App\Customer\Repositories\AvailabilityRequestRepository;
use Livewire\Attributes\On;
use Livewire\Component;

class Calendar extends Component
{
    public array $events;

    protected AvailabilityRequestRepository $availabilityRequestRepository;

    public function mount(AvailabilityRequestRepository $availabilityRequestRepository)
    {
        $this->availabilityRequestRepository = $availabilityRequestRepository;
        $this->events = $this->getEvents();
    }

    #[On('availability-request-created')]
    public function eventAdded(array $params, AvailabilityRequestRepository $availabilityRequestRepository): void
    {
        $availabilityRequestId = $params['availabilityRequestId'];
        $availabilityRequest = $availabilityRequestRepository->getById($availabilityRequestId);
        $this->events[] = $this->availabilityRequestToArray($availabilityRequest);
    }

    public function getEvents(): array
    {
        $requests = $this->availabilityRequestRepository
            ->getActiveRequests();

        $events = [];

        foreach ($requests as $request) {
            $events[] = $this->availabilityRequestToArray($request);
        }

        return $events;
    }

    private function availabilityRequestToArray(AvailabilityRequest $availabilityRequest): array
    {
        return [
            'id' => $availabilityRequest->id,
            'title' => $this->getEventNameByState($availabilityRequest->state),
            'start' => $availabilityRequest->date_from,
            'end' => $availabilityRequest->date_to,
            'color' => $this->getColorByState($availabilityRequest->state),
        ];
    }

    private function getEventNameByState(string $state)
    {
        return match ($state) {
            RequestStateEnum::Pending->value => 'Pending Reservation',
            RequestStateEnum::Approved->value => 'Reserved',
            default => 'Undefined State'
        };
    }

    private function getColorByState(string $state)
    {
        return match ($state) {
            RequestStateEnum::Pending->value => '#3F83F880',
            RequestStateEnum::Approved->value => '#008000',
            default => '#FF5733'
        };
    }
}
