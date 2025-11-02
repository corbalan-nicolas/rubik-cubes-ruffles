<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'role' => 'user',
            ],
            [
                'id' => 2,
                'role' => 'blogger',
            ],
            [
                'id' => 3,
                'role' => 'company',
            ],
            [
                'id' => 4,
                'role' => 'admin',
            ],
            [
                'id' => 5,
                'role' => 'superadmin',
            ]
        ]);
    }
}
