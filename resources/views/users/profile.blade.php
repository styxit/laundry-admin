@extends('adminlte::page')

@section('title', 'User profile')

@section('content_header')
    <h1>User profile</h1>
@stop

@section('content')
    <div class="row">
        <!-- /.col -->
        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
                    <h5 class="widget-user-desc">{{ Auth::user()->email }}</h5>
                </div>
                <div class="widget-user-image">
                    @include('components.users.icon', ['email' => Auth::user()->email ])
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-12 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ Auth::user()->created_at->format('F Y') }}</h5>
                                <span class="description-text">Member since</span>
                            </div>
                            <!-- /.description-block -->
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
    </div>


@stop
