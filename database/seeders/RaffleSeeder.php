<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RaffleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('raffles')->insert([
            [
                'id' => 1,
                'title' => 'it\'s 8th GAN anniversary!',
                'desc' => 'Bla bla bla, we love you and bla bla bla',
                'start_date' => '2025-11-13 18:28:28',
                'end_date' => '2025-12-25 00:00:00',
                'sponsor_id' => 5
            ]
        ]);
    }
}
