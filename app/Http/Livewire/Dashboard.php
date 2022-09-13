<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Dashboard extends Component
{

    /**
     * @return Collection
     */
    public function getUsersProperty(): Collection
    {
        return User::query()->where('type', '!=', 'admin')->get();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.dashboard')->layoutData([
            'title' => 'Dashboard',
        ]);
    }
}
