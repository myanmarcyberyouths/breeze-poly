<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'date' => fake()->date(),
            'time' => fake()->time(),
            'place' => collect(['Yangon', 'Mandalay', 'Letpadan'])->random(),
            'ticket_price' => fake()->numberBetween(0, 3000),
            'information' => fake()->realText(200),
            'visibility' => collect(['public', 'private', 'unlisted'])->random(),
            'is_shareable' => fake()->boolean(),
            'user_id' => User::factory()->create(),
        ];
    }
}
