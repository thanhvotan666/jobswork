<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerAdmin extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_employer',
        'id_admin',
    ];
    public function employers()
    {
        return $this->belongsTo(Employer::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
