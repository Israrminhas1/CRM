<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendance')->insert([
            [
                'employee_id' => 49,
                'attendance_type' => 'Clock In',
                'attendance_date' => '2023-04-04',
                'attendance_time' => '08:30',
                'status' => 'pending',
                'comment' => null,
                'reject_reason' => null,
                'created_on' => now(),
                'created_by' => 1,
                'updated_on' => now(),
                'updated_by' => 1,
            ],
            [
                'employee_id' => 49,
                'attendance_type' => 'Clock Out',
                'attendance_date' => '2023-04-04',
                'attendance_time' => '18:30',
                'status' => 'pending',
                'comment' => null,
                'reject_reason' => null,
                'created_on' => now(),
                'created_by' => 1,
                'updated_on' => null,
                'updated_by' => null,
            ],
        ]);
    }
}
