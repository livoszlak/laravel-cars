@extends('layout')
@section('title', 'Car app')
@section('content')

<div class="hero-container">

</div>
    <form method="post" action="/login">
        @csrf
    <div class="form-container">

            <label for="email">Email</label>
            <input name="email" id="email" type="email" />


            <label for="password">Password</label>
            <input name="password" id="password" type="password" />
            <button class="login" type="submit">Login!</button>
    </div>
        <div class="register-container">

        <a href="/register" class="btn btn-primary">Register</a>
</div>
    </form>
@include('errors')
@endsection
