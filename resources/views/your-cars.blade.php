<div>
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
</div>

@if ($user->cars != null && count($user->cars) > 0)
<h3>Update car</h3>
<form action="cars/{{$car->id}}/update" method="post">
    @csrf
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