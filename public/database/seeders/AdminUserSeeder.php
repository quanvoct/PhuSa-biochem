<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Key Digital',
            'phone' => '0939403090',
            'email' => 'keydigital.vn@gmail.com',
            'email_verified_at' => '2023-08-14 00:20:06',
            'password' => Hash::make('Admin@12345'),
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'last_login_at' => '2023-08-13 22:53:18',
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Nguyên Nguyễn',
            'phone' => '0975496934',
            'email' => '615243nguyen96@gmail.com',
            'email_verified_at' => '2023-08-14 00:20:06',
            'password' => Hash::make('Nguyen@123456'),
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'last_login_at' => '2023-08-13 22:53:18',
        ]);

        // Assign the 'admin' role to the user
        $userA = \App\Models\User::find(1);
        $userA->assignRole('Super Admin');
        $userB = \App\Models\User::find(2);
        $userB->assignRole('Khách hàng');
    }
}

