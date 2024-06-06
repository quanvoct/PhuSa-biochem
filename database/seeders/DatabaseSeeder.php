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
            LanguagesSeeder::class,
            SettingsSeeder::class,
            CataloguesSedder::class,
            ProductsSedder::class,
            VariablesSedder::class
        ]);
    }
}
