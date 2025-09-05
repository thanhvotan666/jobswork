<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobProfession extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'profession_id',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
