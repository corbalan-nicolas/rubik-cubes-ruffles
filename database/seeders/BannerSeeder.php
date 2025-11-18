<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banners')->insert([
            [
                'id' => 1,
                'banner' => 'banners/0i2E2614tlmhBaCMMC5IeDBFOkQyuNh5zvk0kSRK.jpg',
                'banner_alt' => 'Algun banner asi cualquiera viste',
                'position' => 2,
                'raffle_id' => 1,
            ],
            [
                'id' => 2,
                'banner' => 'banners/AMfFN2fGP76vKwWOHhmsMtjHpES65KhwZmUf4vvM.jpg',
                'banner_alt' => 'OTRO BANNERS',
                'position' => 1,
                'raffle_id' => 1,
            ]
        ]);
    }
}
