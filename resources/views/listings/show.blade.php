<div>
    <h1>{{ $listing->name }}</h1>
    <p>Longitude: {{ $listing->longitude }}</p>
    <p>Latitude: {{ $listing->latitude }}</p>
    <p>Created By: {{ $listing->user->name }}</p>
    <p>Created At: {{ $listing->created_at }}</p>
    <p>Updated At: {{ $listing->updated_at }}</p>
</div>

<a href="{{ route('listings.index') }}">Back to Listings</a>
<a href="{{ route('listings.edit', $listing->id) }}">Edit Listing</a>
<form action="{{ route('listings.destroy', $listing->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit">Delete Listing</button>
</form>