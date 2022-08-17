<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TaskService
{

    public function saveTask($payload): Task
    {
        $should_update = isset($payload['id']);

        /** @var Task $task */
        $task = $should_update  ? Task::query()->find($payload['id']) : new Task();

        $task->name = $payload['title'];
        $task->setTaskPriority($payload['priority'] ?? null, $payload['project_id'] ?? null);
        $task->save();

        return $task;
    }

    public function getTasks(): Collection|array
    {
        return Task::query()
            ->orderBy('priority', 'asc')
            ->get();
    }

    public function updateTaskPriority($id, $new_priority): Task
    {
        /** @var Task $task */
        $task = Task::query()->find($id);

        $old_priority = $task->priority;

        if($new_priority > $old_priority){
            $this->correctTaskPrioritiesBelowCurrent($old_priority, $new_priority);
        } else {
            $this->correctTaskPrioritiesAbovePrevious($old_priority, $new_priority);
        }

        $task->priority = $new_priority;
        $task->save();

        return $task;
    }

    private function correctTaskPrioritiesBelowCurrent($prev, $new): void
    {
        // sort and reorder task according to updated priority
        $tasks = Task::query()
            ->orderBy('priority')
            ->where('priority', '>=', $prev)
            ->where('priority', '<=', $new)
            ->get();


        foreach ($tasks as $t){
            $t->priority = $t->priority - 1;
            $t->save();
        }
    }

    private function correctTaskPrioritiesAbovePrevious($prev, $new): void
    {
        // sort and reorder task according to updated priority
        $tasks = Task::query()
            ->orderBy('priority')
            ->where('priority', '<=', $prev)
            ->where('priority', '>=', $new)
            ->get();

        $current_priority = $new;

        foreach ($tasks as $t){
            $t->priority = $current_priority + 1;
            $t->save();
            $current_priority++;
        }
    }


}
