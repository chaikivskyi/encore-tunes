<?php

namespace App\Customer\Contracts;

use App\Customer\Models\AvailabilityRequest;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface AvailabilityRequestRepositoryInterface
{
    public function create(array $data): AvailabilityRequest;

    public function getById(int $id): AvailabilityRequest;

    public function getActiveRequests(): Collection;

    public function countRequestsBeetweenDates(Carbon $from, Carbon $to): int;
}
