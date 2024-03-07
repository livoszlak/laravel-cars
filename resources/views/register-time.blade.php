<div>
    <h3>Add time</h3>
<form action="laptimes" method="post">
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
    <label for="time">Time in minutes:seconds:milliseconds format (59:32:924): </label>
    <input type="text" name="time" id="time">
    <label for="track">Track: </label>
    <select name="track_id" id="track_id">
        @foreach($tracks as $track)
        <option value="{{ $track->id }}">{{ $track->track_name }}</option>
        @endforeach
    </select>
    <button type="submit">Add record time</button>
</form>
</div>
@include('errors')
