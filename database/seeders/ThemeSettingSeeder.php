<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('theme_setting')->insert([
            [
                'id' => 4,
                'theme' => 'theme-green',
                'light_sidebar' => 'default-sidebar',
                'gradient' => 'plain',
                'darkmode' => null,
                'rtl_mode' => 'deactive',
                'user_id' => 1
            ]
        ]);
    }
}
