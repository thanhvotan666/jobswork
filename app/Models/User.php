<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'email',
        'password',
        'date_of_birth',
        'sex',
        'desired_location',
        'position',
        'job_search_status',
        'introduce',
        'phone',
        'address',
        'location',
        'degree',
        'current_salary',
        'desired_salary',
    ];

    public function professionalSkills()
    {
        return $this->hasMany(ProfessionalSkill::class);
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function learningProcesses()
    {
        return $this->hasMany(LearningProcess::class);
    }

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function softSkills()
    {
        return $this->hasMany(SoftSkill::class);
    }

    public function hobbies()
    {
        return $this->hasMany(Hobby::class);
    }

    public function desiredLocations()
    {
        return $this->hasMany(DesiredLocation::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function applieds()
    {
        return $this->hasMany(Applied::class);
    }
    public function saveds()
    {
        return $this->hasMany(Saved::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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
