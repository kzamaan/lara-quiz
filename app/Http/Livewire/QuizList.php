<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class QuizList extends Component
{
    public $quizModal = false;
    public $selectedPage = false;
    public $selectedItem = [];

    public $title, $slug, $description, $time_limit, $status;
    public $questions = [];
    public $quizId;

    /**
     * @var string[]
     */
    protected $listeners = [
        'deleteConfirmed' => 'deleteConfirmed'
    ];

    /**
     * @var string[]
     */
    protected $rules = [
        'title' => 'required',
        'slug' => 'required|unique:quizzes',
        'questions' => 'required|array|min:1',
        'description' => 'nullable',
        'time_limit' => 'nullable|numeric',
        'status' => 'required|in:0,1',
    ];

    /**
     * @param $value
     * @return void
     */
    public function updatedTitle($value): void
    {
        $this->slug = Str::slug($value);
    }

    /**
     * @param $value
     * @return void
     */
    public function updatedSelectedPage($value): void
    {
        $this->selectedItem = $value ? $this->quizzes->pluck('id')->toArray() : [];
    }

    /**
     * @return mixed
     */
    public function getSelectedQuestionsProperty(): Collection
    {
        return Question::query()->whereIn('id', $this->questions)->get();
    }

    /**
     * @param $id
     * @return void
     */
    public function removeQuestion($id): void
    {
        $this->questions = array_diff($this->questions, [$id]);
    }

    /**
     * @return void
     */
    public function store(): void
    {
        $this->validate();

        try {
            $quiz = Quiz::query()->create([
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'time_limit' => $this->time_limit,
                'status' => $this->status,
            ]);

            $quiz->questions()->attach($this->questions);

            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Quiz Created Successfully!!"
            ]);
            $this->reset();
            $this->quizModal = false;
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Something went wrong!!"
            ]);
        }
    }

    /**
     * @return Collection
     */
    public function getTopicsProperty(): Collection
    {
        return Topic::query()->with(['questions'])->orderBy('name')->get();
    }


    /**
     * @return LengthAwarePaginator
     */
    public function getQuizzesProperty(): LengthAwarePaginator
    {
        return Quiz::query()->withCount(['questions'])->latest()->paginate(10);
    }

    /**
     * @param $id
     * @return void
     */
    public function deleteQuiz($id): void
    {
        $this->quizId = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    /**
     * @return void
     */
    public function deleteConfirmed(): void
    {
        try {
            Quiz::destroy($this->quizId);
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Quiz Deleted Successfully!!"
            ]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Something went wrong!!"
            ]);
        }
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.quiz-list');
    }
}
