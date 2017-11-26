@extends('adminlte::page')

@section('title', 'Machines')

@section('content_header')
    <h1>Machines</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-9">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Machines</h3>
                    <div class="box-tools">
                        {{ link_to_action('MachineController@create', 'Add new', [], ['class' => 'btn btn-primary btn-sm']) }}
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created</th>
                        </tr>
                        @foreach ($machines as $machine)
                            <tr>
                                <td>{{ $machine->id }}</td>
                                <td>
                                    {{ link_to_route('machines.show', $machine->name, [$machine->id]) }}
                                </td>
                                <td>
                                    {{ $machine->created_at->format('d-m-Y G:i:s') }}
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
