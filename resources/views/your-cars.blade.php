@extends('layout')
@section('title', 'Car app')
@section('content')
<div class="form-container">
    <h1>Your cars</h1>
    @if($user->cars != null && count($user->cars) > 0)
    <div class="car-container">
        @foreach($user->cars as $car)
        <div class="car-box">
            <ul>
                <li>{{$car->model}}</li>
                <li>{{$car->registration_number}}</li>
                <li>{{ count($car->laptimes) }} laptimes</li>
                @if(!$car->active)
                <li>Inactive</li>
                @else
                <li>Active</li>
                @endif
            </ul>
            <div class="btn-container">
            <form action="cars/{{$car->id}}/delete" method="post">
                @csrf
                @method('patch')
                <button type="submit">Delete</button>
            </form>
            <form action="cars/toggleActive" method="post">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">
                <button type="submit">@if(!$car->active) Activate @else Inactivate @endif</button>
            </form>
            </div>
        </div>
        @endforeach
    </div>
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
    <button class="btn-btn-primary" type="submit">Update Registration #</button>
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
    <button class="btn-btn-primary" type="submit">Update Model</button>
</form>

{{-- <form class="form-container" action="cars/toggleActive" method="post">
    @csrf
    <label for="car_id">Car: </label>
    <select name="car_id" id="car_id">
        @foreach ($user->cars as $car)
        <option value="{{ $car->id }}">{{ $car->model }} {{ $car->registration_number }}</option>
        @endforeach
    </select>
    <button class="btn-btn-primary" type="submit">Toggle active/inactive</button>
</form> --}}
@endif
@include('errors')
@endsection