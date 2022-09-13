<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Livewire\Component;

class SkillAssessments extends Component
{
    // get the slug from the route
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }


    public function render()
    {
        $quiz = Quiz::query()
            ->with(['questions'])
            ->where('slug', $this->slug)
            ->firstOrFail();

        return view('livewire.skill-assessments', [
            'quiz' => $quiz
        ])->layout('layouts.guest', ['title' => 'Skill Assessments']);
    }
}
