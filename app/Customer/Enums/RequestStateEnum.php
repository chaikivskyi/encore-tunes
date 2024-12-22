<?php

namespace App\Customer\Enums;

enum RequestStateEnum: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
