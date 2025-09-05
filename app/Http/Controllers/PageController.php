<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function checkLoginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt($credentials)) {
            // Đăng nhập thành công
            $request->session()->regenerate();
            return redirect()->route('index');
        }

        // Đăng nhập thất bại
        return back()->withErrors([
            'email' => __('incorrect login information'),
        ])->withInput();
    }
    public function logoutUser(Request $request)
    {
        Auth::guard('user')->logout(); // Đăng xuất guard admin

        $request->session()->invalidate(); // Hủy session hiện tại
        $request->session()->regenerateToken(); // Tạo lại CSRF token mới

        return redirect()->route('index')->with('success', __('logout completed')); // Chuyển hướng về trang login
    }
    public function checkLoginEmployer(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('employer')->attempt($credentials)) {
            // Đăng nhập thành công
            $request->session()->regenerate();
            return redirect()->route('employer.index');
        }

        // Đăng nhập thất bại
        return back()->withErrors([
            'email' => __('incorrect login information'),
        ])->withInput();
    }
    public function logoutEmployer(Request $request)
    {
        Auth::guard('employer')->logout(); // Đăng xuất guard 

        $request->session()->invalidate(); // Hủy session hiện tại
        $request->session()->regenerateToken(); // Tạo lại CSRF token mới

        return redirect()->route('index')->with('success', __('logout completed')); // Chuyển hướng về trang login
    }
    public function employers(Request $request)
    {
        $employers = Employer::all();
        
        return view('candidate.employers', compact('employers'));
    }
    public function employer(Request $request, $id)
    {
        $employer = Employer::findOrFail($id);
    
        return view('candidate.employer', compact('employer'));
    }

    public function jobs(Request $request)
    {
        $query = Job::query();
        $query->whereNotNull('admin_id');
        $query->where('is_stop', 0);
        $query->where('expired', '>', now());

        if ($request->input('key_word')) {
            $query->where(function ($qr) use ($request) {
                $qr->where('name', 'like', '%' . $request->key_word . '%');
                $qr->orWhereHas('employer', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->key_word . '%');
                });
            });
        }
        if ($request->input('location')) {
            $query->where(function ($qr) use ($request) {
                $qr->Where('location', 'like', '%' . $request->location . '%');
                $qr->orWhere('address', 'like', '%' . $request->location . '%');
            });
        }
        if ($request->input('demand')) {
            $query->Where('demand', 'like', '%' . $request->demand . '%');
        }
        if ($request->input('profession_name')) {
            $query->WhereHas('professions.profession', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->profession_name . '%');
            });
        }
        if ($request->input('profession')) {
            $query->WhereHas('professions', function ($q) use ($request) {
                $q->where('profession_id', 'like', $request->profession);
            });
        }
        if ($request->input('employer')) {
            $query->where('employer_id', 'like', $request->employer);
        }

        $query->orderByDesc('updated_at')
        ->orderByDesc('sort_date')
        ->orderByDesc('is_hot');
        $jobs_count = $query->count();
        $jobs = $query->paginate(20);

        return view('candidate.jobs', compact('jobs', 'jobs_count'));
    }

    public function job(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        if( $job->is_stop == 1 || $job->admin_id == null){
            abort(404);
        }
        
        $user = Auth::guard('user')->user();
        if ($user) {
            $check = $job->views()->where('user_id', $user->id)->count() < 5;
            if($check){
                $job->views()->create(['user_id' => $user->id]);
            }
        } else {
            $check = $job->views()->where('user_id', null)->count() < 50;
            if($check){
                $job->views()->create();
            }
        }
        return view('candidate.job', compact('job'));
    }
}
