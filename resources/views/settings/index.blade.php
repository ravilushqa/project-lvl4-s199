@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="text-center justify-content-between align-items-center mb-3">
                <span class="text-muted">Add tag</span>
            </h4>
            {!! form($tagForm) !!}
            <hr>
            
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="text-center justify-content-between align-items-center mb-3">
                <span class="text-muted">Tags list</span>
            </h4>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr id="tag{{$tag->id}}">
                        <td style="width: 15%">
                            {{ $tag->getKey() }}
                        </td>
                        <td style="width: 40%">
                                {{ $tag->name }}
                        </td>
                        <td style="width: 30%">
                            {{ $tag->updated_at->diffForHumans() }}
                        </td>
                        <td style="width: 15%">
                            <div class="raw">
                                <a href="{{ route('tags.edit', $tag) }}" class="btn">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <button class="btn btn-link btn-delete delete-tag" value="{{$tag->id}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="text-center justify-content-between align-items-center mb-3">
                <span class="text-muted">Add task status</span>
            </h4>
            {!! form($taskStatusForm) !!}
            <hr>

        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="text-center justify-content-between align-items-center mb-3">
                <span class="text-muted">Task statuses list</span>
            </h4>
            <h6 class="text-center justify-content-between align-items-center mb-3 text-muted">Warning! Deleting status will delete associated task</h6>

            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($taskStatuses as $taskStatus)
                    <tr id="taskStatus{{$taskStatus->id}}">
                        <td style="width: 15%">
                            {{ $taskStatus->getKey() }}
                        </td>
                        <td style="width: 40%">
                            {{ $taskStatus->name }}
                        </td>
                        <td style="width: 30%">
                            {{ $taskStatus->updated_at->diffForHumans() }}
                        </td>
                        <td style="width: 15%">
                            <div class="raw">
                                <a href="{{ route('task-statuses.edit', $taskStatus) }}"  class="btn">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <button class="btn btn-link btn-delete delete-taskStatus" value="{{$taskStatus->id}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection