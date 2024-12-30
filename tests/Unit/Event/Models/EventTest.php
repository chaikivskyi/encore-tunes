<?php

namespace Tests\Unit\Event\Models;

use App\Event\Models\Event;
use App\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    protected Event $event;

    protected function setUp(): void
    {
        parent::setUp();
        $this->event = Event::factory()->create();
    }

    public function testModelFields()
    {
        $keys = ['id', 'contact_data', 'date_from', 'date_to', 'state', 'user_id', 'comment'];
        $eventArray = $this->event->toArray();

        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $eventArray);
        }
    }

    public function testModelRelations()
    {
        $this->assertInstanceOf(User::class, $this->event->user);
    }
}
