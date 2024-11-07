<?php

namespace App\Spotify\Services\Adapter;

use App\Spotify\Exceptions\SpotifyApiException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

abstract class AbstractApi
{
    protected const API_URL = 'https://api.spotify.com/v1';

    private const CACHE_TTL = 86400;

    public function __construct(private AccessToken $accessToken)
    {
    }

    protected function getAccessToken(): string
    {
        return $this->accessToken->get()->access_token;
    }

    protected function handleError(string $message, Response $response)
    {
        Log::error($message, [
            'message' => $response->json('error')['message'],
            'code' => $response->status(),
        ]);

        throw new SpotifyApiException('Spotify API error');
    }

    protected function getCacheKey(string $entityName, string $id)
    {
        return sprintf(
            'spotify_%s_%s_%s',
            strtolower(class_basename(static::class)),
            $entityName,
            $id
        );
    }

    protected function getCacheTtl(): int
    {
        return self::CACHE_TTL;
    }
}
