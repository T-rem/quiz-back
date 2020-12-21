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
        for ($i=0; $i < 10; $i++) {
            Quiz::create([
                'user_id' => rand(1, 10),
                'name' => Str::random(10)
            ]);
        }

        for ($i=0; $i < 10; $i++) {
            Question::create([
                'name' => Str::random(10),
                'quiz_id' => rand(1, 10)
            ]);
        }
        for ($i=0; $i < 20; $i++) {
            Answers::create([
                'question_id' => rand(0, 10),
                'name' => Str::random(10),
                'is_correct' => rand(0, 1),
            ]);
        }
    }
}
