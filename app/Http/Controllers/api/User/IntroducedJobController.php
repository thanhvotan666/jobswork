<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SupportCandidate;
use App\Models\User;
use Illuminate\Http\Request;

class IntroducedJobController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(auth('api')->user()->id);
        $query = SupportCandidate::with(['job.skills','job.professions.profession','job.employer']);
        $query->where('user_id', $user->id);

        $query->orderByDesc('id');
        $per_page = $request->input('per_page', 10);

        $query->skip($request->input('page', 1) * $per_page - $per_page);
        $query->limit($per_page);

        $data = $query->get();

        return response()->json($data);
    }   
}
