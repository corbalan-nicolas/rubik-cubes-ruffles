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
               'title' => '3x3 Rubi\'s Cube Notation for Scrambles and Algorithms',
               'desc' => 'Learn how to read 3x3 rubik\'s cube notations easely',
               'body' => <<<TXT
                    <h1>3x3 Rubik's Cube Notation for Scrambles and Algorithms</h1><p>Cube Notation is letters and letter character combinations to describe specific turns on a 3x3 Rubik's cube. The purpose of notation is to easily describe an algorithm or a scramble.</p><p>Uppercase letters describe one 90 degree clockwise turn of one layer the letter represents.</p><p>If the letter is followed by an apostrophe then the turn is anti-clockwise.</p><p>Lowercase letters means you turn 2 layers simultaneously. So you are turning the face and corresponding inner layer. This is sometimes called "Wide Moves" and used in advanced algorithms.</p><iframe class="ql-video" frameborder="0" allowfullscreen="true" src="https://www.youtube.com/embed/15Acy0mIPJs?showinfo=0"></iframe><p>For <strong>oficial scrambles</strong> hold the 3x3 with <strong>white</strong> <strong>top</strong> and <strong>green front.</strong></p><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Outside Face Turns</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>UP</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>DOWN</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>RIGHT</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>LEFT</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>FRONT</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>BACK</li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Inner Layer Turns</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>MIDDLE</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>EQUATOR</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>SLICE</li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Cube Rotations</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>X-AXIS</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>Y-AXIS</li><li data-list="bullet" class="ql-indent-1"><span class="ql-ui" contenteditable="false"></span>Z-AXIS</li></ol><p>That's it, you're ready to go! I hope you found this blog helpful :)</p>
                TXT,
               'cover' => null,
               'status' => 'published',
               'author_id' => 3,
               'verifier_id' => 8,
           ]
        ]);
    }
}
