<?php

namespace Tests\Integration\Spotify\Services\Adapter;

use App\Spotify\Services\Adapter\Search;
use Tests\TestCase;

class SpotifyTest extends TestCase
{
    private Search $spotify;

    public function setUp(): void
    {
        parent::setUp();
        $this->spotify = $this->app->make(Search::class);
    }

    public function testSearch()
    {
        $response = $this->spotify->search('remaster', ['artist'], 1);

        $this->assertNotNull($response->artists->items[0]->id);
        $this->assertNotNull($response->artists->items[0]->name);
        $this->assertNotNull($response->artists->items[0]->type);
        $this->assertNotNull($response->artists->items[0]->uri);
        $this->assertNotNull($response->artists->items[0]->href);
        $this->assertNotNull($response->artists->items[0]->external_urls);
        $this->assertNotNull($response->artists->items[0]->followers);
        $this->assertNotNull($response->artists->items[0]->genres);
        $this->assertNotNull($response->artists->items[0]->images);
        $this->assertNotNull($response->artists->items[0]->popularity);
    }
}
