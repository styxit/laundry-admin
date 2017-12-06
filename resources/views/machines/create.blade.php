@extends('layouts.page')

@section('title', 'Machines')

@section('content_header')
    <h1>Machines</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Create a new machine</h3>
        </div>
        {!! Form::open(['url' => 'machines']) !!}
        <div class="box-body">

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('brand', 'Brand') }}
            {{ Form::text('brand', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('model', 'Model') }}
            {{ Form::text('model', null, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

        {!! Form::close() !!}
        </div>
    </div>
@stop
