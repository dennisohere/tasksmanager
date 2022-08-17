<?php

namespace App\View\Components;

use App\Models\Project;
use App\Models\Task;
use Illuminate\View\Component;

class TaskForm extends Component
{
    public ?Task $task;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Task $task = null)
    {
        //
        $this->task = $task;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.task-form');
    }
}
