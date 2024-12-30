<?php

namespace Tests\Unit\User\Models;

use App\Event\Models\Event;
use App\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testModelFields()
    {
        $keys = ['name', 'email', 'email_verified_at', 'created_at', 'updated_at'];
        $userArray = $this->user->toArray();

        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $userArray);
        }
    }

    public function testModelRelations()
    {
        $this->assertCount(0, $this->user->events);
        Event::factory()->count(3)->create(['user_id' => $this->user->id]);
        $this->user->refresh();
        $this->assertCount(3, $this->user->events);
    }
}
