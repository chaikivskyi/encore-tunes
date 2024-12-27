<?php

namespace App\Event\Contracts;

use App\Event\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface EventRepositoryInterface
{
    public function create(array $data): Event;

    public function getById(int $id): Event;

    public function delete(Event $event): ?bool;

    public function getActiveEvents(): Collection;

    public function countActiveEventsBeetweenDates(Carbon $from, Carbon $to): int;
}
