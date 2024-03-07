@extends('layout')
@section('title', 'Car app')
@section('content')

<div class="dropdown">
    <button class="dropbtn">Select track</button>
    <div class="dropdown-content">
        <a href="#">track</a>
        <a href="#">track</a>
        <a href="#">track</a>
        <a href="#">track</a>
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
      <th>Registration Number<th>
    </tr>
  </thead>
  <tbody class="leaderboard-body">
    <tr>
      <td>1</td>
      <td>name</td>
      <td>car</td>
      <td>00:00:000</td>
      <td>01-03-2024</td>
      <td>abc123<td>
    </tr>
  </tbody>
</table>
</div>
</div>
@endsection
