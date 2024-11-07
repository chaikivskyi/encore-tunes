<?php

namespace App\Spotify\DTO;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class LinkedFromData extends AbstractDto
{
    public string $id;
    public string $href;
    public string $type;
    public string $uri;
    #[DataCollectionOf(ExternalUrlsData::class)]
    public DataCollection $external_urls;
}
