<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'create events',
            'edit events',
            'delete events'
        ];

        $user = Role::create(['name' => 'user']);
        $organizer = Role::create(['name' => 'organizer']);

        foreach ($permissions as $permission)
        {
            $createdPermission =  Permission::create(['name' => $permission]);
            $user->givePermissionTo($createdPermission);
            $organizer->givePermissionTo($createdPermission);
        }


    }
}
