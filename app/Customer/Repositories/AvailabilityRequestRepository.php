<?php

namespace App\Customer\Repositories;

use App\Customer\Models\AvailabilityRequest;

class AvailabilityRequestRepository
{
    public function create(array $data): AvailabilityRequest
    {
        return AvailabilityRequest::create($data);
    }
}
