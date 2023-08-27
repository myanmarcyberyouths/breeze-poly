<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\ActionType;
use App\Models\Activity;
use App\Models\Event;
use App\Models\Interest;
use App\Models\User;
use Database\Factories\EventFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ActionSeeder::class,
            IntrestSeeder::class,
        ]);

        User::factory()->count(10)
            ->hasAttached(
                Interest::all()->random(3),
            )
            ->create()
            ->each(
                fn(User $user) => $user->events()->createMany(
                    Event::factory()->count(3)->make()->toArray()
                )
            );

        Activity::create([
            'action_id' => 1,
            'user_id' => 1,
            'event_id' => 4,
        ]);

        Activity::create([
            'action_id' => 3, // like
            'user_id' => 1,
            'event_id' => 5,
        ]);

        Activity::create([
            'action_id' => 4, // bookmark
            'user_id' => 1,
            'event_id' => 5,
        ]);


        Activity::create([
            'action_id' => 5, // repost
            'user_id' => 1,
            'event_id' => 5,
        ]);


    }
}
