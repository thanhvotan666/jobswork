<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobView;
use App\Models\User;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Job::with([
            'employer',
            'skills',
            'professions.profession',
            'requireds'
        ]);
        $query->whereNotNull('admin_id');
        $query->where('is_stop', false);
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
        if ($request->input('related_job_id')) {
            $query->whereNot('id', $request->related_job_id);
            $relatedJob = Job::find($request->related_job_id);
            $query->whereHas('professions.profession', function ($q) use ($relatedJob) {
                $q->whereIn('id', $relatedJob->professions->pluck('profession_id'));
            });
        }
        if ($request->input('recommended')) {
            $query->inRandomOrder();
            return response()->json($query->first());
        }
        if ($request->input('near')) {
            $location = auth('api')->user()->location;
            $query->where('location',$location);
        }

        $query->orderByDesc('updated_at')
        ->orderByDesc('sort_date')
        ->orderByDesc('is_hot');

        $per_page = $request->input('per_page', 10);
        $query->skip($request->input('page', 1) * $per_page - $per_page);
        $query->limit($per_page);

        $query->withCount('applieds');
        
        $data = $query->get();

        return response()->json($data);
    }

    function show(Request $request, $id)
    {
        $job = Job::with([
            'skills',
            'employer',
            'professions.profession',
            'requireds'
        ])
        ->withCount('applieds')
        ->find($id);

        if (!$job) {
            return response()->json(['errors' => ['Không tìm thấy công việc']], 404);
        }
        if (auth('api')->check()) {
            $user = User::find(auth('api')->id());
            $is_applied = false;
            $is_saved = false;
                // Ghi nhận lượt xem công việc
                JobView::firstOrCreate(
                    ['user_id' => $user->id, 'job_id' => $job->id]
                );

                // Kiểm tra xem người dùng đã ứng tuyển công việc này chưa
                $is_applied = $user->applieds()->where('job_id', $job->id)->exists();

                // Kiểm tra xem người dùng đã lưu công việc này chưa
                $is_saved = $user->saveds()->where('job_id', $job->id)->exists();
            

            // Thêm các thuộc tính tùy chỉnh vào đối tượng job để trả về
            $job->is_applied = $is_applied;
            $job->is_saved = $is_saved;
        }
        

        return response()->json($job);
    }
}
