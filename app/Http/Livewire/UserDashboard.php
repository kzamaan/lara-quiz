<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Livewire\Component;
use Livewire\WithPagination;

class UserDashboard extends Component
{
    use WithPagination;


    public function getQuizzesProperty()
    {
        return Quiz::query()->where('status', 1)->paginate(15);
    }
    public function render()
    {
        return view('livewire.user-dashboard')
            ->layout('layouts.guest', [
                'title' => 'Dashboard'
            ]);
    }
}
