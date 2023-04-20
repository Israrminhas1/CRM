<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'Super admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => null,
            'password' => Hash::make('admin123'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => 'De0wMBL1572B0euGtuT02yQV11IzjSPoKGQlPBywtCH5hYhidXEKmGMr8exM',
            'current_team_id' => null,
            'profile_photo_path' => 'profile/YaQhcEx2ZanaggqXp8BGCF449ViwiteYTslxKRm5.png',
            'role_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
