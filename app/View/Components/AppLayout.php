<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $currentTab, $title;

    /**
     * tab name
     * @var string
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
