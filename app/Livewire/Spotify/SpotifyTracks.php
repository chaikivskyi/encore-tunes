<?php

namespace App\Livewire\Spotify;

use App\Spotify\Settings\SpotifySettings;
use Livewire\Component;

class SpotifyTracks extends Component
{
    public array $tracks = [];

    public function mount(SpotifySettings $settings)
    {
        if (empty($settings->tracks)) {
            $this->skipRender();
        }

        $this->tracks = array_map(fn (array $record) => $record['track'], $settings->tracks ?: []);
    }

    public function render()
    {
        return view('livewire.spotify.spotify-tracks');
    }
}
