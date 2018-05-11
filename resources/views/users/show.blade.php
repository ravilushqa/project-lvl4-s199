@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-1">
                <h4 class="mb-3">Main settings</h4>

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
        </div>
    </div>
@endsection