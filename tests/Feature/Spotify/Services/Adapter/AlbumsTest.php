<?php

namespace Tests\Feature\Spotify\Services\Adapter;

use App\Spotify\DTO\TracksSearchData;
use App\Spotify\Services\Adapter\Albums;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AlbumsTest extends TestCase
{
    private Albums $albums;

    public function setUp(): void
    {
        parent::setUp();
        $this->albums = $this->app->make(Albums::class);
    }

    #[DataProvider('getAlbumTracksData')]
    public function testGetAlbumTracks(string $expectedResult, $albumId)
    {
        $response = $this->albums->getAlbumTracks($albumId);
        Cache::shouldReceive('remember')
            ->andReturn($response);

        $this->assertInstanceOf($expectedResult, $response);
    }

    public static function getAlbumTracksData()
    {
        return [
            [
                TracksSearchData::class,
                '6YB3lplyQ6HakPXbG91R9k'
            ]
        ];
    }
}
