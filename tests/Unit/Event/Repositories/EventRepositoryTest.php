<?php

namespace Tests\Unit\Event\Repositories;

use App\Event\Contracts\EventRepositoryInterface;
use App\Event\Enums\EventStateEnum;
use App\Event\Models\Event;
use App\User\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class EventRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected EventRepositoryInterface $eventRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eventRepository = $this->app->make(EventRepositoryInterface::class);
    }

    #[DataProvider('createDataProvider')]
    public function testCreate(callable $data, bool $shouldThrowException)
    {
        if ($shouldThrowException) {
            $this->expectException(QueryException::class);
        }

        $event = $this->eventRepository->create($data());
        $this->assertModelExists($event);
    }

    public function testGetById()
    {
        $event = $this->eventRepository->getById(-1);
        $this->assertNull($event);

        $event = Event::factory()->create();
        $this->assertModelExists($event);

        $retrievedEvent = $this->eventRepository->getById($event->id);
        $this->assertTrue($event->is($retrievedEvent));
    }

    public function testUpdate()
    {
        $event = Event::factory()->create();
        $this->eventRepository->update($event, ['contact_data' => 'john@test.com']);
        $this->assertTrue($event->wasChanged('contact_data'));
    }

    public function testGetActiveEvents()
    {
        $this->createEvents();
        $activeEvents = $this->eventRepository->getActiveEvents();
        $this->assertCount(2, $activeEvents);
    }

    public function testCountActiveEventsBeetweenDates()
    {
        $this->createEvents();

        $this->assertCount(
            $this->eventRepository->countActiveEventsBeetweenDates(now(), now()->addMonth()),
            $this->eventRepository->getActiveEvents()
        );
    }

    public static function createDataProvider(): array
    {
        return [
            [
                fn () => [
                    'contact_data' => 'john@test.com',
                    'date_from' => '2024-01-01',
                    'date_to' => '2024-01-02',
                    'state' => EventStateEnum::Pending->value,
                    'user_id' => User::factory()->create()->id,
                    'comment' => 'Test event'
                ],
                'shouldThrowException' => false,
            ],
            [
                fn () => [
                    'date_from' => '2024-01-01',
                    'date_to' => '2024-01-02',
                    'state' => EventStateEnum::Pending->value,
                    'comment' => 'Test event'
                ],
                'shouldThrowException' => true,
            ],
            [
                fn () => [
                    'date_from' => '2024-01-01',
                    'date_to' => '2024-01-02',
                ],
                'shouldThrowException' => true,
            ]
        ];
    }

    private function createEvents()
    {
        Event::factory()
            ->count(6)
            ->sequence(
                ['state' => EventStateEnum::Pending->value],
                ['state' => EventStateEnum::Rejected->value],
                ['state' => EventStateEnum::Canceled->value],
                ['state' => EventStateEnum::Approved->value],
                [
                    'state' => EventStateEnum::Pending->value,
                    'date_from' => now()->subDays(2)->toDateString(),
                    'date_to' => now()->subDay()->toDateString()
                ],
                [
                    'state' => EventStateEnum::Approved->value,
                    'date_from' => now()->subDays(2)->toDateString(),
                    'date_to' => now()->toDateString()
                ]
            )
            ->create();
    }
}
