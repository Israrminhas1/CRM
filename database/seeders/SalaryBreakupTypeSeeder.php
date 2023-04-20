<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalaryBreakupTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salary_breakup_type')->insert([
            [
                'id' => 1,
                'name' => 'TypeA',
                'created_on' => Carbon::now(),
                'created_by' => 1,
                'updated_on' => NULL,
                'updated_by' => NULL,
            ],
            [
                'id' => 5,
                'name' => 'TypeB',
                'created_on' => Carbon::now(),
                'created_by' => 1,
                'updated_on' => NULL,
                'updated_by' => NULL,
            ]
        ]);
    }
}
