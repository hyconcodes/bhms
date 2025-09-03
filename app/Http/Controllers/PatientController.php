<?php

namespace App\Http\Controllers;

use App\Mail\DoctorAppointmentNotification;
use App\Models\Setting;
use App\Mail\WelcomeNewPatient;
use App\Models\Appointment;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PatientController extends Controller
{
    public function patientStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'reg_no' => 'required|string|regex:/^[0-9]{8}[A-Za-z]{2}$/|unique:users,reg_no',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id'
        ], [
            'reg_no.regex' => 'Jamb Registration number must be 10 characters long, with 8 digits followed by 2 letters',
            'reg_no.unique' => 'Jamb Registration number already exists',
        ]);
        $user = User::create([
            'name' => $request->name,
            'reg_no' => $request->reg_no,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'avatar' => 'https://api.dicebear.com/9.x/adventurer/svg?seed=' . $request->name,
            // 'avatar' => $request->file('avatar')->store('avatars', 'public'),
        ]);
        try {
            Mail::to($request->email)->send(new WelcomeNewPatient($user));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->route('admin.create.patient')->with('success', 'Patient register successfully');
    }

    public function searchPatient(Request $request)
    {
        $api_url = Setting::first()?->api_url;
        $roles = Role::where('name', 'student')->get();
        $query = $request->input('query');
        $users = User::whereHas('role', function ($q) {
            $q->where('name', 'student');
        })
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('reg_no', 'like', "%{$query}%")
                    ->orWhere('matric', 'like', "%{$query}%")
                    ->orWhereHas('role', function ($q2) use ($query) {
                        $q2->where('name', 'like', "%{$query}%");
                    });
            })
            ->paginate(8);
        return view('admin.create_patient', compact('users', 'query', 'roles', 'api_url'));
    }

    public function index()
    {
        $users = User::whereHas('role', fn($query) => $query->where('name', '!=', 'student'))
            ->inRandomOrder()
            ->paginate(6);
        $appointments = Appointment::where('user_id', auth()->user()->id)
            ->orderBy('updated_at', 'desc')
            ->get();
        // Debug: Check if appointments exist
        // dd($appointments->count(), $appointments->pluck('status'));
        // Add this temporarily for testing
        // if ($appointments->count() === 0) {
        //     // Create some test data to see if charts work
        //     $testData = collect([
        //         (object)['status' => 'pending', 'appointment_date' => now()],
        //         (object)['status' => 'approved', 'appointment_date' => now()->subMonth()],
        //         (object)['status' => 'completed', 'appointment_date' => now()->subMonth(2)],
        //     ]);
        //     $appointments = $testData;
        // }
        return view('student.home', compact('users', 'appointments'));
    }

    // NOT USING
    public function header()
    {
        $todayApprovedCount = Appointment::where('user_id', Auth::id())
            ->whereDate('updated_at', today())
            ->where('status', 'approved')
            ->count();
        return view('includes.header', compact('todayApprovedCount'));
    }

    public function bookAppointment($userId)
    {
        $doctor = User::findOrFail($userId);
        if (!$doctor->status) {
            return redirect()->back()->with('error', 'This doctor is currently unavailable for appointments.');
        }
        return view('student.book_appointment', [
            'doctor' => $doctor
        ]);
    }

    public function searchDoctors(Request $request)
    {
        $query = $request->input('query');
        $users = User::whereHas('role', function ($q) {
            $q->whereNotIn('name', ['student', 'Super Admin']);
        });

        if ($query) {
            $users->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhereHas('role', function ($q2) use ($query) {
                        $q2->where('name', 'like', "%{$query}%");
                    });
            });
        }

        $users = $users->paginate(6);
        return view('student.home', compact('users', 'query'));
    }

    public function storeAppointment(Request $request, $userId)
    {
        $request->validate([
            'appointment_urgency' => 'required',
            'reason' => 'required',
            'notes' => 'nullable',
        ]);
        $appointment = new Appointment();
        $appointment->user_id = auth()->user()->id;
        $appointment->doctor_id = $userId;
        $appointment->appointment_urgency = $request->appointment_urgency;
        $appointment->reason = $request->reason;
        $appointment->notes = $request->notes;
        $appointment->save();

        // Send email notification to the doctor
        $doctor = User::findOrFail($userId);
        if ($doctor && $doctor->email) {
            Mail::to($doctor->email)->send(new DoctorAppointmentNotification($appointment));
        }
        return redirect('student')->with('success', 'Appointment request submitted successfully. You will be notified of the approved date and time.');
    }

    public function studentAppointments()
    {
        $appointments = Appointment::where('user_id', auth()->user()->id)
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('student.appointments', compact('appointments'));
    }

    public function viewAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('student.view_appointment', compact('appointment'));
    }

    public function updateAppointment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
        return redirect()->route('student.appointments')->with('success', 'Appointment updated successfully.');
    }

    public function destroyAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('student.appointments')->with('success', 'Appointment deleted.');
    }

    public function deletePatient($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect()->route('admin.create.patient')->with('success', 'Patient deleted.');
    }
}
