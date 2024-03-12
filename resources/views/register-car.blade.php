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

    <form class="form-container" action="cars" method="post">
        <h3>Add car</h3>
        @csrf
        <label for="registration_number">Registration #
        </label>
        <input type="text" name="registration_number" id="registration_number">
        <label for="model">Model </label>
        <input type="text" name="model" id="model">
        <button class="btn-btn-primary" type="submit">Add car</button>
    </form>
</div>
@include('errors')
@endsection