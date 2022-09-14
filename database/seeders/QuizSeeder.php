<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz::factory(20)->create();

        foreach (Quiz::all() as $quiz) {
            $quiz->questions()->attach(Question::query()->inRandomOrder()->limit(rand(4, 6))->get());
        }
    }
}
