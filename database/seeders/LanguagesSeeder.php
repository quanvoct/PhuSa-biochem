<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            ['id' => 1, 'name' => 'English', 'code' => 'en'],
            ['id' => 2, 'name' => 'Tiếng Việt', 'code' => 'vn'],
        ];

        foreach ($languages as $key => $lang) {
            Language::create($lang);
        }
    }
}
