<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->guard('admin')->user()->service) {
            return back()->with('error', __('this function is not available'));
        }
        $perPage = $request->input('per_page', 10);
        $query = Service::query();

        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        $services = $query->with('admin')->paginate($perPage);

        return view('admin.services.index', compact(
            'services',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->guard('admin')->user()->service) {
            return back()->with('error', __('this function is not available'));
        }
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->guard('admin')->user()->service) {
            return back()->with('error', __('this function is not available'));
        }
        $request->validate([
            'name' => 'required|string|max:255|unique:services,name',
            'show_contact_candidate' => 'required|boolean',
            'hot_job' => 'required|boolean',
        ]);

        Service::create([
            'name' => $request->name,
            'show_contact_candidate' => $request->show_contact_candidate,
            'hot_job' => $request->hot_job,
            'admin_id' => auth()->guard('admin')->id(),
        ]);
        return redirect()->route('admin.services.index')->with('success', __('service created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->guard('admin')->user()->service) {
            return back()->with('error', __('this function is not available'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return back()->with('error', __('service not found'));
        }
        if (!auth()->guard('admin')->user()->service) {
            return back()->with('error', __('this function is not available'));
        }
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (!auth()->guard('admin')->user()->service) {
            return back()->with('error', __('this function is not available'));
        }
        $service = Service::find($id);
        if (!$service) {
            return back()->with('error', __('service not found'));
        }
        if ($request->has('name')) {
            $request->validate([
                'name' => 'required|unique:services,name',
            ]);

            $service->name = $request->name;
            $service->save();

            return back()->with('success', __('change name is success'));
        }
        if ($request->has('show_contact_candidate')) {
            $request->validate([
                'show_contact_candidate' => 'required|boolean',
            ]);

            $service->show_contact_candidate = $request->show_contact_candidate;
            $service->save();

            return back()->with('success', __('change show contact candidate is success'));
        }
        if ($request->has('hot_job')) {
            $request->validate([
                'hot_job' => 'required|boolean',
            ]);

            $service->hot_job = $request->hot_job;
            $service->save();

            return back()->with('success', __('edit service is success'));
        }
        return back()->with('error', __('did not things'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->guard('admin')->user()->service) {
            return back()->with('error', __('this function is not available'));
        }
        $service = Service::find($id);
        if (!$service) {
            return back()->with('error', __('service not found'));
        }
        $service->delete();
        return back()->with('success', __('delete service is success'));
    }
}
