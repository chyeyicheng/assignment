<form method="post" action="{{ route('listings.store') }}">
    @csrf
    <h1>Create Listing</h1>
    <label>
        <input type="text" name="name" placeholder="Name">
    </label>
    <label>
        <input type="number" name="longitude" placeholder="Longitude" max="180" min="-180" step="0.00001">
    </label>
    <label>
        <input type="number" name="latitude" placeholder="Latitude" max="90" min="-90" step="0.00001">
    </label>
    <button type="submit">Create Listing</button>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>