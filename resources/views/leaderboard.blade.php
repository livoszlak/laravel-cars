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

<div class="dropdown-align">
    <div class="dropdown">
        <button class="dropbtn">Select track</button>
        <div class="dropdown-content">
            @foreach ($tracks as $track)
            <a href="{{ url('leaderboard/' . $track->id) }}">{{ $track->track_name }}</a>
            @endforeach
        </div>
    </div>
</div>

<div class="current-track">
    {{ $currentTrack }}
</div>

<div class="leaderboard-parent">
    <div class="leaderboard-container">
        <table class="leaderboard">
            <thead class="leaderboard-head">
                <tr>
                    <th class="white-th">#</th>
                    <th>Driver</th>
                    <th>Car</th>
                    <th>Lap time</th>
                    <th>Date</th>
                    <th>Registration #</th>
                </tr>
            </thead>
            <tbody class="leaderboard-body">
                @foreach($laptimes as $index => $laptime)
                <tr>
                    <td class="white-th">{{ $index + 1 }}</td>
                    <td>{{ $laptime->user->name }}</td>
                    <td>{{ $laptime->car->model }}</td>
                    <td>{{ $laptime->time }}</td>
                    <td>{{ $laptime->date }}</td>
                    <td>{{ $laptime->car->registration_number }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection