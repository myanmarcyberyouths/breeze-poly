<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Interest;
use App\Models\User;
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
            ->create();

        $this->call([
            EventSeeder::class,
        ]);
    }
}
