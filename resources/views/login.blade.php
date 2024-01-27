<form method="post" action="{{ route('login') }}">
    @csrf
    <h1>Log In</h1>
    <label>
        <input type="email" name="email" placeholder="Email">
    </label>
    <label>
        <input type="password" name="password" placeholder="Password">
    </label>
    <button type="submit">Log In</button>
</form>