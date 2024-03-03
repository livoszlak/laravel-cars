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
        Car: {{ $laptime->car->model }} Date: {{$laptime->date}} Time: {{$laptime->time}}
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
<h3>Add record</h3>
<form action="laptimes" method="post">
    @csrf
    <label for="car">Car: </label>
    <select name="car_id" id="car">
        {{-- @if ($user->cars != null && count($user->cars > 0)) --}}
        @foreach ($user->cars as $car)
        <option value="{{ $car->id }}">{{ $car->model }}</option>
        @endforeach
         {{-- @endif --}}
    </select>
    <label for="date">Date: </label>
    <input type="date" name="date" id="date">
    <label for="time">Time in minutes:seconds format: </label>
    <input type="text" name="time" id="time">
    <button type="submit">Add record time</button>
</form>

{{$user}}
<br>
{{$user->laptimes}}
