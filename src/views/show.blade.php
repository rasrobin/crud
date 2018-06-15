@extends('rasrobin\crud::master')

@section('content')
    <div class="container">
        <div class="row">
            <h1>@yield('title', ucfirst($model::crudEntityName()))</h1>
            <a href="{{ route($routeResource . '.index') }}">Overview</a>
        </div>
        <div class="row">
            <h3>{{ $entity->getName() }}</h3>
            <dl>
                @foreach ($fields as $field)
                    @if($entity->{$field->getId()} === $entity->getName())
                        {{-- do not show name, it's allready in the title --}}
                    @else
                        <dt>{{ $field->getName() }}: </dt><dd>{{ $entity->{$field->getId()} }}</dd>
                    @endif
                @endforeach
            </dl>
            <div class="overview-link">
                <a href="{{ route($routeResource . '.edit', $entity->id) }}">Edit</a>
            </div>
        </div>
    </div>
@stop
