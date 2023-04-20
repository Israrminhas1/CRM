<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeGratuityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['years' => '1', 'valuecalc' => 0.75],
            ['years' => '2', 'valuecalc' => 0.95],
            ['years' => '3', 'valuecalc' => 1.3],
            ['years' => '4', 'valuecalc' => 1.6],
            ['years' => '5+', 'valuecalc' => 2],
            ['years' => '0', 'valuecalc' => 0],
        ];

        DB::table('employee_gratuity')->insert($data);
    }
}
