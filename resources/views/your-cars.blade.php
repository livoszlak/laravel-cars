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
