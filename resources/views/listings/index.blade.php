{{-- if user is logged in, show logout link --}}
@if (Auth::check())
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
@endif



@foreach ($listings as $listing)
    <div class="listing">
        <h2>{{ $listing->name }}</h2>
        <a href="{{ route('listings.show', $listing->id) }}">View</a>
    </div>
@endforeach

<a href="{{ route('listings.create') }}">Create Listing</a>
