<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class RefreshJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $query = Job::query();
        $query->whereNotNull('admin_id');
        $query->where('is_stop',false);
        $query->where('expired', '>=', now());

        $jobsCount = $query->count();

        if ($request->has('employer_id') && $request->input('employer_id')) {
            $query->where('employer_id', $request->input('employer_id'));
        }
        if ($request->has('sort')) {
            $sort = $request->input('sort');
            switch ($sort) {
                case 'created_at':
                    $query->orderBy('created_at', 'desc');
                    break;
                    
                case 'updated_at':
                    $query->orderBy('updated_at', 'desc');
                    break;

                case 'expired_at':
                    $query->orderBy('expired');
                    break;

                case 'refreshed':
                    $query->orderBy('sort_date', 'desc');
                    break;

                case 'not_refreshed':
                    $query->orderBy('sort_date');
                    break;

                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        $jobs = $query->paginate($perPage);
        return view('admin.refresh_jobs.index', compact('jobs','jobsCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $job = Job::findOrFail($id);
        
        $job->sort_date = now();
        $job->save();
        return back()->with('success', __('job update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       abort(404);
    }
}
