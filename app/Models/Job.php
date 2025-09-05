<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'degree',
        'experience',
        'address',
        'location',
        'description',
        'requirement',
        'benefits',
        'expired',
        'demand',
        'quantity',
        'min_salary',
        'max_salary',
        'type_salary',
        'employer_id',
        'is_stop',
        'is_public',
        'admin_id',
        'sort_date',
        'is_hot',
    ];

    public function professions()
    {
        return $this->hasMany(JobProfession::class);
    }
    public function skills()
    {
        return $this->hasMany(JobSkill::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function applieds()
    {
        return $this->hasMany(Applied::class);
    }
    public function saveds()
    {
        return $this->hasMany(Saved::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function views()
    {
        return $this->hasMany(JobView::class);
    }
    public function supports(){
        return $this->hasMany(SupportCandidate::class);
    }
    public function sendEmails(){
        return $this->hasMany(JobSendEmail::class);
    }

    public function requireds(){
        return $this->hasMany(JobRequired::class);
    }
}
