<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesiredLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'desired_location',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
