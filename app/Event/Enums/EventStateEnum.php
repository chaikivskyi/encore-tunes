<?php

namespace App\Event\Enums;

enum EventStateEnum: string
{
    case Pending = 'pending';
    case Canceled = 'canceled';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
