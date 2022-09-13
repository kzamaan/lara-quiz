<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Option;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class QuestionList extends Component
{
    use WithPagination;

    public $questionModal = false;
    public $questionIsEdit = false;

    public $questionId;
    public $question;
    public $answerIndex;
    public $topic_id;
    public $options = [
        [
            'option' => null,
            'is_correct' => false,
        ],
        [
            'option' => null,
            'is_correct' => false,
        ],
        [
            'option' => null,
            'is_correct' => false,
        ],
        [
            'option' => null,
            'is_correct' => false,
        ],
    ];
    public $explanation;
    public $selectedPage = false;
    public $selectedItem = [];
    public $searchKey;

    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;

    protected $queryString = ['searchKey' => ['except' => '']];

    protected $listeners = [
        'deleteConfirmed' => 'deleteConfirmed'
    ];

    protected $rules = [
        'question' => 'required',
        'options' => 'required|array',
        'options.0.option' => 'required',
        'options.1.option' => 'required',
        'options.2.option' => 'required',
        'options.3.option' => 'required',
    ];

    protected $messages = [
        'options.0.option.required' => 'Options 1 is required.',
        'options.1.option.required' => 'Options 2 is required.',
        'options.2.option.required' => 'Options 3 is required.',
        'options.3.option.required' => 'Options 4 is required.',
    ];

    /**
     * @return void
     */
    public function addOption(): void
    {
        $this->options[] = [
            'option' => null,
            'is_correct' => false,
        ];
    }

    /**
     * @param $index
     * @return void
     */
    public function correctOption($index): void
    {
        foreach ($this->options as $key => $option) {
            if ($key == $index) {
                $this->answerIndex = $index;
                $this->options[$key]['is_correct'] = true;
            } else {
                $this->options[$key]['is_correct'] = false;
            }
        }
    }

    /**
     * @param $value
     * @return void
     */
    public function updatedSelectedPage($value): void
    {
        $this->selectedItem = $value ? $this->questions->pluck('id')->toArray() : [];
    }

    /**
     * @return void
     */
    public function updatedSelectedItem(): void
    {
        $this->selectedPage = false;
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $this->reset();
        $this->questionModal = true;
        $this->questionIsEdit = false;
    }

    /**
     * @return void
     */
    public function store(): void
    {
        $this->validate();

        try {
            $question = Question::create([
                'question' => $this->question,
                'topic_id' => $this->topic_id,
                'explanation' => $this->explanation
            ]);
            foreach ($this->options as $option) {
                $question->options()->create($option);
            }
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Question Created Successfully!!"
            ]);
            $this->questionModal = false;
            $this->reset();
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Something went wrong!!"
            ]);
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function questionEdit($id): void
    {
        $this->questionModal = true;
        $this->questionIsEdit = true;
        $this->questionId = $id;
        $this->resetErrorBag();

        $question = Question::find($id);
        $this->question = $question->question;
        $this->explanation = $question->explanation;
        $this->options = $question->options;
        $this->topic_id = $question->topic_id;
    }

    /**
     * @return void
     */
    public function update(): void
    {
        $this->validate();

        try {
            Question::find($this->questionId)->update([
                'question' => $this->question,
                'topic_id' => $this->topic_id,
                'explanation' => $this->explanation
            ]);
            foreach ($this->options as $key => $option) {
                $option = Option::find($option['id'])->update([
                    'option' => $option['option'],
                    'is_correct' => $key == $this->answerIndex ? true : false,
                ]);
            }
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Question Updated Successfully!!"
            ]);
            $this->questionModal = false;
            $this->reset();
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
        return Topic::query()->orderBy('name')->get();
    }

    /**
     * @param $columnName
     * @return void
     */
    public function sortBy($columnName): void
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    /**
     * @return string
     */
    public function swapSortDirection(): string
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getQuestionsProperty(): LengthAwarePaginator
    {
        return Question::query()
            ->with(['answer', 'topic'])
            ->where('question', 'like', '%' . $this->searchKey . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->perPage);
    }

    /**
     * @param $questionId
     * @return void
     */
    public function deleteQuestion($questionId): void
    {
        $this->questionId = $questionId;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    /**
     * @return void
     */
    public function deleteConfirmed(): void
    {
        try {
            Question::destroy($this->questionId);
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Question Deleted Successfully!!"
            ]);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Operation failed!"
            ]);
        }
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.question-list')->layoutData([
            'title' => 'Question List'
        ]);
    }
}
