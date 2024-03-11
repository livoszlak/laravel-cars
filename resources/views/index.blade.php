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

@include('errors')
@endsection