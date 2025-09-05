<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSendEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'job_id'
    ];
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
