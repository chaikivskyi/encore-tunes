<?php

namespace Database\Factories\Event\Models;

use App\Event\Enums\EventStateEnum;
use App\Event\Models\Event;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contact_data' => $this->faker->email(),
            'date_from' => $this->faker->dateTimeBetween('now', '+ 1 day'),
            'date_to' => $this->faker->dateTimeBetween('+ 1 day', '+ 3 days'),
            'state' => $this->faker->randomElement(array_column(EventStateEnum::cases(), 'value')),
            'user_id' => User::factory(),
            'comment' => $this->faker->text(),
        ];
    }
}
