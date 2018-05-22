<?php

namespace App\Http\Controllers;

use App\Filters\TaskFilters;
use App\Forms\TaskFilterForm;
use App\Forms\TaskForm;
use App\Http\Requests\TaskStoreRequest;
use App\Tag;
use App\Task;
use App\TaskStatus;
use App\User;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param TaskFilters $filters
     * @return \Illuminate\Http\Response
     */
    public function index(TaskFilters $filters, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(TaskFilterForm::class, [
            'method' => 'GET',
            'url' => route('tasks.index'),
        ]);
        $tasks = $this->getTasks($filters);

        return view('tasks.index', compact('tasks', 'form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(TaskForm::class, [
            'method' => 'POST',
            'url' => route('tasks.store')
        ]);

        return view('tasks.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        $validated = $request->validated();

        $task = Task::create($validated);

        $task->tags()->sync($request->tags);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $tags = Tag::pluck('name', 'id')->toArray();

        $statuses = TaskStatus::pluck('name', 'id')->toArray();

        $users = User::pluck('name', 'id')->toArray();

        return view('tasks.show', compact('task', 'tags', 'statuses', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task $task
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(TaskForm::class, [
            'method' => 'PUT',
            'url' => route('tasks.update', $task),
            'model' => $task
        ]);

        return view('tasks.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskStoreRequest $request, Task $task)
    {
        $validated = $request->validated();

        $task->update($validated);

        $task->tags()->sync($request->tags);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task $task
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->back();
    }

    /**
     * @param TaskFilters $filters
     * @return mixed
     */
    protected function getTasks(TaskFilters $filters)
    {
        $threads = Task::with([
            'tags',
            'status',
            'assignedTo'
        ])->latest()->filter($filters);

        return $threads->paginate(10);
    }
}
