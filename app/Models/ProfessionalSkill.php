<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalSkill extends Model
{
    use HasFactory;
    protected $fillable = [
        'professional_skill',
        'year',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
