<?php

namespace App\Event\Contracts;

use App\Event\Models\Event;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;

interface EventRepositoryInterface
{
    public function create(array $data): Event;

    public function getById(int $id): Event;

    public function update(Event $event, array $data): bool;

    public function getActiveEvents(int $page = 1, ?int $limit = null): Paginator;

    public function countActiveEventsBeetweenDates(Carbon $from, Carbon $to): int;
}
