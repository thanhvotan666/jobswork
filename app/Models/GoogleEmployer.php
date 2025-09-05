<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleEmployer extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'expires_at',
        'used',
    ];
}
