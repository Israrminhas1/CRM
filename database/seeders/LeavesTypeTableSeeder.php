<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeavesTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leaves_type')->insert([
            [
                'id' => 56,
                'type_name' => 'Marriage Leave',
                'is_deleted' => 'N',
                'created_by' => 1,
                'created_on' => now(),
                'updated_by' => null,
                'updated_on' => null,
            ],
            [
                'id' => 57,
                'type_name' => 'Sick Leave',
                'is_deleted' => 'N',
                'created_by' => 1,
                'created_on' => now(),
                'updated_by' => null,
                'updated_on' => null,
            ],
        ]);
    }
}
