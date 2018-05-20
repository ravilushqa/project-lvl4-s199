@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 order-md-1">

                <h4 class="mb-3">Tasks</h4>

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
                                <a href="{{ route('tasks.show', $task->getKey()) }}">
                                    {{ $task->getKey() }}
                                </a>
                            </td>
                            <td>{{ $task->status->name }}</td>
                            <td>
                                <a href="{{ route('tasks.show', $task->getKey()) }}">
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
            </div>
        </div>
    </div>
@endsection