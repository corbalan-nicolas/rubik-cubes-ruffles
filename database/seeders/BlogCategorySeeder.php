<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_category')->insert([
            [
                'blog_id' => 1,
                'category_id' => 2
            ],
            [
                'blog_id' => 1,
                'category_id' => 3
            ]
        ]);
    }
}
