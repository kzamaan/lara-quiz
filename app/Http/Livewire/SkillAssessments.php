<?php

namespace App\Http\Livewire;

use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Test;
use App\Models\TestAnswer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class SkillAssessments extends Component
{

    public $quiz;
    public $time_limit;
    public $testId;
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


    /**
     * @return void
     */
    public function updatedUserAnswered(): void
    {
        if ((empty($this->userAnswered) || (count($this->userAnswered) > 1))) {
            $this->isDisabled = true;
        } else {
            $this->isDisabled = false;
        }
    }

    /**
     * @return object
     */
    public function getNextQuestion(): object
    {
        $question = Question::query()
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

    /**
     * @return void
     */
    public function startQuiz(): void
    {
        // check if user has already started the quiz
        $this->testId = Test::query()
            ->where('user_id', auth()->id())
            ->where('quiz_id', $this->quiz->id)
            ->first();
        if ($this->testId) {
            $this->showResults();
        } else {
            $this->testId = Test::query()->create([
                'user_id' => auth()->id(),
                'quiz_id' => $this->quiz->id,
                'completed' => false,
            ]);
            $this->currentQuestion = $this->getNextQuestion();
            $this->quizInProgress = true;
        }
        $this->setupQuiz = false;
    }

    /**
     * @return void
     */
    public function nextQuestion(): void
    {
        // Push all the question ids to quiz_header table to retrieve them while displaying the quiz details
        $this->testId->questions_taken = serialize($this->answeredQuestions);
        // Retrieve the answer_id and value of answers clicked by the user and push them to Quiz table.
        if (isset($this->userAnswered[0])) {
            list($answerId, $isChoiceCorrect) = explode(',', $this->userAnswered[0]);
        }

        TestAnswer::query()->create([
            'test_id' => $this->testId->id,
            'user_id' => auth()->user()->id,
            'question_id' => $this->currentQuestion->id,
            'option_id' => $answerId ?? '',
            'correct' => $isChoiceCorrect ?? '',
        ]);

        // Increment the quiz counter so we terminate the quiz on the number of question user has selected during quiz creation.
        $this->count++;
        // Reset the variables for next question
        $answerId = '';
        $isChoiceCorrect = '';
        $this->reset('userAnswered');
        $this->isDisabled = true;
        $this->isOptionDisabled = false;

        // Finish the quiz when user has successfully taken all question in the quiz.
        if ($this->count == $this->quizSize + 1) {
            $this->showResults(true);
        } else {
            $this->currentQuestion = $this->getNextQuestion();
        }
    }

    /**
     * @param bool $isCompleted
     * @return void
     */
    public function showResults(bool $isCompleted = false): void
    {
        // Get a count of total number of quiz questions in Quiz table for the just finisned quiz.
        $this->totalQuizQuestions = count($this->questionIds);

        // Get a count of correctly answered questions for this quiz.
        $this->currentQuizAnswers = Test::query()
            ->with(['answers' => function ($query) {
                $query->where('correct', 1);
            }])
            ->where('quiz_id', $this->quiz->id)
            ->first()
            ->answers
            ->count();

        // calculate score for updating the quiz_header table before finishing the quid.
        $this->quizPercentage = round(($this->currentQuizAnswers / $this->totalQuizQuestions) * 100, 2);

        // Push all the question ids to quiz_header table to retrieve them while displaying the quiz details
        $this->testId->questions_taken = serialize($this->answeredQuestions);

        // Update the status of quiz as completed, this is used to resuming any uncompleted/abandoned quizzes
        if ($isCompleted) {
            $this->testId->completed = true;
        }

        // Insert the quiz score to quiz_header table
        $this->testId->score = $this->quizPercentage;

        // Save the update.
        $this->testId->save();

        // Hide quiz div and show result div wrapped in if statements in the blade template.
        $this->quizInProgress = false;
        $this->showResult = true;
    }


    /**
     * @return void
     */
    public function submitTimeOut(): void
    {
        $this->isDisabled = false;
        $this->isOptionDisabled = true;
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $condition = ['slug' => Route::current()->parameter('slug'), 'status' => 1];

        $quiz = Quiz::query()
            ->with(['questions'])
            ->where($condition)
            ->firstOrFail();

        $this->quiz = $quiz;
        $this->questionIds = $quiz->questions->pluck('id')->toArray(); // get all question ids
        $this->time_limit = $quiz->time_limit * 60; // convert to seconds
        $this->quizSize = count($this->questionIds);
    }

    /**
     * @return View
     */
    public function render(): View
    {

        return view('livewire.skill-assessments')->layout('layouts.guest', ['title' => 'Skill Assessments']);
    }
}
