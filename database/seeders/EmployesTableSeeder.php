<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employes')->insert([
            [
                'id' => 49,
                'user_id' => null,
                'full_name' => 'Israr minhas',
                'father_name' => 'Thomas',
                'basic_salary' => '50000',
                'salary' => 50000,
                'BreakUpTypeId' => 5,
                'dob' => '2023-04-18',
                'emp_address' => 'house no 583 street 32 i8/2',
                'gender' => 'M',
                'mobile_phone' => '031177023355',
                'country' => 'Pakistan',
                'country_phone' => '03117705558',
                'contact_name' => 'Pakistan',
                'permanent_address' => 'house no 583 street 32 i8/2',
                'designation' => 'Web Developer',
                'visa_title' => 'Visit',
                'joining_date' => '2023-03-07',
                'visa_expiry_date' => '2023-04-04',
                'notify' => 0,
                'attachment' => 'uploads/employeeprofile/1682004459.jpg',
                'status' => 'active',
                'ending_date' => null,
                'reason' => null,
                'status_attachment' => null,
                'created_on' => '2023-04-20',
                'created_by' => 1,
                'modified_on' => null,
                'modified_by' => 0,
                'is_deleted' => 'N'
            ]
        ]);
    }
}
