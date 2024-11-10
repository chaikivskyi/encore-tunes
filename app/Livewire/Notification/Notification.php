<?php

namespace App\Livewire\Notification;

use App\Notifications\Enums\NotificationTypeEnum;
use Livewire\Attributes\On;
use Livewire\Component;

class Notification extends Component
{
    public ?string $notification = null;
    public ?NotificationTypeEnum $type = null;

    #[On('newNotification')]
    public function updateNotification(string $notification, ?NotificationTypeEnum $type = null): void
    {
        $this->notification = $notification;
        $this->type = $type;
    }

    #[On('clearNotification')]
    public function clearNotification()
    {
        $this->notification = null;
        $this->type = null;
    }

    public function render()
    {
        return view('livewire.notification.notification');
    }

    public function getNotificationColor(): string
    {
        return match ($this->type) {
            NotificationTypeEnum::Error => 'red',
            NotificationTypeEnum::Success => 'green',
            default => 'sky',
        };
    }
}