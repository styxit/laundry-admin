@extends('layouts.page')

@section('title', 'User profile')

@section('content_header')
    <h1>User profile</h1>
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
    </div>
@stop
