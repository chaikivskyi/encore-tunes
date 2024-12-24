<?php

namespace App\Livewire\RequestAvailability;

use App\Customer\Repositories\AvailabilityRequestRepository;
use App\Notifications\Traits\NotificationDispatcherTrait;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Throwable;

class RequestAvailabilityForm extends Component
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

    public function mount()
    {
        if (Auth::check()) {
            $this->contact_data = Auth::user()->email;
        }
    }

    public function submit(AvailabilityRequestRepository $repository)
    {
        if (! Auth::check()) {
            abort(403);
        }

        try {
            $data = $this->validate();
            $lock = Cache::lock('availability_request', 10);

            if ($lock->block(5)) {
                $userId = Auth::id();
                $data['user_id'] = $userId;
                $request = $repository->create($data);
                $this->addSuccessMessage('Your request has been successfully submitted, and we will contact you as soon as possible.');
                $this->dispatch('close-modal', ['name' => 'requestAvailability']);
                $this->dispatch('availability-request-created', ['availabilityRequestId' => $request->id]);
            }
        } catch (ValidationException $e) {
            $errors = $e->errors();

            if (array_key_exists('date_to', $errors) || array_key_exists('date_from', $errors)) {
                $this->addErrorMessage('Something went wrong. Please refresh page and try again.');
            }

            throw $e;
        } catch (LockTimeoutException) {
            $this->addErrorMessage('System is busy. Please try again later in a few minutes.');
        } catch (Throwable $e) {
            $this->addErrorMessage('Something went wrong. Please try again later.');
        } finally {
            $lock->release();
        }
    }

    public function render()
    {
        return view('livewire.request-availability.request-availability-form');
    }
}
