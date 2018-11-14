@extends('layouts.page')

@section('title', 'User settings')

@section('content_header')
    <h1>User settings</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="@include('components.gravatar_url', ['email' => Auth::user()->email ])" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                    <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Timezone</b> <span class="pull-right">{{ Auth::user()->timezone }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Member since</b> <a class="pull-right">{{ Auth::user()->created_at->format('F Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Machines</b> <a class="pull-right">{{ Auth::user()->machines()->count() }}</a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-8">
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title">User</h3>
                </div>

                <div class="box-body">
                    {{ Form::model(Auth::user(), ['route' => 'user.save', 'method' => 'POST']) }}

                    <div class="form-group">
                        {{ Form::label('timezone', 'Time zone') }}
                        {{ Form::select('timezone', $timezones, null, ['id' => 'timezone', 'class' => 'form-control']) }}
                        <span class="help-block">Used to display dates and times in your timezone.</span>
                    </div>

                    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}

                    {{ Form::close() }}
                </div>
            </div>

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Notification services</h3>
                </div>

                <div class="box-body">
                    <blockquote>If no notification services are configured, email is used to send notifications.</blockquote>
                    {{ Form::model(Auth::user(), ['route' => 'user.save', 'method' => 'POST']) }}
                    <h3>
                        Pushover
                        <small>
                            @if (isset(Auth::user()->pushover_user_key))
                                <span class="label label-success">Configured</span>
                            @else
                                <span class="label label-default">Not configured</span>
                            @endif
                        </small>
                    </h3>
                    <div class="form-group">
                        {{ Form::label('pushover_user_key', 'User key') }}
                        {{ Form::text('pushover_user_key', null, array('class' => 'form-control', 'placeholder' => 'Your user key')) }}
                        <span class="help-block">Your user key can be found when logged in at <a href="https://pushover.net/" target="_blank">pushover.net</a>.</span>
                    </div>

                    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop
