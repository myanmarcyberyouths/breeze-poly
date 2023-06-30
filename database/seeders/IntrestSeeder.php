<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntrestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interests = [
            ['name' => 'Fun & Casual'],
            ['name' => ' Social & Networking'],
            ['name' => ' Weekend Getaway'],
            ['name' => 'Art & Design'],
            ['name' => 'Technology'],
            ['name' => 'Education'],
            ['name' => 'Sports'],
            ['name' => 'Charity'],
            ['name' => 'Music & Life'],
        ];


        Interest::insert($interests);
    }
}
