@extends('adminlte::page')

@section('title', 'Machines')

@section('content_header')
    <h1>Machine details <small>{{ $machine->name }}</small></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <i class="fa fa-cube"></i>
                    <h3 class="box-title">{{ $machine->name }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl>
                        <dt>Brand</dt>
                        <dd>{{ $machine->brand }}</dd>
                        <dt>Model</dt>
                        <dd>{{ $machine->model }}</dd>
                    </dl>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <i class="fa fa-flash"></i>
                    <h3 class="box-title">States</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        @foreach ($machine->states as $state)
                            <tr>
                                <td>{{ $state->id }}</td>
                                <td>{{ $state->seconds_remaining }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop
