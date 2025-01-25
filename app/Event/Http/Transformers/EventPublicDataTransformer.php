<?php

namespace App\Event\Http\Transformers;

use App\Event\Models\Event;
use League\Fractal\TransformerAbstract;

class EventPublicDataTransformer extends TransformerAbstract
{
    public function transform(Event $event)
    {
        return [
            'id' => $event->id,
            'state' => $event->state,
            'date_from' => $event->date_from->toDateString(),
            'date_to' => $event->date_to->toDateString(),
        ];
    }
}
