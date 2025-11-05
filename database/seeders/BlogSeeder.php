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
                    <p>Today, we're going to learn</p>
                    <h1>3x3 cube notations</h1>
                    <p>This is just a <strong>test</strong></p>
                    <ul>
                        <li>List item 1</li>
                        <li>List item 2</li>
                    </ul>
                ",
               'cover' => null,
               'status' => 'published',
               'author_id' => 3,
               'verifier_id' => 8,
           ]
        ]);
    }
}
