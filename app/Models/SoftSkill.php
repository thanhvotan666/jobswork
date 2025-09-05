<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftSkill extends Model
{
    use HasFactory;
    protected $fillable = [
        'soft_skill',
        'proficient',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
