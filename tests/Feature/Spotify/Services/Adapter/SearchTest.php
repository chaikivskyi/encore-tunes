<?php

namespace Feature\Spotify\Services\Adapter;

use App\Spotify\DTO\SpotifySearchData;
use App\Spotify\Enums\SpotifySearchTypeEnum;
use App\Spotify\Services\Adapter\Search;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SearchTest extends TestCase
{
    private Search $spotify;

    public function setUp(): void
    {
        parent::setUp();
        $this->spotify = $this->app->make(Search::class);
    }

    #[DataProvider('getSearchData')]
    public function testSearch(string $expectedResult, string $query, array $types, $limit)
    {
        $response = $this->spotify->search($query, $types, $limit);
        $this->assertInstanceOf( $expectedResult, $response);
    }

    public static function getSearchData()
    {
        return [
            [
                SpotifySearchData::class,
                'remaster',
                [SpotifySearchTypeEnum::Artist->value],
                1
            ]
        ];
    }
}
