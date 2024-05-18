<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->insert([
            'id' => 1,
            'key' => 'logo_square',
            'value' => ''
        ]);
        DB::table('settings')->insert([
            'id' => 2,
            'key' => 'logo_horizon',
            'value' => 'logo_horizon.png'
        ]);
        DB::table('settings')->insert([
            'id' => 3,
            'key' => 'company_name',
            'value' => 'Phu Sa Genomics Joint Stock Company'
        ]);
        DB::table('settings')->insert([
            'id' => 4,
            'key' => 'company_address',
            'value' => 'K1.15-16, Vo Nguyen Giap st., Phu Thu w., Cai Rang dis., Cantho City, Vietnam'
        ]);
        DB::table('settings')->insert([
            'id' => 5,
            'key' => 'company_taxid',
            'value' => '1801727039'
        ]);
        DB::table('settings')->insert([
            'id' => 6,
            'key' => 'company_taxmeta',
            'value' => 'Issued on July 8, 2022 at Department of Planning and Investment of Cantho city,  Vietnam'
        ]);
        DB::table('settings')->insert([
            'id' => 7,
            'key' => 'company_brandname',
            'value' => 'Phu Sa Biochem'
        ]);
        DB::table('settings')->insert([
            'id' => 8,
            'key' => 'company_hotline',
            'value' => '(+84)931035935'
        ]);
        DB::table('settings')->insert([
            'id' => 9,
            'key' => 'company_phone',
            'value' => '(+84)2926515678'
        ]);
        DB::table('settings')->insert([
            'id' => 10,
            'key' => 'company_email',
            'value' => 'cskh@phusagenomics.com'
        ]);
        DB::table('settings')->insert([
            'id' => 11,
            'key' => 'company_facebook',
            'value' => 'https://www.facebook.com/profile.php?id=100009390873079'
        ]);
        DB::table('settings')->insert([
            'id' => 12,
            'key' => 'company_zalo',
            'value' => '0931035935'
        ]);
        DB::table('settings')->insert([
            'id' => 13,
            'key' => 'company_youtube',
            'value' => 'https://www.youtube.com/@phusagenomicsvietnam'
        ]);
        DB::table('settings')->insert([
            'id' => 15,
            'key' => 'bank_id',
            'value' => '970437'
        ]);
        DB::table('settings')->insert([
            'id' => 17,
            'key' => 'bank_account',
            'value' => 'CÔNG TY CỔ PHẦN PHÙ SA GENOMICS'
        ]);
        DB::table('settings')->insert([
            'id' => 18,
            'key' => 'bank_number',
            'value' => '007704070030747'
        ]);
        DB::table('settings')->insert([
            'id' => 19,
            'key' => 'contact_map',
            'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d584.0793546978376!2d105.80341885276462!3d10.00017616936297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a063d1c7aa6571%3A0xcf11cba88c2ec847!2zQ8O0bmcgdHkgQ-G7lSBwaOG6p24gUGjDuSBTYSBHZW5vbWljcw!5e0!3m2!1svi!2s!4v1716018323176!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
        ]);
        DB::table('settings')->insert([
            'id' => 20,
            'key' => 'head_code',
            'value' => ''
        ]);
        DB::table('settings')->insert([
            'id' => 21,
            'key' => 'bodytop_code',
            'value' => ''
        ]);
        DB::table('settings')->insert([
            'id' => 22,
            'key' => 'bodybottom_code',
            'value' => ''
        ]);
        DB::table('settings')->insert([
            'id' => 23,
            'key' => 'favicon',
            'value' => 'favicon.png'
        ]);
        DB::table('settings')->insert([
            'id' => 24,
            'key' => 'logo_square_bw',
            'value' => ''
        ]);
        DB::table('settings')->insert([
            'id' => 25,
            'key' => 'logo_horizon_bw',
            'value' => 'logo_horizon_bw.png'
        ]);
    }
}
