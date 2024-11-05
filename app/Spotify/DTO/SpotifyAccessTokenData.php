<?php

namespace App\Spotify\DTO;

class SpotifyAccessTokenData extends AbstractDto
{
    public string $access_token;
    public string $token_type;
    public int $expires_in;
}
