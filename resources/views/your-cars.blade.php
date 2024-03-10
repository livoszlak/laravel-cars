@extends('layout')
@section('title', 'Car app')
@section('content')
<div class="form-container">
    <h1>Your cars</h1>
    @if($user->cars != null && count($user->cars) > 0)
    <ul>
        @foreach($user->cars as $car)
        <li>
            <form action="cars/{{$car->id}}/delete" method="post">
                @csrf
                @method('patch')
                {{$car->model}} {{$car->registration_number}} {{ $car->active }}
                <button type="submit">Delete</button>
            </form>
        </li>
        @endforeach
    </ul>
    @else
    <div class="form-container">
        <p>There are no cars</p>
    </div>
    <a href="/register-car" class="btn-dashboard">Register new car</a>
    @endif
</div>

@if ($user->cars != null && count($user->cars) > 0)

<form class="form-container" action="cars/update" method="post">
<h3>Update car</h3>

    @csrf
    <label for="car_id">Car: </label>
    <select name="car_id" id="car_id">
        @foreach ($user->cars as $car)
        @if ($car->active == true)
        <option value="{{ $car->id }}">{{ $car->model }} {{ $car->registration_number }}</option>
        @endif
        @endforeach
    </select>
    <label for="registration_number">Registration #: </label>
    <input type="text" name="registration_number" id="registration_number">
    <button type="submit">Update Registration #</button>
</form>

<form class="form-container" action="cars/update" method="post">
    @csrf
    <label for="car_id">Car: </label>
    <select name="car_id" id="car_id">
        @foreach ($user->cars as $car)
        @if ($car->active == true)
        <option value="{{ $car->id }}">{{ $car->model }} {{ $car->registration_number }}</option>
        @endif
        @endforeach
    </select>
    <label for="model">Model: </label>
    <input type="text" name="model" id="model">
    <button type="submit">Update Model</button>
</form>

<form class="form-container" action="cars/toggleActive" method="post">
    @csrf
    <label for="car_id">Car: </label>
    <select name="car_id" id="car_id">
        @foreach ($user->cars as $car)
        <option value="{{ $car->id }}">{{ $car->model }} {{ $car->registration_number }}</option>
        @endforeach
    </select>
    <button type="submit">Toggle active/inactive</button>
</form>
@endif
@include('errors')
@endsection