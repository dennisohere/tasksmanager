<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array|Collection
     */
    public function index(TaskService $taskService): Collection|array
    {
        return $taskService->getTasks();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.tasks.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, TaskService $taskService): RedirectResponse
    {
        $payload = $this->validate($request, [
            'id' => 'sometimes',
            'title' => 'required',
            'project' => 'nullable|string',
        ]);

        $taskService->saveTask($payload);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(TaskService $taskService, $id)
    {
        $task = $taskService->getTaskById($id);

        return view('pages.tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, TaskService $taskService, $id)
    {
        $payload = $this->validate($request, [
            'id' => 'sometimes',
            'title' => 'required',
        ]);

        $taskService->saveTask($payload);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePriority(Request $request, TaskService $taskService, $id)
    {
        $payload = $this->validate($request, [
            'new_priority' => 'required|integer',
        ]);

        $taskService->updateTaskPriority($id, $payload['new_priority']);

        return $taskService->getTasks();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Task::destroy($id);
        return back();
    }
}
