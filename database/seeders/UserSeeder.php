<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Users
            [
                'id' => 1,
                'name' => 'User 1',
                'display_name' => 'd_user_1',
                'email' => 'user1@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'User 2',
                'display_name' => 'd_user_2',
                'email' => 'user2@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 1,
            ],
            // Bloggers
            [
                'id' => 3,
                'name' => 'Blogger 1',
                'display_name' => 'd_blogger_1',
                'email' => 'blogger1@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 2,
            ],
            [
                'id' => 4,
                'name' => 'Blogger 2',
                'display_name' => 'd_blogger_2',
                'email' => 'blogger2@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 2,
            ],
            // Companies
            [
                'id' => 5,
                'name' => 'Company 1',
                'display_name' => 'd_company_1',
                'email' => 'company1@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 3,
            ],
            [
                'id' => 6,
                'name' => 'Company 2',
                'display_name' => 'd_company_2',
                'email' => 'company2@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 3,
            ],
            // Admins
            [
                'id' => 7,
                'name' => 'Admin 1',
                'display_name' => 'd_admin_1',
                'email' => 'admin1@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 4,
            ],
            [
                'id' => 8,
                'name' => 'Admin 2',
                'display_name' => 'd_admin_2',
                'email' => 'admin2@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 4,
            ],
            // Superadmins
            [
                'id' => 9,
                'name' => 'Superadmin 1',
                'display_name' => 'd_superadmin_1',
                'email' => 'superadmin1@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 5,
            ],
            [
                'id' => 10,
                'name' => 'Superadmin 2',
                'display_name' => 'd_superadmin_2',
                'email' => 'superadmin2@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 5,
            ],
        ]);
    }
}
