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
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td style="width: 15%">
                            {{ $tag->getKey() }}
                        </td>
                        <td style="width: 30%">
                            <a href="{{ route('tags.edit', $tag->getKey()) }}">
                                {{ $tag->name }}
                            </a>
                        </td>
                        <td style="width: 30%">
                            {{ $tag->updated_at->diffForHumans() }}
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
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Updated</th>
                </tr>
                </thead>
                <tbody>
                @foreach($taskStatuses as $taskStatus)
                    <tr>
                        <td style="width: 15%">
                            {{ $taskStatus->getKey() }}
                        </td>
                        <td style="width: 30%">
                            <a href="{{ route('task-statuses.edit', $taskStatus->getKey()) }}">
                                {{ $taskStatus->name }}
                            </a>
                        </td>
                        <td style="width: 30%">
                            {{ $taskStatus->updated_at->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection