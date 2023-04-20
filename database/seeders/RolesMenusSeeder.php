<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['menu_id' => 3, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 4, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 5, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 6, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 7, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 8, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 9, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 10, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 11, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 12, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 13, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 14, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 16, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 17, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 18, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 19, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 20, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 21, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 22, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 23, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 24, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 26, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 27, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 28, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 29, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 30, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 33, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 34, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 35, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 36, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 37, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 38, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 39, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 40, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 42, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 45, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 46, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 47, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 48, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 49, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 50, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 31, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 43, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 44, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 52, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 53, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 54, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 55, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 32, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 1, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 2, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 15, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 51, 'role_id' => 1, 'r_view' => 'Y'],
            ['menu_id' => 100, 'role_id' => 1, 'r_view' => 'Y']
        ];
        DB::table('roles_menus')->insert($data);
    }
}
