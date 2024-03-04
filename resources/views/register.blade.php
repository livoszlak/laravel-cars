<div>
    <form action="users" method="post">
        @csrf
        <div>
            <label for="name">Username</label>
            <input name="name" id="name" type="text">
        </div>
        <div>
            <label for="email">Email</label>
            <input name="email" id="email" type="email" />
        </div>
        <div>
            <label for="password">Password</label>
            <input name="password" id="password" type="password" />
        </div>
        <button type="submit">Register</button>
    </form>
</div>
