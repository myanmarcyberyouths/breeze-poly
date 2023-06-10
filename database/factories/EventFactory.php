<?php

namespace Database\Factories;

use App\Models\Event;
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
            'image' => fake()->imageUrl,
            'date' => fake()->date(),
            'time' => fake()->time(),
            'place' => collect(['Yangon', 'Mandalay', 'Letpadan'])->random(),
            'price' => fake()->numberBetween(0, 3000),
            'about' => fake()->realText(200),
            'visibility' => collect(['public', 'private', 'unlisted'])->random(),
        ];
    }
}
