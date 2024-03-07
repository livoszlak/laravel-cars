@extends('layout')
@section('title', 'Car app')
@section('content')
<form method="post" action="/login">
<div class="form-container">
        @csrf
            <label for="email">Email</label>
            <input name="email" id="email" type="email" />

            <label for="password">Password</label>
            <input name="password" id="password" type="password" />
            <button class="login" type="submit">Login</button>
        </div>
    </form>
@include('errors')
@endsection