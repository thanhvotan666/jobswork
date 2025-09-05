<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LocationSelect;
use Illuminate\Http\Request;

class LocationSelectController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|min:3|max:50',
        ]);
        LocationSelect::create([
            'location' => $request->location,
        ]);

        return back()->with('success', __('location added successfully'));
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'location_id' => 'required|exists:location_selects,id',
            'location' => 'required|string|min:3|max:50',
        ]);
        LocationSelect::findOrFail($request->location_id)->update([
            'location' => $request->location,
        ]);

        return back()->with('success', __('location updated successfully'));
    }

    public function destroy(Request $request, string $id)
    {
        $request->validate([
            'location_id' => 'required|exists:location_selects,id',
        ]);
        LocationSelect::findOrFail($request->location_id)->delete();

        return back()->with('success', __('location deleted successfully'));
    }
}
