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
<h3>Add car</h3>
<form action="cars" method="post">
    @csrf
    <label for="registration_number">Registration number: </label>
    <input type="text" name="registration_number" id="registration_number">
    <label for="model">Model: </label>
    <input type="text" name="model" id="model">
    <button type="submit">Add car</button>
</form>

{{$user}}

