<?php

namespace App\Customer\Providers;

use App\Customer\Contracts\AvailabilityRequestRepositoryInterface;
use App\Customer\Repositories\AvailabilityRequestRepository;
use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    public $singletons = [
        AvailabilityRequestRepositoryInterface::class => AvailabilityRequestRepository::class,
    ];
}
