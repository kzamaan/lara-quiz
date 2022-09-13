<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::factory(50)->create();

        foreach (Question::all() as $question) {
            for ($i = 0; $i < 4; $i++) {
                $isCorrect = $i === 0 ? 1 : 0;
                Option::factory()->create([
                    'question_id' => $question->id,
                    'is_correct' => $isCorrect
                ]);
            }
        }
    }
}
