<div>
    <h3>Add car</h3>
    <form action="cars" method="post">
        @csrf
        <label for="registration_number">Registration number: </label>
        <input type="text" name="registration_number" id="registration_number">
        <label for="model">Model: </label>
        <input type="text" name="model" id="model">
        <button type="submit">Add car</button>
    </form>
</div>
@include('errors')