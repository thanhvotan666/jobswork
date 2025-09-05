<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->guard('admin')->user()->candidate) {
            return back()->with('error', 'This function is not available.');
        }
        $perPage = $request->input('per_page', 10);
        $query = User::query();

        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->has('email')) {
            $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }

        $candidates = $query->paginate($perPage);

        return view('admin.candidates.index', compact(
            'candidates',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->guard('admin')->user()->candidate) {
            return back()->with('error', 'This function is not available.');
        }
        return view('admin.candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->guard('admin')->user()->candidate) {
            return back()->with('error', 'This function is not available.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->guard('admin')->user()->candidate) {
            return back()->with('error', 'This function is not available.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->guard('admin')->user()->candidate) {
            return back()->with('error', 'This function is not available.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->guard('admin')->user()->candidate) {
            return back()->with('error', 'This function is not available.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->guard('admin')->user()->candidate) {
            return back()->with('error', __('this function is not available'));
        }
    }
}
