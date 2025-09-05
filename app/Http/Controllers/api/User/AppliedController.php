<?php

namespace App\Http\Controllers\Api\User;

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
        $query = Applied::with(['job.employer']);
        
        $query->where('user_id', auth('api')->id());

        if ($request->has('status') && $request->input('status') != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('sort') && $request->input('sort') != 'oldest') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }
        
        $per_page = $request->input('per_page', 10);

        $query->skip($request->input('page', 1) * $per_page - $per_page);
        $query->limit($per_page);

        $data = $query->get();

        return response()->json($data);
    }
    public function store(Request $request)
    {

        $auth = User::find(auth('api')->id());

        $request->validate([
            'job_id' => 'required|exists:jobs,id',
        ]);
        $validate['job_id'] = $request->job_id;
        $job = Job::findOrFail($request->job_id);

        foreach ($job->requireds as $required) {
            if (is_null($auth->{$required->name})) {
                return response()->json([
                    'errors' => ["Vui lòng điền đầy đủ thông tin cá nhân của bạn"]
                ], 400);
            }
        }

        if ($request->has('attachment')) {
            if ($request->attachment == ''          ) {
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

        return response()->json(['message' => __('job applied successfully')]);
    }
}
