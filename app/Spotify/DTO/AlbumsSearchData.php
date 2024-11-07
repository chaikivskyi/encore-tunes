<?php

namespace App\Spotify\DTO;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class AlbumsSearchData extends PaginationData
{
    #[DataCollectionOf(AlbumsData::class)]
    public DataCollection $items;
}
