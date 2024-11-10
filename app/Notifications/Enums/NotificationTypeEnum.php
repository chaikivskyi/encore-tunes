<?php

namespace App\Notifications\Enums;

enum NotificationTypeEnum: string
{
    case Error = 'error';
    case Success = 'success';
    case Info = 'info';
}
