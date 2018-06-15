@extends('rasrobin\crud::master')

@section('content')
    <div class="container">
        <div class="row">
            <h1>@yield('title', $model::crudTitle())</h1>
        </div>
        <div class="row">
            <h2>Add</h2>
            {{ Form::open(['route' => $routeResource . '.store']) }}

            @include("{$model::crudFormTemplate()}")

            {{ Form::submit('Add') }}
            {{ Form::close() }}
        </div>
    </div>
@stop
