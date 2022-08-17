<?php

namespace App\Http\Controllers;

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
     * @return Response
     */
    public function create()
    {
        //
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
        ]);

        $taskService->saveTask($payload);

        return redirect()->back();
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
     * @return Response
     */
    public function edit($id)
    {
        //
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
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
