<?php

namespace App\Http\Controllers;

use App\Mail\StudentAppointmentApprovedNotification;
use App\Models\Appointment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function adminAppointments(Request $request)
    {
        $query = Appointment::where('doctor_id', auth()->user()->id);

        // Filter by status
        if ($request->has('status') && $request->status !== 'All') {
            $query->where('status', $request->status);
        }

        // Search by student name
        if ($request->has('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $appointments = $query->orderBy('updated_at', 'desc')->get();
        return view('admin.appointments', compact('appointments', 'request'));
    }

    public function adminCancelAppointments(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'cancelled']);
        return redirect()->route('admin.appointments')->with('success', 'Appointment cancelled.');
    }

    public function viewAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        // dd($appointment);
        return view('admin.view_appointment', compact('appointment'));
    }

    public function updateAppointment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $oldStatus = $appointment->status;
        $appointment->update($request->all());

        // Check if the status was changed to 'approved'
        if ($request->has('status') && strtolower($request->status) === 'approved') {
            // Get the student associated with this appointment through the user relationship
            $student = $appointment->user;
            // dd($student);
            try {
                if ($student && $student->email) {
                    Mail::to($student->email)->send(new StudentAppointmentApprovedNotification($appointment));
                }
            } catch (Exception $e) {
                Log::error('Failed to send appointment approval email: ' . $e->getMessage());
                return redirect()->route('admin.appointments')
                    ->with('warning', 'Appointment updated but email notification failed to send.');
            }
        }
        return redirect()->route('admin.appointments')->with('success', 'Appointment updated.');
    }

    public function deleteStaff($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect()->route('admin.create')->with('success', 'Staff deleted.');
    }
}
