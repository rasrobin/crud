@extends('master')

@section('title', $titel)

@section('js')
    @parent

@stop

@section('content')
    <div class="container">
        <h1>@yield('title')</h1>
        <table>
            <tr>
                <td>test</td><td>test</td>
            </tr>
        </table>
    </div>
@stop
