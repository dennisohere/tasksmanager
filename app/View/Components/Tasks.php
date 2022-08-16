<?php

namespace App\View\Components;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Tasks extends Component
{
    /**
     * @var Collection | Task[]
     */
    public Collection|array $tasks;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(TaskService $taskService)
    {
        $this->tasks = $taskService->getTasks();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tasks');
    }
}
