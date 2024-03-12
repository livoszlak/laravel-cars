@extends('layout')

@section('title', 'Car app')
@section ('sidenav')
<div id="mySidenav" class="sidenav">
    <div class="sidenav-logo" onclick="closeNav()">
        <img class="closebtn" src="{{url('assets/Logo-placeholder.svg')}}" alt="Car app logo">
    </div>
    <a href="/dashboard">Dashboard</a>
    <a href="/your-cars">Your cars</a>
    <a href="/your-times">Your times</a>
    <a href="/register-car">Register new car</a>
    <a href="/register-time">Register new time</a>
    <a href="/leaderboard">Leaderboard</a>
</div>
@endsection
@section('content')

<div>
    <form action="users" method="post">
        @csrf
        <div class="form-container">
            <label for="name">Username</label>
            <input name="name" id="name" type="text">


            <label for="email">Email</label>
            <input name="email" id="email" type="email" />

            <label for="password">Password</label>
            <input name="password" id="password" type="password" />

            <button class="btn-btn-primary" class="submit" type="submit">Register</button>
        </div>
    </form>
</div>
@include('errors')
@endsection