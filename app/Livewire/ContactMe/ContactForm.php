<?php

namespace App\Livewire\ContactMe;

use App\ContactMe\Mail\ContactMeMail;
use App\ContactMe\Settings\ContactMeSettings;
use App\Theme\Traits\NotificationDispatcherTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Throwable;

class ContactForm extends Component
{
    use NotificationDispatcherTrait;

    #[Validate('required|min:3')]
    public string $name;

    #[Validate('required|email')]
    public string $email;

    #[Validate('required|min:10')]
    public string $message;

    public function submit(ContactMeSettings $settings)
    {
        $this->validate();

        try {
            Mail::to($settings->email)->send(new ContactMeMail($this->name, $this->email, $this->message));
            $this->addSuccessMessage('Your message has been successfully submitted, and we will contact you as soon as possible.');
        } catch (Throwable $e) {
            Log::error('Contact form submit error: ', [
                'exception' => $e,
            ]);

            $this->addErrorMessage('Something went wrong. Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.contact-me.contact-form');
    }
}
