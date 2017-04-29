@extends('adminlte::page')

@section('title', 'Machines')

@section('content_header')
    <h1>Machines</h1>
@stop

@section('content')
    <p>All machines.</p>
    <table>
        @foreach ($machines as $machine)
            <tr>
                <td>{{ $machine['id'] }}</td>
                <td>
                {{ link_to_action('MachineController@show', $machine['name'], [$machine['id']]) }}
            </tr>
        @endforeach
    </table>
@stop
