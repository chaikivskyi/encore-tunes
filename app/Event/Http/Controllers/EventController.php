<?php

namespace App\Event\Http\Controllers;

use App\Event\Contracts\EventRepositoryInterface;
use App\Event\Http\Requests\EventStoreRequest;
use App\Event\Http\Requests\EventUpdateRequest;
use App\Event\Http\Transformers\EventPrivateDataTransformer;
use App\Event\Http\Transformers\EventPublicDataTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EventController extends Controller
{
    use Helpers;
    public function __construct(private EventRepositoryInterface $eventRepository)
    {
    }

    public function indexActive(Request $request)
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', 10);
        $events = $this->eventRepository->getActiveEvents($page, $limit);

        return $this->response->paginator($events, new EventPublicDataTransformer);
    }

    public function show(int $id)
    {
        $event = $this->eventRepository->getById($id);

        return $this->response->item($event, new EventPrivateDataTransformer);
    }

    public function store(EventStoreRequest $request)
    {
        $event = $this->eventRepository->create($request->all());

        return $this->response->created(null, $event);
    }

    public function update(int $id, EventUpdateRequest $request)
    {
        $event = $this->eventRepository->getById($id);
        $this->eventRepository->update($event, $request->all());

        return $this->response->item($event, EventPrivateDataTransformer::class);
    }

    public function destroy(int $id)
    {
        $event = $this->eventRepository->getById($id);
        $this->eventRepository->delete($event);

        return $this->response->noContent();
    }
}
