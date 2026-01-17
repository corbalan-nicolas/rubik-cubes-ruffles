<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
           [
               'id' => 1,
               'amount' => 1,
               'user_id' => 2,
               'created_at' => Date::now()
           ],
           [
               'id' => 2,
               'amount' => 6,
               'user_id' => 2,
               'created_at' => Date::now()
           ]
        ]);
    }
}
