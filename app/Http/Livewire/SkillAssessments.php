<?php

namespace App\Http\Livewire;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class SkillAssessments extends Component
{

    public $time_limit;
    public $quizId;
    public $count = 1;
    public $sectionId;
    public $quizSize = 1;
    public $questionIds = [];
    public $quizPercentage;
    public $currentQuestion;
    public $setupQuiz = true;
    public $userAnswered = [];
    public $isDisabled = true;
    public $isOptionDisabled = false;
    public $currentQuizAnswers;
    public $showResult = false;
    public $totalQuizQuestions;
    public $learningMode = false;
    public $quizInProgress = false;
    public $answeredQuestions = [];


    public function updatedUserAnswered()
    {
        if ((empty($this->userAnswered) || (count($this->userAnswered) > 1))) {
            $this->isDisabled = true;
        } else {
            $this->isDisabled = false;
        }
    }

    public function getNextQuestion()
    {
        $question =  Question::query()
            ->with('options')
            ->whereNotIn('id', $this->answeredQuestions)
            ->whereIn('id', $this->questionIds)
            ->inRandomOrder()
            ->first();

        if ($question === null) {
            return $this->showResults();
        }
        array_push($this->answeredQuestions, $question->id);

        return $question;
    }

    public function nextQuestion()
    {
        $this->count++;
        $this->currentQuestion = $this->getNextQuestion();
        $this->reset('userAnswered');
        $this->isDisabled = true;
        $this->isOptionDisabled = false;
    }

    public function startQuiz()
    {
        $this->currentQuestion = $this->getNextQuestion();
        $this->quizInProgress = true;
        $this->setupQuiz = false;
    }

    public function showResults()
    {
        $this->quizInProgress = false;
        $this->showResult = true;
    }


    public function submitTimeOut()
    {
        $this->isDisabled = false;
        $this->isOptionDisabled = true;
    }

    public function mount()
    {
        $condition = ['slug' => Route::current()->parameter('slug'), 'status' => 1];

        $this->quizId = Quiz::query()
            ->with(['questions'])
            ->where($condition)
            ->firstOrFail();

        $this->questionIds = $this->quizId->questions->pluck('id')->toArray(); // get all question ids
        $this->time_limit = $this->quizId->time_limit * 60; // convert to seconds
        $this->quizSize = count($this->questionIds);
    }

    public function render()
    {

        return view('livewire.skill-assessments')
            ->layout('layouts.guest', ['title' => 'Skill Assessments']);
    }
}
