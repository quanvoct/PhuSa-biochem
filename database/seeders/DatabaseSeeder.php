<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            SuperAdminRoleSeeder::class,
            AdminUserSeeder::class,
            LocalSeeder::class,
            SettingsSeeder::class
        ]);
    }
}
