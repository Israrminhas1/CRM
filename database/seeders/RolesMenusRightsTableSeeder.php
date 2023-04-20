<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesMenusRightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_menus_rights')->insert([
            [
                'menu_id' => 7,
                'role_id' => 1,
                'mr_rights' => 'Y'
            ],
            [
                'menu_id' => 8,
                'role_id' => 1,
                'mr_rights' => 'Y'
            ]
        ]);
    }
}
