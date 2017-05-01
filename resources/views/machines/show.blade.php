@extends('adminlte::page')

@section('title', 'Machines')

@section('content_header')
    <h1>Machine details <small>{{ $machine['name'] }}</small></h1>
@stop

@section('content')
    <h2>{{ $machine['name'] }}</h2>
    <h2>Brand {{ $machine['brand'] }}</h2>
    <h2>Model {{ $machine['model'] }}</h2>
@stop
