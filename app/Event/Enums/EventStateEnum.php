<?php

namespace App\Event\Enums;

enum EventStateEnum: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
