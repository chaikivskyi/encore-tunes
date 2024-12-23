<?php

namespace App\Customer\Repositories;

use App\Customer\Enums\RequestStateEnum;
use App\Customer\Models\AvailabilityRequest;
use Illuminate\Support\Collection;

class AvailabilityRequestRepository
{
    public function create(array $data): AvailabilityRequest
    {
        return AvailabilityRequest::create($data);
    }

    public function getById(int $id): AvailabilityRequest
    {
        return AvailabilityRequest::find($id);
    }

    public function getActiveRequests(): Collection
    {
        return AvailabilityRequest::whereNot('state', RequestStateEnum::Rejected->value)
            ->whereDate('date_from', '>=', now()->toDateString())
            ->get();
    }
}
