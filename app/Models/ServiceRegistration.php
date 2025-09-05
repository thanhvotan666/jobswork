<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRegistration extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'employer_id',
        'service_id',
        'expired'
    ];
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
