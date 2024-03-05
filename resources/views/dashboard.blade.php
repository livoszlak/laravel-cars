@extends('layout')
@section('title', 'Car app')
@section('content')
<div class="form-container">
    <h1>This is the dashboard</h1>
    <p>Hello, {{ $user->name }}!</p>
</div>

<div class="form-container">
<form action="/logout" method="post">
    @csrf

<a href="/profile" class="btn btn-primary">To profile</a>
<a href="/leaderboard" class="btn btn-primary">To leaderboard</a>

<button class="submit" action="submit">Logout {{$user->name}}</button>
</form>
</div>
@include('errors')
@endsection
