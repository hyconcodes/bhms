<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminAppointments()
    {
        $appointments = Appointment::where('doctor_id', auth()->user()->id)->get();
        return view('admin.appointments', compact('appointments'));
    }
}
