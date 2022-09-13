<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class SkillAssessments extends Component
{

    public function render()
    {
        $quiz = Quiz::query()
            ->withCount('questions')
            ->with(['questions.options'])
            ->where('slug', Route::current()->parameter('slug'))
            ->firstOrFail();

        return view('livewire.skill-assessments', [
            'quiz' => $quiz
        ])->layout('layouts.guest', ['title' => 'Skill Assessments']);
    }
}
