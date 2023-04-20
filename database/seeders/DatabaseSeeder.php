<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(UsersRolesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(RolesMenusRightsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SalaryBreakupTableSeeder::class);
        $this->call(SalaryBreakupTypeSeeder::class);
        $this->call(ThemeSettingSeeder::class);
        $this->call(UsersMenusTableSeeder::class);
        $this->call(UsersRolesTableSeeder::class);
        $this->call(RolesMenusSeeder::class);
        $this->call(ActivityLogSeeder::class);
        $this->call(AllowanceTableSeeder::class);
        $this->call(AttendanceSeeder::class);
        $this->call(DeductionTableSeeder::class);
        $this->call(EmployeeGratuityTableSeeder::class);
        $this->call(EmployesTableSeeder::class);
        $this->call(LeavesTableSeeder::class);
        $this->call(LeavesTypeTableSeeder::class);
    }
}
