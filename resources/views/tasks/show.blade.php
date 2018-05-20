@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-1">
                <h4 class="mb-3">{{ $task->name }}</h4>

                <form action="{{ route('tasks.update', ['task' => $task->getKey()]) }}" method="POST" class="needs-validation" novalidate>
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    <div class="mb-3">
                        <label for="name">Name</label>
                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   value="{{ $task->name }}"
                                   placeholder="Task name"
                                   required
                                >
                            <div class="invalid-feedback" style="width: 100%;">
                                Task name is required.
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="description">Description <small class="text-muted">Optional</small></label>
                        <div class="input-group">
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $task->description }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status">Status</label>
                        <div class="input-group">
                            <select name="status_id" id="status" class="form-control">
                                @foreach($statuses as $key => $status)
                                    <option value="{{ $key }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="assigned">Assigned to</label>
                        <div class="input-group">
                            <select name="assigned_id" id="assigned" class="form-control">
                                @foreach($users as $key => $user)
                                    <option value="{{ $key }}">{{ $user }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tags">Tags <small class="text-muted">Optional</small></label>
                        <div class="input-group">
                            <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                @foreach($tags as $key => $tag)
                                    <option value="{{ $key }}">{{ $tag }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block"
                            type="submit"
                    >
                        Update profile
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection