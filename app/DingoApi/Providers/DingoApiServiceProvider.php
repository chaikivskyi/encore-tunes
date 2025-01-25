<?php

namespace App\DingoApi\Providers;

use Illuminate\Support\ServiceProvider;

class DingoApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app(\Dingo\Api\Auth\Auth::class)->extend('basic', function ($app) {
            return new \Dingo\Api\Auth\Provider\Basic($app['auth'], 'email');
        });
    }
}
