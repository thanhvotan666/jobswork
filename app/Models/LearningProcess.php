<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningProcess extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',
        'school',
        'degree',
        'specialized',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
