<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->insert([
           [
               'id' => 1,
               'title' => 'How to solve a 3x3 cube with 1 algorithm',
               'desc' => 'Believe it or not, it is possible!',
               'body' => "
                    \n# Now I'm testing how far I can go
                    \nThis is what happen if I use something good
                    \n
                    \n- Just
                    \n- A
                    \n- List
                    \n
                    \n## There you gooo
                    \nThis is kinda fine actually, I really like how this works, but I'm affraid this is going to be hard...
                ",
               'cover' => '/images/blogs/1.jpg',
               'status' => 'published',
               'author_id' => 3,
               'verifier_id' => 8,
           ]
        ]);
    }
}
