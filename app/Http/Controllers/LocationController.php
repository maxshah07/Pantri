<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    private function validateLocation(Request $request) {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
        ]);
    }

    function index() {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }
    
    function show(Location $location) {
        return view('locations.show', compact('location'));
    }

    function create() {
        $location = new Location();
        return view('locations.create', compact('location'));
    }
    
    function store(Request $request) {
        Location::create($this->validateLocation($request));
        return redirect()->route('locations.index'); 
    }

    function edit(Location $location) {
        return view('locations.edit', compact('location'));
    }

    function update(Request $request, Location $location) {
        $location->update($this->validateLocation($request));
        return redirect()->route('locations.show', $location);
    }

    function destroy(Location $location) {
        $location->delete();
        return redirect()->route('locations.index');
    }
}
