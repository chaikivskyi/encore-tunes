<?php

namespace App\Notifications\Traits;

use App\Notifications\Enums\NotificationTypeEnum;

trait NotificationDispatcherTrait
{
    public function addSuccessMessage(string $message): void
    {
        $this->dispatch(
            'newNotification',
            trans($message),
            NotificationTypeEnum::Success
        );
    }

    public function addErrorMessage(string $message): void
    {
        $this->dispatch(
            'newNotification',
            trans($message),
            NotificationTypeEnum::Error
        );
    }
}
