<div>
    <h1>This is the dashboard</h1>
    <p>Hello, {{ $user->name }}!</p>
</div>
<form action="/logout" method="post">
    @csrf
<button action="submit">Logout {{$user->name}}</button></form>
<br>
@include('errors')
<a href="/profile" class="btn btn-primary">To profile</a>