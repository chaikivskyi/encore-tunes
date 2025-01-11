<?php

namespace App\Theme\Enums;

enum NotificationTypeEnum: string
{
    case Error = 'error';
    case Success = 'success';
    case Info = 'info';
}
