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
                        <th><a href="{{ route('your-times', ['sort' => 'car_model']) }}">Car</a></th>
                        <th><a href="{{ route('your-times', ['sort' => 'time']) }}">Lap time</a></th>
                        <th><a href="{{ route('your-times', ['sort' => 'track']) }}">Track</a></th>
                        <th><a href="{{ route('your-times', ['sort' => 'registration_number']) }}">Registration #</a></th>
                        <th><a href="{{ route('your-times', ['sort' => 'date']) }}">Date</a></th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody class="leaderboard-body">
                    @foreach($laptimes as $index => $laptime)
                    <tr>
                        <td>{{ ($laptimes->currentPage() - 1) * $laptimes->perPage() + $index + 1 }}</td>
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
        @if (count($user->laptimes) == 0)
        <div class="form-container">
            <a href="/register-time" class="btn-dashboard">Register new time</a>
        </div>
        @endif
    </div>
    @endif
</div>

<div> {{ $laptimes->appends(['sort' => $sort])->links() }} </div>

@if ($user->laptimes != null && count($user->laptimes) > 0)
<div class="form-container">
    <h3>Update your laptimes</h3>

    <!-- Form for updating date -->
    <div class="row-container">
        <form class="form-container" action="laptimes/update" method="post">
            @csrf
            <div class="row-container">
                <label for="laptime_id">Laptime</label>
                    <div>
                        <select name="laptime_id" id="laptime_id">
                    </div>
                            @foreach ($user->laptimes as $laptime)
                            <option value="{{ $laptime->id }}">{{ $laptime->date }} {{ $laptime->car->model }} {{ $laptime->car->registration_number }}</option>
                            @endforeach
                        </select>
            </div>
        </div>
            <div class="row-container">
                <label for="date">Date</label>
                    <div>
                        <input type="date" name="date" id="date">
                    </div>
            </div>
            <div class="form-container">
                <button class="btn-btn-primary" type="submit">Update date</button>
            </div>
        </form>

        <!-- Form for updating time -->
        <div class="row-container">
        <form class="form-container" action="laptimes/update" method="post">
            @csrf
            <div class="row-container">
                <label for="laptime_id">Laptime</label>
                    <div>
                        <select name="laptime_id" id="laptime_id">
                    </div>
                            @foreach ($user->laptimes as $laptime)
                                <option value="{{ $laptime->id }}">{{ $laptime->date }} {{ $laptime->car->model }} {{ $laptime->car->registration_number }}</option>
                            @endforeach
                        </select>
            </div>
        </div>
            <div class="row-container">
                <label for="time">Time</label>
                    <div>
                        <input type="text" name="time" id="time" placeholder="00:00:000">
                    </div>
            </div>
            <div class="form-container">
                <button class="btn-btn-primary" type="submit">Update time</button>
            </div>
        </form>

        <!-- Form for updating track -->
        <div class="row-container">
        <form class="form-container" action="laptimes/update" method="post">
            @csrf
            <div class="row-container">
                <label for="laptime_id">Laptime</label>
                    <div>
                        <select name="laptime_id" id="laptime_id">
                    </div>
                        @foreach ($user->laptimes as $laptime)
                            <option value="{{ $laptime->id }}">{{ $laptime->date }} {{ $laptime->car->model }} {{ $laptime->car->registration_number }}</option>
                        @endforeach
                        </select>
            </div>
        </div>
            <div class="row-container">
                <label for="track_id">Track</label>
                <div>
                    <select name="track_id" id="track_id">
                        @foreach($tracks as $track)
                        <option value="{{ $track->id }}">{{ $track->track_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-container">
                    <button class="btn-btn-primary" type="submit">Update track</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
@include('errors')
@endsection