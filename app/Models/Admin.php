<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'image',
        'email',
        'password',
        'admin',
        'service',
        'candidate',
        'employer',
    ];
    public function service()
    {
        return $this->hasMany(Service::class);
    }
    public function registration()
    {
        return $this->hasMany(ServiceRegistration::class);
    }
    public function supportCandidates()
    {
        return $this->hasMany(SupportCandidate::class);
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
}
