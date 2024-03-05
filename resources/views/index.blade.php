@extends('layout')

@section('title', 'Car app')
@section('content')
    <form method="post" action="/login">
        @csrf
        <div class="email-container">
            <label for="email">Email</label>
            <input name="email" id="email" type="email" />
        </div>
        <div class="password-container">
            <label for="password">Password</label>
            <input name="password" id="password" type="password" />
        </div>
        <div class="login-container">
        <button class="login" type="submit">Login!</button>
</div>
    </form>
</div>
@include('errors')
<div class="register-container">
<a href="/register" class="btn btn-primary">Register</a>
</div>
