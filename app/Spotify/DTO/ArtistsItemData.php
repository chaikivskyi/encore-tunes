<?php

namespace App\Spotify\DTO;

use Spatie\LaravelData\DataCollection;

class ArtistsItemData extends AbstractDto
{
    public string $id;
    public string $name;
    public string $type;
    public string $uri;
    public ?string $href;
    public ExternalUrlsData $external_urls;
    public FollowersData $followers;
    public array $genres;
    /**
     * @var DataCollection<int, ImageData>
     */
    public DataCollection $images;
    public int $popularity;
}
