<?php

namespace App\Spotify\Services\Adapter;

use App\Spotify\Exceptions\SpotifyApiException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

abstract class AbstractApi
{
    protected const API_URL = 'https://api.spotify.com/v1';

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
}
