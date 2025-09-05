<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Http\Request;

class SavedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Saved::query();
        $query->where('user_id', auth()->guard('user')->user()->id);

        if ($request->has('sort') && $request->sort != 'oldest') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        $saveds = $query->paginate(10);
        return view('candidate.user.saveds.index', compact('saveds'));
    }

    public function store(Request $request)
    {
        $auth = User::find(auth()->guard('user')->user()->id);
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
        ]);
        if ($auth->saveds()->where('job_id', $request->job_id)->exists()) {
            return back()->with('error', __('job already saved'));
        }
        $auth->saveds()->create($request->all());
        return back()->with('success', __('job saved successfully'));
    }

    public function destroy(string $id)
    {
        $auth = User::find(auth()->guard('user')->user()->id);
        $saved = $auth->saveds()->where('job_id', $id)->first();
        if ($saved) {
            $saved->delete();
            return back()->with('success', __('job unsaved successfully'));
        }
        return back()->with('error', __('job not found'));
    }
}
