<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllowanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('allowance')->insert([
            ['id' => 10, 'name' => 'Medical', 'is_deleted' => 'N'],
            ['id' => 11, 'name' => 'Travel', 'is_deleted' => 'N'],
        ]);
    }
}
