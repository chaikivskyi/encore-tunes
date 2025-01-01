<?php

namespace Feature\Spotify\Services\Adapter;

use App\Spotify\DTO\AlbumsSearchData;
use App\Spotify\DTO\ArtistsItemData;
use App\Spotify\Services\Adapter\Artists;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ArtistsTest extends TestCase
{
    private Artists $artists;

    public function setUp(): void
    {
        parent::setUp();
        $this->artists = $this->app->make(Artists::class);
    }

    #[DataProvider('getArtistData')]
    public function testGetArtist(string $expectedResult, $artistId)
    {
        $response = $this->artists->getArtist($artistId);
        Cache::shouldReceive('remember')
            ->andReturn($response);
        $this->assertInstanceOf($expectedResult, $response);
    }

    #[DataProvider('getArtistAlbumsData')]
    public function testGetArtistAlbums(string $expectedResult, $artistId)
    {
        $response = $this->artists->getArtistAlbums($artistId);
        Cache::shouldReceive('remember')
            ->andReturn($response);
        $this->assertInstanceOf(AlbumsSearchData::class, $response);
    }

    public static function getArtistData()
    {
        return [
            [
                ArtistsItemData::class,
                '6DeaThUDwXs3WJccOgDGtP'
            ]
        ];
    }

    public static function getArtistAlbumsData()
    {
        return [
            [
                AlbumsSearchData::class,
                '6DeaThUDwXs3WJccOgDGtP'
            ]
        ];
    }

}
