<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ReviseList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $currentList;

    public function __construct($currentList)
    {
        $this->currentList = $currentList;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lists.revise-list');
    }
}
