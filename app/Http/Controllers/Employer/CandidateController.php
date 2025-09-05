<?php

namespace App\Http\Controllers\Employer;

use App\Exports\CandidatesExport;
use App\Http\Controllers\Controller;
use App\Models\Applied;
use App\Models\Employer;
use App\Models\JobView;
use App\Models\Profession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use SimpleXMLElement;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        $auth = Employer::find(auth()->guard('employer')->user()->id);
        $query = Applied::query();
        $query->whereHas('job', function ($q) use ($auth) {
            $q->where('employer_id', $auth->id);
        });

        if ($request->has('expired')) {
            if ($request->input('expired') == 'online') {
                $query->whereHas('job', function ($q) {
                    $q->where('expired', '>=', now()->toDateString());
                });
            }
            if ($request->input('expired') == 'expired') {
                $query->whereHas('job', function ($q) {
                    $q->where('expired', '<', now()->toDateString());
                });
            }
        }

        if ($request->has('status') && $request->input('status') != 'all') {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        $query->orderBy('created_at', 'desc');
        $appliedsCount = $query->count();
        $applieds = $query->paginate(20);

        return view('employer.candidates.index', compact('applieds', 'appliedsCount', 'auth'));
    }
    public function update(Request $request, string $id)
    {
        $auth = Employer::find(auth()->guard('employer')->user()->id);
        $applied = Applied::find($id);
        if ($applied->job->employer_id != $auth->id) {
            return back()->with('error', __('you do not have permission to do this'));
        }
        if ($request->has('status')) {
            $request->validate([
                'status' => 'required|in:new,suitable,contact,interview,offer,success,failed'
            ]);
            $applied->update([
                'status' => $request->input('status')
            ]);
            return back()->with('success', __('status updated successfully'));
        }


        return back()->with('error', __('did not things'));
    }
    public function destroy(string $id)
    {
        //
    }

    public function showContact(Request $request)
    {
        $applied = Applied::find($request->input('id'));
        $auth = Employer::find(auth()->guard('employer')->user()->id);
        $hasService = $auth->registrations()
            ->where('expired', '>=', now()->toDateString())
            ->whereHas('service', function ($query) {
                $query->where('show_contact_candidate', '1');
            })
            ->count() > 0;
        if(!$hasService){
            return response()->json([
                'success' => false,
                'message' => __('you do not have permission to do this')
            ]);
        }
        $applied->show_contact = 1;
        $applied->save();
        return response()->json([
            'success' => true,
            'message' => 'success',
            'email' => $applied->user->email,
            'phone' => $applied->user->phone,
            'attachment' => $applied->attachment
        ]);
    }
    public function showContactPoint(Request $request)
    {
        $applied = Applied::find($request->input('id'));
        $auth = Employer::find(auth()->guard('employer')->user()->id);
        if($auth->point < 5){
            return response()->json([
                'success' => false,
                'message' => __('you do not have enough points')
            ]);
        }else{
            $auth->point -= 5;
            $auth->save();
        }
        $applied->show_contact = 1;
        $applied->save();
        return response()->json([
            'success' => true,
            'message' => 'success',
            'email' => $applied->user->email,
            'phone' => $applied->user->phone,
            'attachment' => $applied->attachment,
            'point' => $auth->point
        ]);
    }
    public function showContactSearch(Request $request)
    {
        $applied = Applied::find($request->input('id'));
        $auth = Employer::find(auth()->guard('employer')->user()->id);

        $hasService = $auth->registrations()
            ->where('expired', '>=', now()->toDateString())
            ->whereHas('service', function ($query) {
                $query->where('show_contact_candidate', '1');
            })
            ->count() > 0;
        if(!$hasService){
            return response()->json([
                'success' => false,
                'message' => __('you do not have permission to do this')
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'success',
            'email' => $applied->user->email,
            'phone' => $applied->user->phone,
            'attachment' => $applied->attachment
        ]);
    }
    public function showContactSearchPoint(Request $request)
    {
        $applied = Applied::find($request->input('id'));
        $auth = Employer::find(auth()->guard('employer')->user()->id);

        if($auth->point < 1){
            return response()->json([
                'success' => false,
                'message' => __('you do not have enough points')
            ]);
        }
        $auth->point -= 1;
        $auth->save();
        return response()->json([
            'success' => true,
            'message' => 'success',
            'email' => $applied->user->email,
            'phone' => $applied->user->phone,
            'attachment' => $applied->attachment,
            'point' => $auth->point
        ]);
    }
    public function showContactView(Request $request)
    {
        $view = JobView::find($request->input('id'));
        $auth = Employer::find(auth()->guard('employer')->user()->id);
        $hasService = $auth->registrations()
            ->where('expired', '>=', now()->toDateString())
            ->whereHas('service', function ($query) {
                $query->where('show_contact_candidate', '1');
            })
            ->count() > 0;
        if(!$hasService){
            return response()->json([
                'success' => false,
                'message' => __('you do not have permission to do this')
            ]);
        }
        $view->show_contact = 1;
        $view->save();
        return response()->json([
            'success' => true,
            'message' => 'success',
            'email' => $view->user->email,
            'phone' => $view->user->phone,
        ]);
    }
    public function showContactViewPoint(Request $request)
    {
        $view = JobView::find($request->input('id'));
        $auth = Employer::find(auth()->guard('employer')->user()->id);
        if($auth->point < 5){
            return response()->json([
                'success' => false,
                'message' => __('you do not have enough points')
            ]);
        }else{
            $auth->point -= 5;
            $auth->save();
        }
        $view->show_contact = 1;
        $view->save();
        return response()->json([
            'success' => true,
            'message' => 'success',
            'email' => $view->user->email,
            'phone' => $view->user->phone,
            'point' => $auth->point
        ]);
    }
    function candidateStatistics(Request $request){
        $labels = [];
        $allApplieds = [];
        $all = 0;
        $faileds = 0;
        $successes = 0;
        $employer = employer::find(auth()->guard('employer')->user()->id);
        if( $request->has('all') ){
            $now = Carbon::now();
            $created_at = Carbon::parse(auth()->guard('employer')->user()->created_at);
            for($i = $created_at->copy(); $now->greaterThan($i); $i->addDay()){
                $labels[] = $i->format('d/m');
                $applieds = $employer
                ->jobs()
                ->with(['applieds' => function ($query) use ($i) {
                    $query->whereDate('created_at', $i->toDateString());
                }])
                ->get()
                ->pluck('applieds')
                ->flatten();
                $allApplieds[] = $applieds->count();
                $all += $applieds->count();
                $faileds += $applieds->where('status', 'failed')->count();
                $successes += $applieds->where('status', 'success')->count();
            }
        }else{
            $dateStart = '';
            if( $request->has('date-start') ){
                $dateStart = $request->input('date-start');
            }else{
                $dateStart = Carbon::now()->startOfWeek()->toDateString();
            }
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::parse($dateStart)->addDays($i);
                $labels[] = $date->format('d/m');
                
                $applieds = $employer
                ->jobs()
                ->with(['applieds' => function ($query) use ($date) {
                    $query->whereDate('created_at', $date->toDateString());
                }])
                ->get()
                ->pluck('applieds')
                ->flatten();
                $allApplieds[] = $applieds->count();
                $all += $applieds->count();
                $faileds += $applieds->where('status', 'failed')->count();
                $successes += $applieds->where('status', 'success')->count();
            }
        }
        $chartData = [
            'labels' => $labels,
            'allApplieds' => $allApplieds,
        ];
        $list = [
            'all' => $all,
            'faileds'=> $faileds,
            'successes'=> $successes,
        ];

        return view('employer.candidates.candidate_statistics',compact('chartData','list'));
    }
    function download(Request $request){
        $auth = Employer::find(auth()->guard('employer')->user()->id);
        $query = Applied::query();

        $query->whereHas('job', function ($q) use ($auth) {
            $q->where('employer_id', $auth->id);
        });


        if ($request->has('status') && $request->input('status') != '') {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        $query->orderByDesc('id');
        $applieds = $query->get();

        return view('employer.candidates.download', compact('applieds', 'auth'));
    }
    public function downloadExcel(Request $request)
    {
        $status = $request->input('status','');
        return Excel::download(new CandidatesExport($status), 'candidates.xlsx');
    }
    public function contactedCandidate(Request $request){
        $auth = Employer::find(auth()->guard('employer')->user()->id);
        $query = Applied::query();
        $query->whereHas('job', function ($q) use ($auth) {
            $q->where('employer_id', $auth->id);
        });
        $query->where('show_contact',true);
        
        if ($request->has('expired')) {
            if ($request->input('expired') == 'online') {
                $query->whereHas('job', function ($q) {
                    $q->where('expired', '>=', now()->toDateString());
                });
            }
            if ($request->input('expired') == 'expired') {
                $query->whereHas('job', function ($q) {
                    $q->where('expired', '<', now()->toDateString());
                });
            }
        }

        if ($request->has('status') && $request->input('status') != 'all') {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        $query->orderBy('created_at', 'desc');
        $appliedsCount = $query->count();
        $applieds = $query->paginate(20);

        return view('employer.candidates.index', compact('applieds', 'appliedsCount', 'auth'));
    }

    public function search(Request $request){
        if($request->has('profession')){
            $query = Applied::query();
            $auth = Employer::find(auth()->guard('employer')->id());
            $profession = Profession::find(request('profession'));
            $query->whereIn('job_id', $profession->jobs()->pluck('id'))->get();
            $applieds = $query->paginate(20);
            return view('employer.candidates.search',compact('auth','applieds'));
        }
        $query = Profession::query();
        if($request->has('location')){
            $location = $request->input('location');
            $query->whereHas('jobs.job', function ($q) use ($location) {
            $q->where('location', $location);
            });
        }
        if($request->has('search')){
            $query->where('name','like','%'.$request->search.'%');
        }
        $professions = $query->get();
        return view('employer.candidates.search', compact('professions'));
    }
}