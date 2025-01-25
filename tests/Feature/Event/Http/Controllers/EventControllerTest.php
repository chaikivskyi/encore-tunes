<?php

namespace Tests\Feature\Event\Http\Controllers;

use App\Event\Models\Event;
use App\User\Models\User;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    public function test_list_active()
    {
        Event::factory()->create();
        $response = $this->getJson('/api/calendar/event/active');
        $response
            ->assertOk()
            ->assertJsonMissingPath('data.0.contact_data')
            ->assertJsonMissingPath('data.0.comment')
            ->assertJsonStructure([
                'data' => [['id', 'state', 'date_from', 'date_to']],
            ]);
    }

    public function test_show()
    {
        $event = Event::factory()->create();
        $response = $this->getJson('/api/calendar/event/' . $event->id);
        $response->assertUnauthorized();

        $response = $this
            ->withBasicAuth($event->user->email, 'password')
            ->getJson('/api/calendar/event/' . $event->id);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => ['id', 'contact_data', 'comment', 'state', 'date_from', 'date_to'],
            ]);
    }

    public function test_store()
    {
        $data = [
            'contact_data' => 'john@test.com',
            'comment' => 'test comment',
            'date_from' => now(),
            'date_to' => now()->addDay(),
        ];

        $user = User::factory()->create();

        $this
            ->postJson('/api/calendar/event', $data)
            ->assertUnauthorized();

        $this
            ->withBasicAuth($user->email, 'password')
            ->postJson('/api/calendar/event', $data, ['Accept' => sprintf('application/%s.%s.v1+json', config('api.standardsTree'), config('api.subtype'))])
            ->assertCreated()
            ->assertJsonStructure([
                'event' => ['id', 'contact_data', 'comment', 'state', 'date_from', 'date_to'],
            ]);
    }

    public function test_update()
    {
        $event = Event::factory()->create();

        $this
            ->putJson('/api/calendar/event/' . $event->id, ['comment' => 'test'])
            ->assertUnauthorized();

        $this
            ->withBasicAuth($event->user->email, 'password')
            ->putJson('/api/calendar/event/' . $event->id, ['comment' => 'test'])
            ->assertOk()
            ->assertJson(['data' => ['comment' => 'test']]);
    }

    public function test_destroy()
    {
        $event = Event::factory()->create();

        $this
            ->delete('/api/calendar/event/' . $event->id)
            ->assertUnauthorized();

        $this
            ->withBasicAuth($event->user->email, 'password')
            ->delete('/api/calendar/event/' . $event->id)
            ->assertNoContent();
    }
}
