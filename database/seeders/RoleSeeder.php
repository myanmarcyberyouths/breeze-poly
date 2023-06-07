<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'user',
            ],
            [
                'name' => 'organizer',
            ],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
