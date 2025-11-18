<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tickets')->insert([
            [
                'user_id' => 2,
                'raffle_id' => 1,
            ],
            [
                'user_id' => 2,
                'raffle_id' => 1,
            ],
            [
                'user_id' => 2,
                'raffle_id' => 1,
            ],
            [
                'user_id' => 2,
                'raffle_id' => 1,
            ],
        ]);
    }
}
