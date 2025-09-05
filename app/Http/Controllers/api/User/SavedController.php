<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Http\Request;

class SavedController extends Controller
{
    public function index(Request $request)
    {
        $query = Saved::with(['job.employer']);
        
        $query->where('user_id', auth('api')->id());

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
        if ($auth->saveds()->where('job_id', $request->job_id)->exists()) {
            $auth->saveds()->where('job_id', $request->job_id)->delete();
            return response()->json('Công việc đã được hủy khỏi danh sách lưu');
        }
        $auth->saveds()->create($request->all());
        return  response()->json(`Lưu công việc thành công`);
    }

    public function destroy(string $id)
    {
        $auth = User::find(auth()->guard('api')->user()->id);
        $saved = $auth->saveds()->where('job_id', $id)->first();
        if ($saved) {
            $saved->delete();
            return response()->json(['message' => "Xóa thành công"]);
        }
        return response()->json(['errors' => ['Không tìm thấy dữ liệu']], 404);
    }
}
