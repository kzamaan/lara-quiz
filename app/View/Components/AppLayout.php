<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public $currentTab, $title;

    /**
     * @param string $currentTab
     * @param string $title
     * @return void
     */
    function __construct(string $currentTab = null, string $title = null)
    {
        $this->title = $title;
        $this->currentTab = $currentTab;
    }
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    function render()
    {
        return view('layouts.app');
    }
}
