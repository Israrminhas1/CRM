<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeavesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leaves')->insert([
            [
                'id' => 48,
                'employee_id' => 49,
                'type_id' => 57,
                'ispaid' => 'paid',
                'start_date' => '2023-04-10',
                'end_date' => '2023-04-20',
                'is_deleted' => 'N',
                'created_on' => now(),
                'created_by' => 1,
                'updated_on' => null,
                'updated_by' => null,
            ],
        ]);
    }
}
