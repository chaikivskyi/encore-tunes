<?php

namespace App\Spotify\Services\Adapter;

use App\Spotify\DTO\ArtistsItemData;
use Illuminate\Support\Facades\Http;

class Artists extends AbstractApi
{
    public function getArtist(string $artistId): ArtistsItemData
    {
        $response = Http::withToken($this->getAccessToken())
            ->get(self::API_URL . '/artists/' . $artistId);

        if ($response->successful()) {
            return ArtistsItemData::from($response->json());
        }

        $this->handleError('Spotify get artists error', $response);
    }
}
