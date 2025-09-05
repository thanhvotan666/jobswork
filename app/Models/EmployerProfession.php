<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerProfession extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'profession_id',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
    
}
