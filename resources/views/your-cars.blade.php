@extends('layout')
@section('title', 'Car app')
@section ('sidenav')
<div id="mySidenav" class="sidenav">
    <div class="sidenav-logo" onclick="closeNav()">
        <img class="closebtn" src="{{url('assets/Logo-placeholder.svg')}}" alt="Car app logo">
    </div>
    <a href="/dashboard">Dashboard</a>
    <a href="/your-cars">Your cars</a>
    <a href="/your-times">Your times</a>
    <a href="/register-car">Register new car</a>
    <a href="/register-time">Register new time</a>
    <a href="/leaderboard">Leaderboard</a>
</div>
@endsection
@section('content')
<div class="form-container">
    <h1>Your cars</h1>
    @if($user->cars != null && count($user->cars) > 0)
    <div class="car-container">
        @foreach($user->cars as $car)
        <div class="car-box">
            <ul>
                @if(!$car->active)
                <img class="inactive" src="{{url('assets/icon_Car_grey.svg')}}" alt="car icon">
                @else
                <img src="{{url('assets/icon_Car_.svg')}}" alt="car icon">
                @endif
                <li>{{$car->model}}</li>
                <li>{{$car->registration_number}}</li>
                <li>{{ count($car->laptimes) }} laptimes</li>
            </ul>
            <div class="btn-container">
                <form class="form-container" action="cars/{{$car->id}}/delete" method="post">
                    @csrf
                    @method('patch')
                    <button class="delete" type="submit"><img src="{{url('assets/closeicon.svg')}}" alt="car icon"></button>
                </form>
                <form action="cars/toggleActive" method="post">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                    <button class="delete" type="submit"><img src="{{url('assets/Unionunavalible.svg')}}" alt="unavailable icon">{{ !$car->active ? "Activate" : "Inactivate" }}</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="form-container">
    <p>There are no cars</p>
</div>
<a href="/register-car" class="btn-dashboard">Register new car</a>
@endif
</div>

@if ($user->cars != null && count($user->cars) > 0)

<div class="instructions">
    <h2>How to update your car </h2>

    <h3>Register new registration number</h3>


    <p>Car: Choose the car you want to update.</p>


    <p>Registration #: Enter the new registration number.</p>


    <p>Click the "Update Registration #" button.</p>

</div>

<form class="form-container" action="cars/update" method="post">
    <h3>Update car</h3>

    @csrf
    <label for="car_id">Car: </label>
    <select name="id" id="car_id">
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

<div class="instructions">

    <h3>Register new car model</h3>


    <p>Car: Choose the car you want to update.</p>


    <p>Model: Enter the new model name.</p>


    <p>Click the "Update Model" button.</p>

</div>

<form class="form-container" action="cars/update" method="post">
    @csrf
    <label for="car_id">Car: </label>
    <select name="id" id="car_id">
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
@endif
@include('errors')
@endsection