<?php

namespace Database\Seeders;

use App\Models\Answers;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        Quiz::create([
            'user_id' => rand(0, 12),
            'name' => Str::random(10)
        ]);



        Question::create([
            'name' => Str::random(10),
            'quiz_id' => rand(0, 12)
        ]);

        Answers::create([
            'question_id' => rand(0, 12),
            'name' => Str::random(10),
            'is_correct' => rand(0, 1),
        ]);
    }
}
