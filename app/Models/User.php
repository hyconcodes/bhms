<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'no_of_children',
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
        'allergies',
        'medical_conditions',
        'medications',
        'religion',
        'nationality',
        'marital_status',
        'disability',
        'reg_no',
        'state_of_origin',
        'state_of_domicile',
        'faculty',
        'heart_disease',
        'respiratory_disease',
        'tuberculosis',
        'stomach_disorder',
        'mental_disorder',
        'gonorrhea',
        'syphilis',
        'epilepsy',
        'sickle_cell',
        'previous_operations',
        'other_illnesses',
        'vital_signs_bp',
        'vital_signs_rr',
        'vital_signs_pr',
        'chest_xray',
        'urine_analysis',
        'other_lab_tests',
        'eye_test',
        'ent_test',
        'reflex_test',
        'pregnancy_status',
        'general_fitness',
        'hb_genotype',
        'blood_group',
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

    /**
     * Set the reg_no attribute to uppercase.
     *
     * @param  string  $value
     * @return void
     */
    public function setRegNoAttribute($value)
    {
        $this->attributes['reg_no'] = strtoupper($value);
    }

    protected static function booted()
    {
        if (auth()->check() && auth()->user()->role->name !== 'Super Admin') {
            static::addGlobalScope('excludeAdmin', function (Builder $builder) {
                $builder->whereHas('role', function ($query) {
                    $query->where('name', '!=', 'Super Admin');
                });
            });
        }
    }

    // doctor has many appointment
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    // patient has many appointment
    public function patientAppointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
