@extends('layouts.page')

@section('title', 'Job details')

@section('content_header')
    <h1>Job #{{ $job->id }} <small>Created {{ $job->created_at->format('G:i d-m-Y') }}</small></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <i class="fa fa-cube"></i>
                    <h3 class="box-title">{{ $job->machine->name }}</h3>
                    <div class="box-tools">
                        {{ link_to_route('machines.show', 'Details', [$job->machine->id], ['class' => 'btn btn-primary btn-sm']) }}
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl>
                        <dt>Brand</dt>
                        <dd>{{ $job->machine->brand }}</dd>
                        <dt>Model</dt>
                        <dd>{{ $job->machine->model }}</dd>
                    </dl>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <i class="fa fa-play-circle-o"></i>
                    <h3 class="box-title">Job</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @include('components.machine_jobs.status', ['job' => $job])
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @include('components.machine_jobs.timer', ['job' => $job])
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <i class="fa fa-bolt"></i>
                    <h3 class="box-title">Job states</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Remaining Seconds</th>
                            <th>Remaining time</th>
                            <th>Created</th>
                        </tr>
                        @foreach ($job->states as $state)
                            <tr>
                                <td>{{ $state->seconds_remaining }}</td>
                                <td>@duration($state->seconds_remaining)</td>
                                <td>
                                    {{ $state->created_at->format('H:i:s') }}
                                    <small>
                                        {{ $state->created_at->format('d-m-Y') }}
                                    </small>
                                </td>
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
