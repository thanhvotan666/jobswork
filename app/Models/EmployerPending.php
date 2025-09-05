<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerPending extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'email',
        'password',
        'phone',
        'register_name',
        'address',
        'tax_code',
        'description',
        'employee_count',
        'average_age',
        'point',
        'status',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
