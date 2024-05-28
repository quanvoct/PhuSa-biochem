<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminRoleSeeder extends Seeder
{
    public function run()
    {
        // Create 'Khách hàng' role
        $role = Role::create(['name' => 'Khách hàng']);
        // Create 'Super Admin' role
        $role = Role::create(['name' => 'Super Admin']);

        // Get all permissions
        $permissions = Permission::all();

        // Grant all permissions to the 'Super Admin' role
        $role->syncPermissions($permissions);
    }
}