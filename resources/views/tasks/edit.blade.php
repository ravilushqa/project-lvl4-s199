@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 order-md-1">
            <h4 class="mb-3">Task edit</h4>
                {!! form($form) !!}
        </div>
    </div>
@endsection