@extends('layout')
@section('title', 'Car app')
@section('content')
<div>

    <form class="form-container" action="cars" method="post">
        <h3>Add car</h3>
        @csrf
        <label for="registration_number">Registration #
        </label>
        <input type="text" name="registration_number" id="registration_number">
        <label for="model">Model </label>
        <input type="text" name="model" id="model">
        <button class="btn-btn-primary" type="submit">Add car</button>
    </form>
</div>
@include('errors')
@endsection