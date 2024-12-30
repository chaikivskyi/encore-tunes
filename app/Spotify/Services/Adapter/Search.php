<?php

namespace App\Spotify\Services\Adapter;

use App\Spotify\DTO\SpotifySearchData;
use App\Spotify\Enums\SpotifySearchTypeEnum;
use Illuminate\Support\Facades\Http;

class Search extends AbstractApi
{
    private const SEARCH_LIMIT = 20;

    /**
     * @param string[] $type
     * @throws \App\Spotify\Exceptions\SpotifyApiException
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function search(string $query, array $type, int $limit = self::SEARCH_LIMIT, int $offset = 0): SpotifySearchData
    {
        $response = Http::withToken($this->getAccessToken())
            ->get(
                self::API_URL . '/search',
                [
                    'q' => $query,
                    'type' => implode(',', $type),
                    'limit' => $limit,
                    'offset' => $offset
                ]
            );

        if ($response->successful()) {
            return SpotifySearchData::from($response->json());
        }

        throw $this->handleError('Spotify search error', $response);
    }
}
