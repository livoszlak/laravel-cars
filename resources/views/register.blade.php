@extends('layout')

@section('title', 'Car app')
@section('content')

<div>
    <form action="users" method="post">
        @csrf
        <div class="form-container">
            <label for="name">Username</label>
            <input name="name" id="name" type="text">


            <label for="email">Email</label>
            <input name="email" id="email" type="email" />

            <label for="password">Password</label>
            <input name="password" id="password" type="password" />

        <button class="submit" type="submit">Register</button>
    </div>
    </form>
</div>
@include('errors')
@endsection
