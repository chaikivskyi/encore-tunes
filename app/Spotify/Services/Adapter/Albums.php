<?php

namespace App\Spotify\Services\Adapter;

use App\Spotify\DTO\TracksSearchData;
use Illuminate\Support\Facades\Http;

class Albums extends AbstractApi
{
    public function getAlbumTracks(string $albumId)
    {
        $response = Http::withToken($this->getAccessToken())
            ->withUrlParameters(['id' => $albumId])
            ->get(self::API_URL . '/albums/{id}/tracks');

        if ($response->successful()) {
            return TracksSearchData::from($response->json());
        }

        $this->handleError('Spotify get album tracks error', $response);
    }
}
