<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalaryBreakupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salary_breakup')->insert([
            [
                'id' => 12,
                'type_id' => 1,
                'name' => 'Basic Salary',
                'percentage' => 50,
                'is_deleted' => 'N',
                'created_on' => Carbon::now(),
                'created_by' => 1,
                'updated_on' => null,
                'updated_by' => null,
            ],
            [
                'id' => 13,
                'type_id' => 1,
                'name' => 'Conveyance Allowance',
                'percentage' => 15,
                'is_deleted' => 'N',
                'created_on' => Carbon::now(),
                'created_by' => 1,
                'updated_on' => null,
                'updated_by' => null,
            ],
            [
                'id' => 14,
                'type_id' => 1,
                'name' => 'Residence Allowance',
                'percentage' => 15,
                'is_deleted' => 'N',
                'created_on' => Carbon::now(),
                'created_by' => 1,
                'updated_on' => null,
                'updated_by' => null,
            ],
            [
                'id' => 15,
                'type_id' => 1,
                'name' => 'Communication Allowance',
                'percentage' => 20,
                'is_deleted' => 'N',
                'created_on' => Carbon::now(),
                'created_by' => 1,
                'updated_on' => null,
                'updated_by' => null,
            ],
            [
                'id' => 16,
                'type_id' => 5,
                'name' => 'Basic Salary',
                'percentage' => 60,
                'is_deleted' => 'N',
                'created_on' => Carbon::now(),
                'created_by' => 1,
                'updated_on' => null,
                'updated_by' => null,
            ],
            [
                'id' => 17,
                'type_id' => 5,
                'name' => 'Residence Allowance',
                'percentage' => 20,
                'is_deleted' => 'N',
                'created_on' => Carbon::now(),
                'created_by' => 1,
                'updated_on' => null,
                'updated_by' => null,
            ],
            [
                'id' => 18,
                'type_id' => 5,
                'name' => 'Communication Allowance',
                'percentage' => 20,
                'is_deleted' => 'N',
                'created_on' => Carbon::now(),
                'created_by' => 1,
                'updated_on' => null,
                'updated_by' => null,
            ],
        ]);
    }
}
