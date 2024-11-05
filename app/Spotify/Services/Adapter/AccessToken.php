<?php

namespace App\Spotify\Services\Adapter;

use App\Spotify\DTO\SpotifyAccessTokenData;
use App\Spotify\Exceptions\SpotifyApiException;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AccessToken
{
    private const API_URL = 'https://accounts.spotify.com/api';
    private const LOCK_STR = 'spotify_access_token';
    private const CACHE_KEY = 'spotify_access_token';

    public function get(): SpotifyAccessTokenData
    {
        $token = Cache::get(self::CACHE_KEY);

        if ($token) {
            return $token;
        }

        return $this->refreshTokenWithLock();
    }

    private function refreshTokenWithLock(): SpotifyAccessTokenData
    {
        $lock = Cache::lock(self::LOCK_STR);

        try {
            $lock->block(10);
            $cachedToken = Cache::get(self::CACHE_KEY);

            if ($cachedToken) {
                return $cachedToken;
            }

            return $this->fetchAndCacheToken();
        } catch (LockTimeoutException) {
            throw new SpotifyApiException('Could not acquire lock to refresh Spotify access token');
        } finally {
            $lock->release();
        }
    }

    private function fetchAndCacheToken(): SpotifyAccessTokenData
    {
        $response = Http::asForm()->post(self::API_URL . '/token', [
            'grant_type' => 'client_credentials',
            'client_id' => config('services.spotify.client_id'),
            'client_secret' => config('services.spotify.client_secret'),
        ]);

        if ($response->failed()) {
            Log::error('Spotify access token API request failed', [
                'message' => $response->json('error_description') ?? 'Unknown error',
                'code' => $response->status(),
            ]);
            throw new SpotifyApiException('Failed to obtain Spotify access token');
        }

        $data = SpotifyAccessTokenData::from($response->json());
        Cache::put(self::CACHE_KEY, $data, $data->expires_in);

        return $data;
    }
}
