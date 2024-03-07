@extends('layout')
@section('title', 'Car app')
@section('content')
<div>
    <h3>Add time</h3>
<form class="form-container" action="laptimes" method="post">
    @csrf
    <label for="car">Car: </label>
    <select name="car_id" id="car">
        @if ($user->cars != null && count($user->cars) > 0)
        @foreach ($user->cars as $car)
        <option value="{{ $car->id }}">{{ $car->model }} {{ $car->registration_number }}</option>
        @endforeach
         @endif

    </select>
    <label for="date">Date: </label>
    <input type="date" name="date" id="date">
    <label for="time">Time in 00:00:000: </label>
    <input type="text" name="time" id="time" placeholder="00:00:000">
    <label for="track">Track: </label>
    <select name="track_id" id="track_id">
        @foreach($tracks as $track)
        <option value="{{ $track->id }}">{{ $track->track_name }}</option>
        @endforeach
    </select>
</div>
    <button type="submit">Add record time</button>
</form>
@include('errors')
@endsection
