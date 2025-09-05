<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'name',
        'show_contact_candidate',
        "hot_job",
        'price',
    ];
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function registrations()
    {
        return $this->hasMany(ServiceRegistration::class);
    }
}
