<?php

namespace App\Spotify\DTO;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class AlbumsData extends AbstractDto
{
    public string $album_type;
    public int $total_tracks;
    public array $available_markets;
    public ExternalUrlsData $external_urls;
    public string $href;
    public string $id;
    #[DataCollectionOf(ImageData::class)]
    public DataCollection $images;
    public string $name;
    public string $release_date;
    #[DataCollectionOf(RestrictionsData::class)]
    public ?DataCollection $restrictions;
    #[DataCollectionOf(ArtistsItemData::class)]
    public DataCollection $artists;
    public ?string $label = null;
    public ?int $popularity = null;
}
