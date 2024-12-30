<?php

namespace App\Livewire\RequestAvailability;

use App\Event\Constants\LockKeys;
use App\Event\Contracts\EventRepositoryInterface;
use App\Notifications\Traits\NotificationDispatcherTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Psr\Log\LoggerInterface;
use Throwable;

class RequestAvailabilityForm extends Component
{
    use NotificationDispatcherTrait;

    #[Validate('required|string')]
    public string $contact_data;

    #[Validate('required|string')]
    public string $comment;

    #[Validate('required|date|after:yesterday')]
    public string $date_from;

    #[Validate('required|date|after:date_from')]
    public string $date_to;

    public function mount()
    {
        if (Auth::check()) {
            $this->contact_data = Auth::user()->email;
        }
    }

    public function submit(EventRepositoryInterface $repository, LoggerInterface $logger)
    {
        if (! Auth::check()) {
            abort(403);
        }

        try {
            $data = $this->validate();
            $lock = Cache::lock(LockKeys::EVENT_CREATE, 10);

            if ($lock->block(5)) {
                if ($repository->countActiveEventsBeetweenDates(new Carbon($data['date_from']), new Carbon($data['date_to'])) > 0) {
                    throw ValidationException::withMessages(['date_from' => 'Selected date is already booked.']);
                }

                $userId = Auth::id();
                $data['user_id'] = $userId;
                $event = $repository->create($data);
                $this->addSuccessMessage('Your request has been successfully submitted, and we will contact you as soon as possible.');
                $this->dispatch('close-modal', ['name' => 'requestAvailability']);
                $this->dispatch('event-created', ['eventId' => $event->id]);
            }
        } catch (ValidationException $e) {
            $errors = $e->errors();

            if (array_key_exists('date_to', $errors) || array_key_exists('date_from', $errors)) {
                $this->addErrorMessage('Please select valid dates. ' . $e->getMessage());
            }

            throw $e;
        } catch (LockTimeoutException) {
            $this->addErrorMessage('System is busy. Please try again later in a few minutes.');
        } catch (Throwable $e) {
            $logger->error('Request availability form submit error: ' . $e->getMessage());
            $this->addErrorMessage('Something went wrong. Please try again later.');
        } finally {
            if (isset($lock)) {
                $lock->release();
            }
        }
    }

    public function render()
    {
        return view('livewire.request-availability.request-availability-form');
    }
}
