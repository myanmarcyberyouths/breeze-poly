<?php

namespace Database\Seeders;

use App\Enums\ActionType;
use App\Models\Action;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Action::create([
            'type' => ActionType::Create,
        ]);

        Action::create([
            'type' => ActionType::Comment,
        ]);

        Action::create([
            'type' => ActionType::Like,
        ]);

        Action::create([
            'type' => ActionType::Bookmark,
        ]);


        Action::create([
            'type' => ActionType::Repost,
        ]);

    }
}
