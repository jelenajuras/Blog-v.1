@extends('layouts.admin')

@section('title', 'Admin - Dashboard')

@section('content')
<div >
    @if (Sentinel::check())
    <div>
        <h3>Hello, {{ Sentinel::getUser()->email }}!</h3>
        <p>You are now logged in.</p>
		
		
    </div>
    @else
        <div >
            <h3>Welcome, Guest!</h3>
            <p>You must login to continue.</p>
            <p><a class="btn btn-primary btn-lg" href="{{ route('auth.login.form') }}" role="button">Log In</a></p>
        </div>
    @endif
</div>
@stop
