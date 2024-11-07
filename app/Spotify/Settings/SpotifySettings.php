<?php

namespace App\Spotify\Settings;

use Spatie\LaravelSettings\Settings;

class SpotifySettings extends Settings
{
    public ?string $artist;

    public ?array $tracks;

    public static function group(): string
    {
        return 'spotify';
    }
}
