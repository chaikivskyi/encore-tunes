<?php

namespace App\ContactMe\Settings;

use Spatie\LaravelSettings\Settings;

class ContactMeSettings extends Settings
{
    public ?string $email;

    public ?string $instagram;

    public ?string $telegram;

    public static function group(): string
    {
        return 'contact-me';
    }
}
