<?php

namespace App\Spotify\DTO;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class TracksSearchData extends PaginationData
{
    #[DataCollectionOf(TracksData::class)]
    public DataCollection $items;
}
