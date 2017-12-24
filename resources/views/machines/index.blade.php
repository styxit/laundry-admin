@extends('layouts.page')

@section('title', 'Machines')

@section('content_header')
    <h1>Machines</h1>
@stop

@section('content')
    @foreach ($machines as $machine)
        <div class="row">
            <div class="col-sm-4">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <i class="fa fa-cube"></i>
                        <h3 class="box-title">{{ $machine->name }}</h3>
                        <div class="box-tools">
                            {{ link_to_route('machines.show', 'Details', [$machine->id], ['class' => 'btn btn-primary btn-sm']) }}
                        </div>
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
            <div class="col-sm-8">
                @if (!$machine->jobs->isEmpty())
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <i class="fa fa-play-circle-o"></i>
                            <h3 class="box-title">Latest job <small>Job # {{ $machine->jobs->first()->id }}</small></h3>
                            <div class="box-tools">
                                {{ link_to_route('machine_job.show', 'Details', [$machine->jobs->first()->id], ['class' => 'btn btn-primary btn-sm']) }}
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    @include('components.machine_jobs.status', ['job' => $machine->jobs->first()])
                                </div>
                                <div class="col-sm-6">
                                    @include('components.machine_jobs.timer', ['job' => $machine->jobs->first()])
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                @endif
                <!-- /.box -->
            </div>
        </div>
    @endforeach
@stop
