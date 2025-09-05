<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCare extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function employers(){
        return $this->hasMany(Employer::class);
    }
    public function supports(){
        return $this->hasMany(Support::class);
    }
}
