<?php

namespace App\Livewire\Calendar\Modal;

use App\Customer\Repositories\AvailabilityRequestRepository;
use App\Notifications\Traits\NotificationDispatcherTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Throwable;

class RequestAvailability extends Component
{
    use NotificationDispatcherTrait;

    #[Validate('required|string')]
    public string $contact_data;

    #[Validate('required|string')]
    public string $comment;

    #[Validate('required|date|after:today')]
    public string $date_from;

    #[Validate('nullable|date|after:date_from')]
    public string $date_to;

    public function submit(AvailabilityRequestRepository $repository)
    {
        try {
            $data = $this->validate();
            $userId = Auth::id();
            $data['user_id'] = $userId;
            $repository->create($data);
            $this->addSuccessMessage('Your request has been successfully submitted, and we will contact you as soon as possible.');
            $this->dispatch('close-modal', ['name' => 'requestAvailability']);
        } catch (ValidationException $e) {
            $errors = $e->errors();

            if (array_key_exists('date_to', $errors) || array_key_exists('date_from', $errors)) {
                $this->addErrorMessage('Something went wrong. Please refresh page and try again.');
            }

            throw $e;
        } catch (Throwable $e) {
            $this->addErrorMessage('Something went wrong. Please try again later.' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.calendar.modal.request-availability');
    }
}
