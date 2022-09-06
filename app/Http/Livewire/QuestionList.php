<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Exception;
use Livewire\Component;

class QuestionList extends Component
{
    public $questionCreateModal = false;


    public $question;
    public $options = [];
    public $correctOption;
    public $explanation;

    protected $rules = [
        'question' => 'required',
        'options' => 'required|array',
        'options.0' => 'required',
        'options.1' => 'required',
        'options.2' => 'required',
        'options.3' => 'required',
    ];

    protected $messages = [
        'options.0.required' => 'Options 1 is required.',
        'options.1.required' => 'Options 2 is required.',
        'options.2.required' => 'Options 3 is required.',
        'options.3.required' => 'Options 4 is required.',
    ];

    public function correctOption($index)
    {
        $this->correctOption = $index;
    }

    public function submit()
    {
        $this->validate();

        try {
            $question = Question::create(['question' => $this->question, 'explanation' => $this->explanation]);

            foreach ($this->options as $key => $option) {
                $question->options()->create([
                    'option' => $option,
                    'is_correct' => $this->correctOption == $key ? 1 : 0,
                ]);
            }
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Question Created Successfully!!"
            ]);
            $this->questionCreateModal = false;
            $this->correctOption = null;
            $this->reset();
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Something went wrong!!"
            ]);
        }



        //dd($question->options);
    }

    public function getQuestionsProperty()
    {
        return Question::query()->get();
    }
    public function render()
    {
        return view('livewire.question-list');
    }
}
