<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $query = Job::query();
        $jobsCount = $query->count();

        if ($request->has('status')) {
            $status = $request->input('status');

            if ($status === 'pending') {
                $query->whereNull('admin_id');
            }
            if ($status === 'processed') {
                $query->whereNotNull('admin_id');
            }
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%");
        }

        $query->orderBy('updated_at', 'desc');
        $jobs = $query->paginate($perPage);
        return view('admin.jobs.index', compact('jobs','jobsCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.jobs.show', [
            'job' => Job::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $job = Job::findOrFail($id);
        
        if(!$job->admin_id){
            $job->admin_id = auth()->guard('admin')->id();
        }else{
            $job->admin_id = null;
        }
        $job->save();
        return back()->with('success', __('job update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return back()->with('success', __('job deleted successfully'));
    }
}
