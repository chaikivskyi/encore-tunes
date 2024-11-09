<?php

namespace App\Livewire\Message;

use Livewire\Attributes\On;
use Livewire\Component;

class Message extends Component
{
    public ?string $message = null;

    #[On('newMessage')]
    public function updateMessage(string $message)
    {
        $this->message = $message;
    }

    #[On('clearMessage')]
    public function clearMessage()
    {
        $this->message = null;
    }

    public function render()
    {
        return view('livewire.message.message');
    }
}
