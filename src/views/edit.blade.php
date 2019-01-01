@extends('rasrobin\crud::master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>@yield('title', $model::crudTitle())</h1>
                <a href="{{ route($routeResource . '.index') }}">Overview</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Edit {{ $entity->getName() }}</h3>
                {{ Form::model($entity, [
                    'method' => 'Patch',
                    'route' => [$routeResource . '.update', $entity->id],
                    'enctype' => 'multipart/form-data'
                ]) }}

                @include("{$model::crudFormTemplate()}")

                {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
