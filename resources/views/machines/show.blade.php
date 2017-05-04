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
            <div class="box box-warning">
                <div class="box-header with-border">
                    <i class="fa fa-play-circle-o"></i>
                    <h3 class="box-title">Jobs</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Started</th>
                            <th>Duration</th>
                            <th>Remaining</th>
                            <th>Completed</th>
                            <th>ID</th>
                        </tr>
                        @foreach ($machine->jobs as $job)
                            <tr>
                                <td>{{ link_to_route('machine_job.show', $job->created_at->format('d-m-Y G:i:s'), [$job->id]) }}</td>
                                <td>{{ $job->duration->format('G\h i\m') }}</td>
                                <td>{{$job->states->first()->seconds_remaining->format('G\h i\m') }}</td>
                                <td>{{ $job->completed }}</td>
                                <td>{{ $job->id }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <i class="fa fa-bolt"></i>
                    <h3 class="box-title">States</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Remaining</th>
                            <th>Job</th>
                        </tr>
                        @foreach ($machine->states as $state)
                            <tr>
                                <td>{{ $state->id }}</td>
                                <td>{{ $state->seconds_remaining->timestamp }}</td>
                                <td>{{ link_to_route('machine_job.show', $state->job->id, [$state->job->id]) }}</td>
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
