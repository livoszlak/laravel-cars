@extends('layout')
@section('title', 'Car app')
@section('content')
<div class="form-container">
    <p>Hello, {{ $user->name }}!</p>
</div>

<div class="form-container">
    <form action="/logout" method="post">
        @csrf

        <a href="/your-cars" class="btn-dashboard">Your cars</a>
        <a href="/your-times" class="btn-dashboard">Your times</a>
        <a href="/register-car" class="btn-dashboard">Register new car</a>
        <a href="/register-time" class="btn-dashboard">Register new time</a>
        <a href="/leaderboard" class="btn-dashboard">Leaderboard</a>
        <div class="form-container">
            <button class="btn-btn-primary" action="submit">Log out {{$user->name}}</button>
        </div>
    </form>
</div>
@include('errors')
@endsection