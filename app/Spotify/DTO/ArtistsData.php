<?php

namespace App\Spotify\DTO;

use Spatie\LaravelData\DataCollection;

class ArtistsData extends PaginationData
{
    /**
     * @var DataCollection<int, ArtistsItemData>
     */
    public DataCollection $items;
}
