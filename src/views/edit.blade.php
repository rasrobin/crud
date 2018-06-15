@extends('rasrobin\crud::master')

@section('content')
    <div class="container">
        <div class="row">
            <h1>@yield('title', $model::crudTitle())</h1>
            <a href="{{ route($routeResource . '.index') }}">Overview</a>
        </div>
        <div class="row">
            <h3>Edit {{ $entity->getName() }}</h3>
            {{ Form::model($entity, ['method' => 'Patch', 'route' => [$routeResource . '.update', $entity->id]]) }}

            @include("{$model::crudFormTemplate()}")

            {{ Form::submit('Update') }}
            {{ Form::close() }}
        </div>
    </div>
@stop
