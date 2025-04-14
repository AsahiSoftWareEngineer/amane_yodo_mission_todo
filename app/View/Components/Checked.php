<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checked extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $tasks;

    public $checked;

    public function __construct($tasks,$checked)
    {
        $this->tasks = $tasks;
        $this->checked = $checked;   
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tasks.checked');
    }
}
