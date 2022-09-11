<?php

namespace App\Http\Livewire;

use App\Models\Question;
use App\Models\Quizze;
use App\Models\Topic;
use Illuminate\Support\Str;
use Livewire\Component;

class QuizCreate extends Component
{
    public $title, $description, $slug, $status;
    public $selectedQuestions = [];

    protected $rules = [
        'title' => 'required',
        'slug' => 'required',
        'description' => 'nullable',
    ];

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    function store()
    {

        $this->validate();
    }
    public function getTopicsProperty()
    {
        // return Question::query()->get();
        return Topic::query()->with(['questions'])->orderBy('name')->get();
    }
    public function render()
    {
        return view('livewire.quiz-create');
    }
}
