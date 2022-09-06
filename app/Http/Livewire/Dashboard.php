<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    // get users
    public function getUsersProperty()
    {
        return User::query()->where('type', '!=', 'admin')->get();
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
