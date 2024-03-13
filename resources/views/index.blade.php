@extends('layout')
@section('title', 'Car app')
@section('content')

<div class="hero-container">
    <h1>Welcome to the car app</h1>
    <img class="hero-image" src="{{url('assets/max-bottinger-0k_dCKxyIHc-unsplash.jpg')}}" alt="unavailable icon">
</div>
<div class="button-container">
    <a href="/login" class="btn-btn-primary">Login</a>
    <a href="/register" class="btn-btn-primary">Register</a>
</div>

<div class="instructions">
    <h2> About </h2>
    <p>Introducing insert app name: the premier app for tracking lap times on tracks worldwide. Record your best times, compare with global leaderboards, and share your achievements. With TrackMaster, you're always in the race. Login now and start your journey to the top!
    </p>
</div>

@include('errors')
@endsection