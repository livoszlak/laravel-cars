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
<div>
    <h1>Your times</h1>
    @if($user->laptimes != null)
    <div class="leaderboard-parent">
        <div class="leaderboard-container">
            <table class="leaderboard">
                <thead class="leaderboard-head">
                    <tr>
                        <th>#</th>
                        <th><a href="{{ route('your-times', ['sort' => 'car_model', 'order' => $order]) }}">Car</a></th>
                        <th><a href="{{ route('your-times', ['sort' => 'time', 'order' => $order]) }}">Lap time</a></th>
                        <th><a href="{{ route('your-times', ['sort' => 'track', 'order' => $order]) }}">Track</a></th>
                        <th><a href="{{ route('your-times', ['sort' => 'registration_number', 'order' => $order]) }}">Registration #</a></th>
                        <th><a href="{{ route('your-times', ['sort' => 'date', 'order' => $order]) }}">Date</a></th>
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
                            <td><button class="delete" type="submit"><img src="{{url('assets/icon-close.svg')}}" alt="Car app logo"></button></td>
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

<div class="instructions">
    <h2> How to update your laptime </h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi.</p>
</div>
<div class="form-container">
    <h3>Update your laptimes</h3>

    <!-- Form for updating date -->
    <div class="row-container">
        <form class="form-container" action="laptimes/update" method="post">
            @csrf
            {{-- @method('patch') --}}
            <div class="row-container">
                <label for="laptime_id">Laptime</label>
                <div>
                    <select name="id" id="laptime_id">
                        @foreach ($user->laptimes as $laptime)
                        <option value="{{ $laptime->id }}">{{ $laptime->date }} {{ $laptime->car->model }} {{ $laptime->car->registration_number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row-container">
                <label for="date">Date</label>
                <div>
                    <input type="date" name="date" id="date" max="{{ date('Y-m-d') }}">
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
                        <select name="id" id="laptime_id">
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
                        <select name="id" id="laptime_id">
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