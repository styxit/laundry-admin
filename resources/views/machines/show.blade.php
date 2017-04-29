@extends('adminlte::page')

@section('title', 'Machines')

@section('content_header')
    <h1>Machine details</h1>
@stop

@section('content')
    <h2>{{ $machine['name'] }}</h2>
@stop
