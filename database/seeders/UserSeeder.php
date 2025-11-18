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
                'display_name' => '_Display Name :: user1@asd.asd_',
                'email' => 'user1@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'User 2',
                'display_name' => '_Display Name :: user2@asd.asd_',
                'email' => 'user2@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 1,
            ],
            // Bloggers
            [
                'id' => 3,
                'name' => 'Blogger 1',
                'display_name' => '_Display Name :: blogger1@asd.asd_',
                'email' => 'blogger1@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 2,
            ],
            [
                'id' => 4,
                'name' => 'Blogger 2',
                'display_name' => '_Display Name :: blogger2@asd.asd_',
                'email' => 'blogger2@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 2,
            ],
            // Companies
            [
                'id' => 5,
                'name' => 'Company 1',
                'display_name' => '_Display Name :: company1@asd.asd_',
                'email' => 'company1@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 3,
            ],
            [
                'id' => 6,
                'name' => 'Company 2',
                'display_name' => '_Display Name :: company2@asd.asd_',
                'email' => 'company2@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 3,
            ],
            // Admins
            [
                'id' => 7,
                'name' => 'Admin 1',
                'display_name' => '_Display Name :: admin1@asd.asd_',
                'email' => 'admin1@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 4,
            ],
            [
                'id' => 8,
                'name' => 'Admin 2',
                'display_name' => '_Display Name :: admin2@asd.asd_',
                'email' => 'admin2@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 4,
            ],
            // Superadmins
            [
                'id' => 9,
                'name' => 'Superadmin 1',
                'display_name' => '_Display Name :: superadmin1@asd.asd_',
                'email' => 'superadmin1@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 5,
            ],
            [
                'id' => 10,
                'name' => 'Superadmin 2',
                'display_name' => '_Display Name :: superadmin2@asd.asd_',
                'email' => 'superadmin2@asd.asd',
                'password' => Hash::make('asd.asd'),
                'role_id' => 5,
            ],
        ]);
    }
}
