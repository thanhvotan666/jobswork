<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\SupportCandidate;
use Illuminate\Http\Request;

class SupportCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Employer::find(auth('employer')->user()->id);
        $query = SupportCandidate::query();
        $query->whereHas('job', function ($query) use ($user) {
            $query->where('employer_id', $user->id);
        });

        if($request->has("status") && $request->input('status') != "all") {
            $query->where('status', $request->input('status'));
        }


        $query->orderByDesc('id');
        $supportCandidates = $query->paginate(10);
        
        return view('employer.support_candidates.index', compact(
            'supportCandidates',
        ));
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
        //
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
        $supportCandidate = SupportCandidate::findOrFail($id);

        if($request->has("status")) {
            $supportCandidate->update(['status' => $request->status]);
            return back()->with('success',__('updated is success'));
        }

        return back()->with('error',__('did not things'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
