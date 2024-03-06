<div>
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
</div>
