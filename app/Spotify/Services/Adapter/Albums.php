<?php

namespace App\Spotify\Services\Adapter;

use App\Spotify\DTO\TracksSearchData;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Albums extends AbstractApi
{
    public function getAlbumTracks(string $albumId)
    {
        $cacheKey = $this->getCacheKey('tracks', $albumId);

        return Cache::remember($cacheKey, $this->getCacheTtl(), function () use ($albumId) {
            $response = Http::withToken($this->getAccessToken())
                ->withUrlParameters(['id' => $albumId])
                ->get(self::API_URL . '/albums/{id}/tracks');

            if ($response->successful()) {
                return TracksSearchData::from($response->json());
            }

            $this->handleError('Spotify get album tracks error', $response);
        });
    }
}
