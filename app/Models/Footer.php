<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'address_s',
        'address_n',
        'phone_s',
        'phone_n',
        'email',
        'hotline',
        'bottom',
        'facebook',
        'linkedin',
        'tiktok',
        'threads',
        'zalo',
        'instagram'
    ];
}
