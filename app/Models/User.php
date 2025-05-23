<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'name',
        'email',
        'password',
        'role_id',
        'avatar',
        'profile_picture',
        'matric',
        'date_of_birth',
        'gender',
        'phone',
        'address',
        'department',
        'level',
        'year_of_study',
        'guardian_name',
        'guardian_address',
        'guardian_contact',
        'blood_group',
        'allergies',
        'medical_conditions',
        'medications',
        'genotype',
        'religion',
        'nationality',
        'marital_status',
        'disability',
    ];

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
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
