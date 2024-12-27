<?php

namespace App\Event\Repositories;

use App\Event\Contracts\EventRepositoryInterface;
use App\Event\Enums\EventStateEnum;
use App\Event\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class EventRepository implements EventRepositoryInterface
{
    public function create(array $data): Event
    {
        return Event::create($data);
    }

    public function getById(int $id): Event
    {
        return Event::find($id);
    }

    public function update(Event $event, array $data): int
    {
        return $event->update($data);
    }

    public function getActiveEvents(): Collection
    {
        return Event::whereIn('state', [EventStateEnum::Pending->value, EventStateEnum::Approved->value])
            ->whereDate('date_from', '>=', now()->toDateString())
            ->get();
    }

    public function countActiveEventsBeetweenDates(Carbon $from, Carbon $to): int
    {
        return Event::whereNot('state', EventStateEnum::Rejected->value)
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
