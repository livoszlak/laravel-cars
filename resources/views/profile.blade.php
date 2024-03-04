<p>Hello, {{$user->name}}!</p>
<p>Profile page - your cars and their records live here</p>
<br>

<h1>Your cars</h1>
@if($user->cars != null && count($user->cars) > 0)
<ul>
@foreach($user->cars as $car)
<li>
    <form action="cars/{{$car->id}}/delete" method="post">
        @csrf
        @method('patch')
    {{$car->model}} {{$car->registration_number}}
    <button type="submit">Delete</button>
    </form>
</li>
@endforeach
</ul>
@endif
<h1>Your record times</h1>
@if($user->laptimes != null)
<ul>
    @foreach($user->laptimes as $laptime)
    <li>
        <form action="laptimes/{{$laptime->id}}/delete" method="post">
            @csrf
            @method('patch')
        Laptime id: {{ $laptime->id }} Car: {{ $laptime->car->model }} Date: {{$laptime->date}} Time: {{$laptime->time}} Track: {{$laptime->track->track_name}} Track length: {{$laptime->track->track_length}}km
        <button type="submit">Delete</button>
        </form>
    </li>
    @endforeach
</ul>
@endif
<h3>Add car</h3>
<form action="cars" method="post">
    @csrf
    <label for="registration_number">Registration number: </label>
    <input type="text" name="registration_number" id="registration_number">
    <label for="model">Model: </label>
    <input type="text" name="model" id="model">
    <button type="submit">Add car</button>
</form>
<h3>Add time</h3>
<form action="laptimes" method="post">
    @csrf
    <label for="car">Car: </label>
    <select name="car_id" id="car">
        @if ($user->cars != null && count($user->cars) > 0)
        @foreach ($user->cars as $car)
        <option value="{{ $car->id }}">{{ $car->model }}</option>
        @endforeach
         @endif
    </select>
    <label for="date">Date: </label>
    <input type="date" name="date" id="date">
    <label for="time">Time in minutes:seconds format: </label>
    <input type="text" name="time" id="time">
    <label for="track">Track: </label>
    <select name="track_id" id="track_id">
        @foreach($tracks as $track)
        <option value="{{ $track->id }}">{{ $track->track_name }}</option>
        @endforeach
    </select>
    <button type="submit">Add record time</button>
</form>

@if ($user->cars != null && count($user->cars) > 0)
<h3>Update car</h3>
<form action="cars/{{$car->id}}/update" method="post">
    @csrf
    {{-- @method('patch') --}}
    <label for="car">Car: </label>
    <select name="car_id" id="car_id">
        @foreach ($user->cars as $car)
        <option value="{{ $car->id }}">{{ $car->model }} {{ $car->registration_number }}</option>
        @endforeach
    </select>
    <label for="registration_number">Registration number: </label>
    <input type="text" name="registration_number" id="registration_number">
    <label for="model">Model: </label>
    <input type="text" name="model" id="model">
    <button type="submit">Update car</button>
</form>
@endif

@if ($user->laptimes != null && count($user->laptimes) > 0)
<h3>Update time</h3>
<form action="laptimes/{{$laptime->id}}/update" method="post">
    @csrf
    {{-- @method('patch') --}}
    <label for="laptime">Laptime: </label>
    <select name="laptime_id" id="laptime_id">
        @foreach ($user->laptimes as $laptime)
        <option value="{{ $laptime->id }}">{{ $laptime->date }} {{ $laptime->car->model }} {{ $laptime->car->registration_number }}</option>
        @endforeach
    </select>
    <label for="date">Date: </label>
    <input type="date" name="date" id="date">
    <label for="time">Time in minutes:seconds format: </label>
    <input type="text" name="time" id="time">
    <label for="track">Track: </label>
    <select name="track_id" id="track_id">
        @foreach($tracks as $track)
        <option value="{{ $track->id }}">{{ $track->track_name }}</option>
        @endforeach
    </select>
    <button type="submit">Update time</button>
</form>
@endif