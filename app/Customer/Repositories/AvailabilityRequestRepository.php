<?php

namespace App\Customer\Repositories;

use App\Customer\Contracts\AvailabilityRequestRepositoryInterface;
use App\Customer\Enums\RequestStateEnum;
use App\Customer\Models\AvailabilityRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class AvailabilityRequestRepository implements AvailabilityRequestRepositoryInterface
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

    public function countRequestsBeetweenDates(Carbon $from, Carbon $to): int
    {
        return AvailabilityRequest::whereNot('state', RequestStateEnum::Rejected->value)
            ->where(function (Builder $query) use ($from, $to): void {
                $query
                    ->whereDate('date_from', '<=', $from->timestamp)
                    ->whereDate('date_from', '>', $to->timestamp);
            })
            ->where(function (Builder $query) use ($from, $to): void {
                $query
                    ->whereDate('date_to', '<', $from->timestamp)
                    ->whereDate('date_to', '>', $to->timestamp);
            })
            ->count();
    }
}
