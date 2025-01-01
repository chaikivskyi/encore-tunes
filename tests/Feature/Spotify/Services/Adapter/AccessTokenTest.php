<?php

namespace Feature\Spotify\Services\Adapter;

use App\Spotify\Services\Adapter\AccessToken;
use Tests\TestCase;

class AccessTokenTest extends TestCase
{
    private AccessToken $accessToken;

    public function setUp(): void
    {
        parent::setUp();
        $this->accessToken = $this->app->make(AccessToken::class);
    }

    public function testGet()
    {
        $accessToken = $this->accessToken->get();
        $this->assertIsString($accessToken->access_token);
        $this->assertEqualsIgnoringCase('Bearer', $accessToken->token_type);
        $this->assertIsInt($accessToken->expires_in);
    }
}
