<?php

namespace App\Event\Policies;

use App\Event\Models\Event;
use App\User\Models\User;

class EventPolicy
{
    public function cancel( User $user, Event $event)
    {
        return $event->user_id === $user->id;
    }
}
