<?php
namespace App\Exports;

use App\Models\Applied;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CandidatesExport implements FromView
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function view(): View
    {
        $employer = Employer::find(auth()->guard('employer')->user()->id);

        // Lấy danh sách job_id thuộc employer
        $jobIds = Job::where('employer_id', $employer->id)->pluck('id')->toArray();

        // Tạo query để lấy các applieds có job_id thuộc danh sách trên
        $query = Applied::whereIn('job_id', $jobIds);

        // Lọc thêm theo status nếu có
        if ($this->status) {
            $query->where('status', $this->status);
        }

        // Lấy kết quả với applied_id, job_id, employer_id
        $applieds = $query->orderByDesc('id')
            ->get();

        return view('exports.candidates', [
            'applieds' => $applieds
        ]);
    }
}