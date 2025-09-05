<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Employer;
use App\Models\Job;
use App\Models\SupportCandidate;
use App\Models\User;
use Illuminate\Http\Request;

class SupportCandidateController extends Controller
{

    public function index(Request $request)
    {
        $user = Admin::find(auth('admin')->user()->id);

        $query = SupportCandidate::query();
        $query->where('admin_id', $user->id);

        if($request->has("status") && $request->input('status') != "all") {
            $query->where('status', $request->input('status'));
        }

        $query->orderByDesc('id');
        $supportCandidates = $query->paginate(10);

        return view('admin.support_candidates.index', compact('supportCandidates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $employers = [];
        $jobs = [];
        $candidates = [];
        
        if ($request->input('search')) {
            $search = $request->input('search');
            $employers = Employer::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])->get();
        }else{
            $employers = Employer::all();
        }
        
        if ($request->input('employer_id') && $employers->contains('id', $request->input('employer_id'))) {
            $jobs = Job::where('employer_id', $request->employer_id)
            ->whereNotNull('admin_id')
            ->where('is_stop',  false)
            ->where('expired', '>=', now())     
            ->get();
        }
        if($request->input('search_candidate')){
            $search = $request->input('search_candidate');
            $candidates = User::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%'])
            ->limit(20)
            ->get();
        }else{
            $candidates = User::limit(20)->get();
        }
        return view('admin.support_candidates.create',compact('employers','jobs','candidates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData =  $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'description' => 'nullable|string'
        ]);
        $request->validate([
            'candidate_id' => 'required|exists:users,id',
        ]);
        $validateData['user_id'] = $request->input('candidate_id');

        $user = Admin::find(auth('admin')->id());
        $user->supportCandidates()->create($validateData);

        return back()->with('success', __('created is successfully'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supportCandidate = SupportCandidate::findOrFail($id);
        $supportCandidate->delete();

        return redirect()->route('admin.support_candidates.index')->with('success', 'deleted is successfully');
    }
}
