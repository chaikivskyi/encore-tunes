<?php

namespace Tests\Unit\Event\Policies;

use App\Event\Models\Event;
use App\Event\Policies\EventPolicy;
use App\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class EventPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected EventPolicy $eventPolicy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eventPolicy = $this->app->make(EventPolicy::class);
    }

    #[DataProvider('userEventData')]
    public function testCancelPolicy(callable $data)
    {
        [
            'user' => $user,
            'event' => $event,
            'expectedResult' => $expectedResult
        ] = $data();

        $this->assertEquals($this->eventPolicy->cancel($user, $event), $expectedResult);
    }

    public static function userEventData(): array
    {
        return [
            'authorized user' => [
                fn (): array => [
                    'user' => $user = User::factory()->create(),
                    'event' => Event::factory()->create(['user_id' => $user->id]),
                    'expectedResult' => true,
                ],
            ],
            'unauthorized user' => [
                fn (): array => [
                    'user' => User::factory()->create(),
                    'event' => Event::factory()->create(),
                    'expectedResult' => false,
                ],
            ],
        ];
    }
}
