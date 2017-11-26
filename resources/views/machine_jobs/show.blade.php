@extends('adminlte::page')

@section('title', 'Job details')

@section('content_header')
    <h1>Job details <small>{{ $job->machine->name }}</small></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <i class="fa fa-cube"></i>
                    <h3 class="box-title">{{ $job->machine->name }}</h3>
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
                            <div class="info-box">
                                <span class="info-box-icon bg-blue"><i class="fa fa-clock-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Started</span>
                                    <span class="info-box-number">
                                        {{ $job->created_at->format('G:i') }}
                                        <span class="small">{{ $job->created_at->format('d-m-Y') }}</span>
                                    </span>
                                    <span class="info-box-text">Estimated finish time</span>
                                    <span class="info-box-number">
                                        {{ $job->created_at->addSeconds($job->duration->timestamp)->format('G:i') }}
                                        <span class="small">{{ $job->created_at->addSeconds($job->duration->timestamp)->format('d-m-Y') }}</span>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
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
                        @foreach ($job->states as $state)
                            <tr>
                                <td>{{ $state->id }}</td>
                                <td>{{ $state->seconds_remaining->timestamp }}</td>
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
