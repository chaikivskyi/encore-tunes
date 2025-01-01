<?php

namespace Feature\Spotify;

use App\Livewire\Spotify\SpotifyTracks;
use App\Spotify\Settings\SpotifySettings;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class SpotifyTracksTest extends TestCase
{
    protected SpotifySettings $spotifySettings;

    protected function setUp(): void
    {
        parent::setUp();
        $this->spotifySettings = $this->createMock(SpotifySettings::class);
        $this->spotifySettings->tracks = [
            [
                'album' => '6YB3lplyQ6HakPXbG91R9k',
                'track' => '1dtbd1wevs3PdSHaSjJL9Z',
            ]
        ];
    }

    public function test_spotify_tracks_can_be_rendered()
    {
        Livewire::test(SpotifyTracks::class, ['settings' => $this->spotifySettings])
            ->assertSee('<iframe', false)
            ->assertSee('https://open.spotify.com/embed/track/1dtbd1wevs3PdSHaSjJL9Z');

        $response = Http::get('https://open.spotify.com/embed/track/1dtbd1wevs3PdSHaSjJL9Z');
        $this->assertTrue($response->successful());
    }
}
