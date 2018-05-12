<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusStoreRequest;
use App\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskStatuses = TaskStatus::all();

        return response($taskStatuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskStatusStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStatusStoreRequest $request)
    {
        $validated = $request->validated();

        TaskStatus::create($validated);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function show(TaskStatus $taskStatus)
    {
        return response($taskStatus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskStatusStoreRequest $request
     * @param  \App\TaskStatus $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function update(TaskStatusStoreRequest $request, TaskStatus $taskStatus)
    {
        $validated = $request->validated();

        $taskStatus->update($validated);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskStatus $taskStatus
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TaskStatus $taskStatus)
    {
        $taskStatus->delete();

        return redirect()->back();
    }
}
