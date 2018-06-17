@extends('rasrobin\crud::master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m-b-md">
                <h1>@yield('title', $model::crudTitle())</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>Add</h2>
                {{ Form::open(['route' => $routeResource . '.store']) }}

                @include("{$model::crudFormTemplate()}")

                {{ Form::submit('Add') }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
