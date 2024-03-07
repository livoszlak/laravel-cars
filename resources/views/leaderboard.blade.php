@extends('layout')
@section('title', 'Car app')
@section('content')

<div class="dropdown">
    <button class="dropbtn">Select track</button>
    <div class="dropdown-content">
        @foreach ($tracks as $track)
          <a href="{{ url('leaderboard/' . $track->id) }}">{{ $track->track_name }}</a>
        @endforeach
    </div>
</div>

<div class="leaderboard-parent">
<div class="leaderboard-container">
<table class="leaderboard">
  <thead class="leaderboard-head">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Car</th>
      <th>Lap Time</th>
      <th>Date</th>
      <th>Registration Number</th>
    </tr>
  </thead>
  <tbody class="leaderboard-body">
    @foreach($laptimes as $index => $laptime)
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $laptime->user->name }}</td>
      <td>{{ $laptime->car->model }}</td>
      <td>{{ $laptime->time }}</td>
      <td>{{ $laptime->date }}</td>
      <td>{{ $laptime->car->registration_number }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
@endsection

