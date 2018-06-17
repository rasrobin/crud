@extends('rasrobin\crud::master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>@yield('title', $model::crudTitle())</h1>
                <p>
                    <a class="btn btn-outline-primary mt-2" href="{{ route($routeResource . '.create') }}" role="button">
                        Add {{ $model::crudEntityName() }}
                    </a>
                </p>
                <div class="overview">
                    @include('rasrobin\crud::overview_ajax')
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @parent

    <script type="text/javascript">
        $(document).ready(function(){
            setOverviewHandlers(document, '{{ route($routeResource . '.index') }}');
        });
    </script>
    <script src="{{ asset('js/crud_overview.js') }}"></script>
@stop
