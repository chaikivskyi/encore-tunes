<?php

namespace App\Spotify\DTO;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class TracksData extends AbstractDto
{
    #[DataCollectionOf(ArtistsItemData::class)]
    public DataCollection $artists;
    public array $available_markets;
    public int $disc_number;
    public int $duration_ms;
    public bool $explicit;
    public ExternalUrlsData $external_urls;
    public string $href;
    public string $id;
    public bool $is_playable;
    #[DataCollectionOf(LinkedFromData::class)]
    public ?DataCollection $linked_from = null;
    #[DataCollectionOf(RestrictionsData::class)]
    public ?DataCollection $restrictions = null;
    public string $name;
    public ?string $preview_url = null;
    public int $track_number;
    public string $type;
    public string $uri;
    public bool $is_local;
}
