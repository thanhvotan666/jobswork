<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employer  extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'image',
        'email',
        'password',
        'phone',
        'register_name',
        'address',
        'tax_code',
        'description',
        'employee_count',
        'average_age',
        'point',
        'website_url',
    ];
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

    public function registrations()
    {
        return $this->hasMany(ServiceRegistration::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function professions()
    {
        return $this->hasMany(EmployerProfession::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    public function support(){
        return $this->hasOne(Support::class);
    }
    public function logServices(){
        return $this->hasMany(LogService::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
