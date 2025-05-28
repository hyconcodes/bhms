<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeNewPatient;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
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
        return view('admin.create_patient', compact('users', 'query', 'roles'));
    }
}
