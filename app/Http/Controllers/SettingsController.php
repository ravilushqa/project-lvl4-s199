<?php

namespace App\Http\Controllers;

use App\Forms\TagForm;
use App\Forms\TaskStatusForm;
use App\Tag;
use App\TaskStatus;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FormBuilder $formBuilder)
    {
        $tags = Tag::all();
        $taskStatuses = TaskStatus::all();
        $tagForm = $formBuilder->create(TagForm::class, [
            'method' => 'POST',
            'url' => route('tags.store')
        ]);
        $taskStatusForm = $formBuilder->create(TaskStatusForm::class, [
            'method' => 'POST',
            'url' => route('task-statuses.store')
        ]);

        return view('settings.index', compact([
            'tagForm',
            'taskStatusForm',
            'tags',
            'taskStatuses'
        ]));
    }
}
