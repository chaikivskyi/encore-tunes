<?php

namespace App\Event\Http\Transformers;

use App\Event\Models\Event;
use League\Fractal\TransformerAbstract;

class EventPrivateDataTransformer extends TransformerAbstract
{
    public function transform(Event $event)
    {
        return [
            'id' => $event->id,
            'contact_data' => $event->contact_data,
            'comment' => $event->comment,
            'state' => $event->state,
            'date_from' => $event->date_from->toDateString(),
            'date_to' => $event->date_to->toDateString(),
        ];
    }
}
