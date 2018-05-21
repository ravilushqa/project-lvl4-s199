@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="text-center justify-content-between align-items-center mb-3">
                <span class="text-muted">User settings</span>
            </h4>
            <form action="{{ route('users.update', ['user' => $user->getKey()]) }}" method="POST" class="needs-validation" novalidate>
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                <div class="mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <input type="text"
                               class="form-control"
                               id="username"
                               name="name"
                               value="{{$user->name}}"
                               placeholder="Username"
                               required
                               @cannot('update', $user)
                               disabled
                                @endcannot
                        >
                        <div class="invalid-feedback" style="width: 100%;">
                            Your username is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email"
                           class="form-control"
                           id="email"
                           name="email"
                           value="{{ $user->email }}"
                           placeholder="you@example.com"
                           @cannot('update', $user)
                           disabled
                            @endcannot
                    >
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block"
                        type="submit"
                        @cannot('update', $user)
                        disabled
                        @endcannot
                >
                    Update profile
                </button>
            </form>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="text-center justify-content-between align-items-center mb-3">
                <span class="text-muted">Assigned to user tasks</span>
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
                @foreach($user->tasks as $task)
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
        </div>
    </div>
@endsection