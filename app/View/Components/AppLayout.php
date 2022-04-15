<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $title;
    public $routeSearch;
    public function __construct($title,$routeSearch)
    {
        $this->title = $title;
        $this->routeSearch = $routeSearch;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app');
    }
}
