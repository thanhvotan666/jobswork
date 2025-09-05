<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobView extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'show_contact',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getView($jobId)
    {
        return $this->where('job_id', $jobId)->sum('view');
    }
}
