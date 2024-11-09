<?php

namespace App\Livewire\ContactMe;

use App\ContactMe\Settings\ContactMeSettings;
use Livewire\Component;

class ContactInfo extends Component
{
    public ?string $email;
    public ?string $instagram;
    public ?string $telegram;

    public function mount(ContactMeSettings $settings)
    {
        $this->email = $settings->email;
        $this->instagram = $settings->instagram;
        $this->telegram = $settings->telegram;
    }

    public function render()
    {
        return view('livewire.contact-me.contact-info');
    }
}
