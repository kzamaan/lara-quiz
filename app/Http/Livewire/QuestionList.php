<?php

namespace App\Http\Livewire;

use App\Models\Option;
use App\Models\Question;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class QuestionList extends Component
{
    use WithPagination;

    public $questionModal = false;
    public $questionIsEdit;

    public $questionId;
    public $question;
    public $answerIndex;
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

    public function correctOption($index)
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

    public function create()
    {
        $this->reset();
        $this->questionModal = true;
        $this->questionIsEdit = false;
    }

    public function store()
    {
        $this->validate();

        try {
            $question = Question::create(['question' => $this->question, 'explanation' => $this->explanation]);
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

    public function questionEdit($id)
    {
        $this->questionModal = true;
        $this->questionIsEdit = true;
        $this->questionId = $id;
        $this->resetErrorBag();

        $question = Question::find($id);
        $this->question = $question->question;
        $this->explanation = $question->explanation;
        $this->options = $question->options;
    }

    public function update()
    {
        $this->validate();

        try {
            Question::find($this->questionId)->update(['question' => $this->question, 'explanation' => $this->explanation]);
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

    public function getQuestionsProperty()
    {
        return Question::query()->latest()->paginate(10);
    }

    public function deleteQuestion($questionId)
    {
        $this->questionId = $questionId;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteConfirmed()
    {
        try {
            Question::destroy($this->questionId);
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Question Deleted Successfully!!"
            ]);
            return redirect()->back();
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Operation failed!"
            ]);
            return redirect()->back();
        }
    }
    public function render()
    {
        return view('livewire.question-list');
    }
}
