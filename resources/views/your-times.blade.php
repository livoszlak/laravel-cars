@extends('layout')
@section('title', 'Car app')
@section('content')
<div>
    <h1>Your times</h1>
@if($user->laptimes != null)

        <div class="leaderboard-parent">
            <div class="leaderboard-container">
                <table class="leaderboard">
                    <thead class="leaderboard-head">

                        <tr>
                            <th>#</th>
                            <th>Car</th>
                            <th>Lap Time</th>
                            <th>track</th>
                            <th>Registration Number</th>
                            <th>Date</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody class="leaderboard-body">
                        @foreach($user->laptimes as $index => $laptime)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $laptime->car->model }}</td>
                            <td>{{$laptime->time}}</td>
                            <td>{{$laptime->track->track_name}}</td>
                            <td>{{ $laptime->car->registration_number }}</td>
                            <td>{{$laptime->date}}</td>
                            <form action="laptimes/{{$laptime->id}}/delete" method="post">

                                @csrf
                                @method('patch')
                                <td><button type="submit">Delete</button></td>
                            </form>
                        </tr>
                        @endforeach
  </tbody>
</table>
</div>
</div>

@endif
</div>

@if ($user->laptimes != null && count($user->laptimes) > 0)
<h3>Update time</h3>
<form class="form-container" action="laptimes/update" method="post">
    @csrf
    <div class="row-container">
    <label for="laptime_id">Laptime: </label>

    <select name="laptime_id" id="laptime_id"> </div>
        @foreach ($user->laptimes as $laptime)
        <option value="{{ $laptime->id }}">{{ $laptime->date }} {{ $laptime->car->model }} {{ $laptime->car->registration_number }}</option>
        @endforeach
    </select>
    <div class="row-container">
        <label for="date">Date: </label>
        <input type="date" name="date" id="date">
    </div>
    <div class="row-container">
    <label for="time">Time in 00:00:000 format: </label>
    <input type="text" name="time" id="time">
    </div>
    <div class="row-container">
        <label for="track">Track: </label>
        <select name="track_id" id="track_id">
        @foreach($tracks as $track)
        <option value="{{ $track->id }}">{{ $track->track_name }}</option>
        @endforeach
    </div>
    </select>
    <div class="row-container">
    <button type="submit">Update time</button>
    </div>
</form>
@endif
@include('errors')
@endsection
