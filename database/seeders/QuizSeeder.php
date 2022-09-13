<?php

namespace Database\Seeders;

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
        \App\Models\Quiz::factory(5)->create();

        foreach (\App\Models\Quiz::all() as $quiz) {
            $quiz->questions()->attach(\App\Models\Question::query()->inRandomOrder()->limit(10)->get());
        }
    }
}
