<div>
    <h1>Your times</h1>
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
</div>

@if ($user->laptimes != null && count($user->laptimes) > 0)
<h3>Update time</h3>
<form action="laptimes/{{$laptime->id}}/update" method="post">
    @csrf

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
@include('errors')
