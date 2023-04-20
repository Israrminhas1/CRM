<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activity_log')->insert([
            [
                'id' => 696,
                'user_id' => 1,
                'description' => 'Employee "Israr minhas" was Created',
                'activity_date' => Carbon::parse('2023-04-20 15:27:40')
            ],
            [
                'id' => 697,
                'user_id' => 1,
                'description' => 'Employee "Israr minhas" Document was Created',
                'activity_date' => Carbon::parse('2023-04-20 15:28:25')
            ],
            [
                'id' => 698,
                'user_id' => 1,
                'description' => 'Leave type "Marriage Leave" was Created',
                'activity_date' => Carbon::parse('2023-04-20 15:29:14')
            ],
            [
                'id' => 699,
                'user_id' => 1,
                'description' => 'Leave type "Sick Leave" was Created',
                'activity_date' => Carbon::parse('2023-04-20 15:29:36')
            ],
            [
                'id' => 700,
                'user_id' => 1,
                'description' => 'Leave for "Israr minhas" was Created',
                'activity_date' => Carbon::parse('2023-04-20 15:29:52')
            ],
        ]);
    }
}
