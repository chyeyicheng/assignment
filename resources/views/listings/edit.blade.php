<form action="{{ route('listings.update', $listing->id) }}" method="post">
    @method('PATCH')
    @csrf
    <h1>Edit Listing</h1>
    <label>
        <input type="text" name="name" placeholder="Name" value="{{ $listing->name }}">
    </label>
    <label>
        <input type="number" name="longitude" placeholder="Longitude" max="180" min="-180" step="0.00001" value="{{ $listing->longitude }}">
    </label>
    <label>
        <input type="number" name="latitude" placeholder="Latitude" max="90" min="-90" step="0.00001" value="{{ $listing->latitude }}">
    </label>
    <button type="submit">Edit Listing</button>
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