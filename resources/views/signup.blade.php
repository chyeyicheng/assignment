<form action="{{ route('create') }}" method="post">
    @csrf
    <h1>Sign Up</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif                  
    <label>
        <input type="text" name="name" placeholder="Name">
    </label>
    <label>
        <input type="email" name="email" placeholder="Email">
    </label>
    <label>
        <input type="password" name="password" placeholder="Password">
    </label>
    <select name="role" id="role">
        <option value="a" selected>Admin</option>
        <option value="u">User</option>
    </select>
    <button type="submit">Sign Up</button>
</form>
