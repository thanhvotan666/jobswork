<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
        ]);
        Profession::create([
            'name' => $request->name,
        ]);

        return back()->with('success', __('save successfully'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'profession_id' => 'required|exists:professions,id',
            'name' => 'required|string|min:3|max:50',
        ]);
        Profession::findOrFail($request->profession_id)->update([
            'name' => $request->name,
        ]);

        return back()->with('success', __('updated is success'));
    }

    public function destroy(string $id, Request $request)
    {
        $request->validate([
            'profession_id' => 'required|exists:professions,id',
        ]);
        Profession::findOrFail($request->profession_id)->delete();

        return back()->with('success', __('deleted is successfully'));
    }
}
