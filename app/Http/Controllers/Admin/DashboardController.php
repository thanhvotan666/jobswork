<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\DailyVisit;
use App\Models\EmployerPending;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $auth = auth()->guard('admin')->user();
        $labels = [];
        $allJobs = [];
        $allVisits = [];
        $allEmployers = [];
        $allCandidates = [];
        $admin = Admin::find($auth->id);
        $dateStart = '';
        if( $request->has('date-start') ){
            $dateStart = $request->input('date-start');
        }else{
            $dateStart = Carbon::now()->startOfWeek()->toDateString();
        }
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::parse($dateStart)->addDays($i);
            $labels[] = $date->format('d/m');
            
            $allJobs[] = Job::whereDate('created_at', $date)->count();
            $allVisits[] = DailyVisit::whereDate('visit_date', $date)->first()?->visits ?? 0;
            $allEmployers[] = EmployerPending::whereDate('created_at', $date)->count();
            $allCandidates[] = User::whereDate('created_at', $date)->count();

        }
        $chartData = [
            'labels' => $labels,
            'allJobs' => $allJobs,
            'allVisits' => $allVisits,
            'allEmployers' => $allEmployers,
            'allCandidates' => $allCandidates,
        ];
        return view('admin.dashboard.index', compact(['chartData']));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
