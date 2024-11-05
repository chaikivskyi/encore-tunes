<?php

namespace App\Spotify\DTO;

use Spatie\LaravelData\Data;

abstract class AbstractDto extends Data
{
    public function isReadOnly(): bool
    {
        return true;
    }
}
