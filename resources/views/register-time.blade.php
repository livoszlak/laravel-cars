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
<h1>Register time</h1>
<div class="instructions">
    <h2> How to register a new time</h2>

    <p>Car: Choose the car you want to add a new time to.</p>
    <p>Date: Enter the new the date.</p>
    <p>Time: Enter the new time in the format 00:00:000.</p>
    <p>Track: Choose the track where the time was recorded.</p>
    <p>Click the "Add record time" button.</p>
</div>
<div class="form-container">
    <h3>Add time</h3>
    <form class="form-container" action="laptimes" method="post">
        @csrf
        <label for="car">Car: </label>
        <select name="car_id" id="car">
            @if ($user->cars != null && count($user->cars) > 0)
            @foreach ($user->cars as $car)
            <option value="{{ $car->id }}">{{ $car->model }} {{ $car->registration_number }}</option>
            @endforeach
            @endif
        </select>

        <label for="date">Date: </label>

        <input type="date" name="date" id="date" max="{{ date('Y-m-d') }}">
        < <label for="time">Time</label>

            <input type="text" name="time" id="time" placeholder="00:00:000">
            <label for="track">Track: </label>

            <select name="track_id" id="track_id">

                @foreach($tracks as $track)
                <option value="{{ $track->id }}">{{ $track->track_name }}</option>
                @endforeach
            </select>

            <button class="btn-btn-primary" type="submit">Add record time </button>

            @include('errors')
            @endsection