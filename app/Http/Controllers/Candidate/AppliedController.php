<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Applied;
use App\Models\Attachment;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppliedController extends Controller
{

    public function index(Request $request)
    {
        $query = Applied::query();
        $query->where('user_id', auth()->guard('user')->user()->id);

        if ($request->has('sort') && $request->sort != 'oldest') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $applieds = $query->paginate(10);
        return view('candidate.user.applieds.index', compact('applieds'));
    }
    public function store(Request $request)
    {

        $auth = User::findOrFail(auth()->guard('user')->user()->id);

        $request->validate([
            'job_id' => 'required|exists:jobs,id',
        ]);
        $validate['job_id'] = $request->job_id;
        $job = Job::findOrFail($request->job_id);

        foreach ($job->requireds as $required) {
            if (is_null($auth->{$required->name})) {
                return back()->with('error', __('please fill in your personal information'));
            }
        }

        if ($request->has('attachment')) {
            if ($request->attachment == '') {
                $validate['attachment'] = null;
            } else {
                $request->validate([
                    'attachment' => 'required|exists:attachments,id',
                ]);
                $attachment = Attachment::findOrFail($request->attachment);
                $link = 'storage/file/applied/' . $auth->id . time() . basename($attachment->link);
                copy(
                    public_path($attachment->link),
                    public_path($link)
                );
                //public_path('file/attachment/' .basename($attachment->link)),
                $validate['attachment'] = $link;
            }
        }

        //dd($job->sendEmails()->pluck('email')->toArray());
        $employer = $job->employer;
        $auth->applieds()->create($validate);

        try {
            $emails = $job->sendEmails()->pluck('email')->toArray();
            Mail::send('mails.employer_applier', ['job' => $job, 'candidate' => $auth], function ($message) use ($emails) {
                $message->to($emails);
                $message->subject(__('new job applied'));
            });
        } catch (\Throwable $th) {
            //throw $th;
        }

        try {
            Mail::send('mails.user_applied', ['job' => $job], function ($message) use ($auth) {
                $message->to($auth->email);
                $message->subject(__('job applied successfully'));
            });
        } catch (\Throwable $th) {
            //throw $th;
        }

        return back()->with('success', __('job applied successfully'));
    }
}
