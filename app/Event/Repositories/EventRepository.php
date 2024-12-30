<?php

namespace App\Event\Repositories;

use App\Event\Contracts\EventRepositoryInterface;
use App\Event\Enums\EventStateEnum;
use App\Event\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EventRepository implements EventRepositoryInterface
{
    public function create(array $data): Event
    {
        return Event::create($data);
    }

    public function getById(int $id): ?Event
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
            ->whereDate('date_to', '>', now()->toDateString())
            ->get();
    }

    public function countActiveEventsBeetweenDates(Carbon $from, Carbon $to): int
    {
        return Event::whereIn('state', [EventStateEnum::Pending->value, EventStateEnum::Approved->value])
            ->where(function (Builder $query) use ($from, $to): void {
                $query
                    ->where(function (Builder $query) use ($from, $to): void {
                        $query
                            ->whereDate(DB::raw('DATE(date_from)'), '>=', $from->toDateString())
                            ->whereDate(DB::raw('DATE(date_from)'), '<', $to->toDateString());
                    })
                    ->orWhere(function (Builder $query) use ($from, $to): void {
                        $query
                            ->whereDate(DB::raw('DATE(date_to)'), '>', $from->toDateString())
                            ->whereDate(DB::raw('DATE(date_to)'), '<', $to->toDateString());
                    });
            })
            ->count();
    }
}
