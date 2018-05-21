@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
        <h4 class="text-center justify-content-between align-items-center mb-3">
            <span class="text-muted">Filter tasks</span>
        </h4>
        {!! form($form) !!}

        <hr>
        <div class="row">

            <div class="col-md-4 mb-3">
                <form method="get" action="{{route('tasks.create')}}">
                    <button type="submit" class="btn btn-btn-primary btn-lg">New task</button>
                </form>
            </div>
            <div class="col-md-4 mb-3 ">
                <form method="get" action="{{route('tasks.index')}}">
                    <button type="submit" class="btn btn-secondary btn-lg">Refresh</button>
                </form>
            </div>
        </div>


    </div>
    <div class="col-md-8 order-md-1">
        <h4 class="text-center justify-content-between align-items-center mb-3">
            <span class="text-muted">Tasks list</span>
        </h4>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Name</th>
                <th>Tags</th>
                <th>Assigned to</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>
                        <a href="{{ route('tasks.edit', $task->getKey()) }}">
                            {{ $task->getKey() }}
                        </a>
                    </td>
                    <td>{{ $task->status->name }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->getKey()) }}">
                            {{ $task->name }}
                        </a>
                    </td>
                    <td>
                        {{ implode(' ', $task->tags->pluck('name')->toArray()) }}
                    </td>
                    <td>
                        <a href="{{ route('users.show', $task->assigned_id) }}">
                            {{ $task->assignedTo ? $task->assignedTo->name : ''}}
                        </a>
                    </td>
                    <td>
                        {{ $task->updated_at->diffForHumans() }}
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
        {{ $tasks->links() }}
    </div>
</div>
@endsection