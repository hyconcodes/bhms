<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'appointment_urgency',
        'appointment_date',
        'appointment_time',
        'reason',
        'notes',
        'status',
        'comment',
        'prescription',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    protected $casts = [
        'appointment_date' => 'datetime',
        'appointment_time' => 'datetime',
    ];
}
