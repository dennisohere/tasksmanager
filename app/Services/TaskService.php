<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

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


}
