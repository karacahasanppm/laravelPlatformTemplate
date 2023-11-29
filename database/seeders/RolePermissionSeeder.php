<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superUserRole = Role::create(['name' => 'SuperUser']);
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);
        $viewerRole = Role::create(['name' => 'Viewer']);
        $apiRole = Role::create(['name' => 'Api']);

        Permission::create(['name' => 'manage platform']);
        Permission::create(['name' => 'manage firm']);
        Permission::create(['name' => 'manage recipient']);
        Permission::create(['name' => 'view recipient']);
        Permission::create(['name' => 'connect api']);

        $superUserRole->givePermissionTo('manage platform','manage firm','manage recipient','view recipient','connect api');
        $adminRole->givePermissionTo('manage firm','manage recipient','view recipient');
        $userRole->givePermissionTo('manage recipient','view recipient');
        $viewerRole->givePermissionTo('view recipient');
        $apiRole->givePermissionTo('connect api');
    }
}
