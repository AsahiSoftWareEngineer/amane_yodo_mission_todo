<?php

namespace App\View\Components;

use Illuminate\View\Component;

class edit extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $task;

    public $userLists;

    public function __construct($task,$userLists)
    {
        $this->task = $task;
        $this->userLists = $userLists;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.revise');
    }
}
