<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $auth = Employer::find(auth()->guard('employer')->id());

        $perPage = $request->input('per_page', 10);
        $query = Job::query();
        $query->where('employer_id', $auth->id);

        if ($request->has('status')) {
            $status = $request->input('status');
            $today = now()->toDateString();

            $query->when($status === 'stop', function ($q) use ($today) {
                $q->where('is_stop', true);
            });

            $query->when($status === 'pending', function ($q) use ($today) {
                $q->whereNull('admin_id');
            });

            $query->when($status === 'online', function ($q) use ($today) {
                $q->where('expired', '>=', $today);
                $q->where('admin_id', '!=', null);
            });

            $query->when($status === 'expired', function ($q) use ($today) {
                $q->where('expired', '<', $today);
            });
        }

        if ($request->has('name') && $request->input('name') != null) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if($request->has('created_at') && $request->input('created_at') != null){
            $query->where('created_at', '>=', $request->input('created_at'));
        }
        if($request->has('expired') && $request->input('expired') != null){
            $query->where('expired', '>=',$request->input('expired'));
        }
        if ($request->has('applied') && $request->input('applied') != null) {
            $query->withCount('applieds')
                  ->having('applieds_count', '>=', $request->input('applied'));
        }
        if($request->has('view') && $request->input('view') != null){
            $query->withCount('views')
                  ->having('views_count', '>=', $request->input('view'));
        }
        $query->orderBy('updated_at','desc');

        

        $jobsCount = $query->count();
        $jobs = $query->paginate($perPage);
        return view('employer.jobs.index', compact(
            'auth',
            'jobs',
            'jobsCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $job = null;

        if ($request->has('id')) {
            $job = Job::find($request->id);
        }

        return view('employer.jobs.create',compact('job'));
    }

    public function show(Request $request,string $id)
    {
        $auth = Employer::find(auth('employer')->id());
        $job = $auth->jobs()->find($id);
        $labels = [];
        $allApplieds = [];
        $allViews = [];
        
        $dateStart = now()->subDays(30);
        for ($i = 1; $i < 31; $i++) {
            $date = Carbon::parse($dateStart)->addDays($i);
            $labels[] = $date->format('d/m');
            
            $applieds = $auth
            ->jobs()
            ->with(['applieds' => function ($query) use ($date) {
                $query->whereDate('created_at', $date->toDateString());
            }])
            ->get()
            ->pluck('applieds')
            ->flatten();
            $allApplieds[] = $applieds->count();

            $views = $auth
            ->jobs()
            ->with(['views' => function ($query) use ($date) {
                $query->whereDate('created_at', $date->toDateString());
            }])
            ->get()
            ->pluck('views')
            ->flatten();
            $allViews[] = $views->count();
        }
        $chartData = [
            'labels' => $labels,
            'allApplieds' => $allApplieds,
            'allViews' => $allViews,
        ];
        if (!$job) {
            return back()->with('error', __('you do not have permission to do this'));
        }
        return view('employer.jobs.show', compact('auth','job','chartData'));
    }
    
    public function store(Request $request)
    {
        $auth = Employer::find(auth()->guard('employer')->id());
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'requirement' => 'required|string',
            'benefits' => 'required|string',
            'expired' => 'required|date',
            'demand' => 'required|string',
            'min_salary' => 'nullable|numeric',
            'max_salary' => 'nullable|numeric',
            'type_salary' => 'required|string',
            'quantity' => 'required|numeric|min:1'
        ]);
        $request->validate([
            'job_skill'=> 'required',
            'job_profession'=> 'required',
            'position' => 'required',
        ]);
        $validateData['position'] = collect(json_decode($request->input('position')))->pluck('value')->first();
        $validateData['sort_date'] = now();

        $hasService =
            $auth->registrations()
                ->where('expired', '>=', now()->toDateString())
                ->whereHas('service', function ($query) {
                    $query->where('hot_job', '1');
                })
                ->count() > 0;
        if ($hasService) {
            $validateData['is_hot'] = true;
        }

        $job = $auth->jobs()->create($validateData);
        if ($request->input('job_skill')) {
            $job_skills = collect(json_decode($request->job_skill))->pluck('value');
            $job->skills()->createMany(
                $job_skills->map(fn($skill) => ['name' => $skill])
            );
        }
        if ($request->input('job_profession')) {
            $job->professions()->createMany(
                collect($request->input('job_profession'))
                    ->filter()
                    ->map(fn($profession) => ['profession_id' => $profession])
                    ->toArray()
            );
        }
        if ($request->input("sendEmail")) {
            $emails = collect(json_decode($request->sendEmail))->pluck('value');
            $job->sendEmails()->createMany(
                $emails->map(fn($email) => ['email' => $email])
            );
        }
        if ($request->input('required')) {
            $job->requireds()->createMany(
                collect($request->input('required'))
                    ->filter()
                    ->map(fn($required) => ['name' => $required])
                    ->toArray()
            );
        }
        return redirect()->route('employer.jobs.index')->with('success', __('create job is success'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $auth = auth()->guard('employer')->user();

        $job = Job::where('employer_id', $auth->id)->find($id);

        return view('employer.jobs.edit', compact(
            'auth',
            'job',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $auth = Employer::find(auth()->guard('employer')->id());

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'requirement' => 'required|string',
            'benefits' => 'required|string',
            'expired' => 'required|date',
            'demand' => 'required|string',
            'min_salary' => 'nullable|numeric',
            'max_salary' => 'nullable|numeric',
            'type_salary' => 'required|string',
            'quantity' => 'required|numeric'
        ]);
        $request->validate([
            'job_skill'=> 'required',
            'job_profession'=> 'required',
            'position' => 'required',
        ]);
        $validateData['position'] = collect(json_decode($request->input('position')))->pluck('value')->first();
        $validateData['admin_id'] = null;
        
        $job = Job::where('employer_id', $auth->id)->findOrFail($id);

        $job->update($validateData);

        if ($request->has('job_skill')) {
            $job_skills = collect(json_decode($request->job_skill))->pluck('value');
            $job->skills()->delete();
            $job->skills()->createMany(
                $job_skills->map(fn($skill) => ['name' => $skill])
            );
        }
        if ($request->has('job_profession')) {
            $job->professions()->delete();
            $job->professions()->createMany(
                collect($request->input('job_profession'))
                    ->filter()
                    ->map(fn($profession) => ['profession_id' => $profession])
                    ->toArray()
            );
        }
        if ($request->has("sendEmail")) {
            $emails = collect(json_decode($request->sendEmail))->pluck('value');
            $job->sendEmails()->delete();
            $job->sendEmails()->createMany(
                $emails->map(fn($email) => ['email' => $email])
            );
        }
        if ($request->has('required')) {
            $job->requireds()->delete();
            $job->requireds()->createMany(
                collect($request->input('required'))
                    ->filter()
                    ->map(fn($required) => ['name' => $required])
                    ->toArray()
            );
        }
        return redirect()->route('employer.jobs.edit', $id)->with('success', __('update job is success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $auth = Employer::find(auth()->guard('employer')->id());

        $job = $auth->jobs()->find($id);

        $job->update([
            'is_stop' => !$job->is_stop
        ]);

        return back()->with('success', __('update job is success'));
    }
}
