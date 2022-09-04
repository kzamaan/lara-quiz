<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $currentTab;

    /**
     * tab name
     * @var string
     */
    function __construct(string $currentTab = null)
    {
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
