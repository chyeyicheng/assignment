<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = Listing::all();
        return view("/listings/index", compact("listings"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("/listings/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        $validated['user_id'] = auth()->id();


        $listing = Listing::create($validated);


        return redirect()->route('listings.index')->with('success', 'Listing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $listing = Listing::findOrFail($id);
        return view("/listings/show", compact("listing"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listing = Listing::findOrFail($id);
        return view("/listings/edit", compact("listing"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);
        $listing = Listing::findOrFail($id);
        $listing->update([
            'name' => $validated['name'],
            'longitute' => $validated['longitude'],
            'latitude' => $validated['latitude'],
        ]);

        return redirect()->route('listings.index')->with('success', 'Listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $listing = Listing::findOrFail($id);
        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Listing deleted successfully.');
    }
}
