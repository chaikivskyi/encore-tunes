<?php

namespace App\Event\Providers;

use App\Event\Contracts\EventRepositoryInterface;
use App\Event\Models\Event;
use App\Event\Policies\EventPolicy;
use App\Event\Repositories\EventRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public $singletons = [
        EventRepositoryInterface::class => EventRepository::class,
    ];

    public function boot(): void
    {
        Gate::policy(Event::class, EventPolicy::class);
    }
}
