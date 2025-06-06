<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeNewStaffMail;
use App\Models\Role;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        // Check if user exists and is suspended
        if ($user && !$user->status) {
            return back()->withErrors([
                'email' => 'Your account is suspended. Please contact the administrator.',
            ]);
        }

        // Attempt authentication
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            
            // Check user role and redirect accordingly
            if ($user->role->name === 'Student') {
                return redirect()->intended('student')
                    ->with('success', 'Welcome, ' . $user->name . '!');
            }
            
            return redirect()->intended('dashboard')
                ->with('success', 'Welcome, ' . $user->name . '!');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Logged out successfully');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'avatar' => 'https://api.dicebear.com/9.x/adventurer/svg?seed=' . $request->name,
            // 'avatar' => $request->file('avatar')->store('avatars', 'public'),
        ]);
        try {
            Mail::to($request->email)->send(new WelcomeNewStaffMail($user));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->route('admin.create')->with('success', 'Admin created successfully');
    }

    public function passwordResetStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.exists' => 'This account does not exist in our system'
        ]);

        // Logic to reset the formal password to the new one
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/')->with('success', 'You can now login with your new password');
    }

    public function searchAdmin(Request $request)
    {
        $roles = Role::whereNotIn('name', ['super admin', 'student'])->get();
        $query = $request->input('query');
        $users = User::whereHas('role', function ($q) {
            $q->where('name', '!=', 'student');
        })
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhereHas('role', function ($q2) use ($query) {
                        $q2->where('name', 'like', "%{$query}%");
                    });
            })
            ->paginate(8);
        return view('admin.create_admin', compact('users', 'query', 'roles'));
    }

    public function adminProfileUploadPicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = Auth::user();
        if ($user instanceof \App\Models\User && $request->hasFile('profile_picture')) {
            $uploadedFile = $request->file('profile_picture');
            $result = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder' => 'profile_pictures',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            ]);
            $user->profile_picture = $result->getSecurePath();
            $user->save();
            // dd($result);
            // dd($user->profile_picture);
        }
        return redirect()->route('admin.profile')->with('success', 'Profile picture updated successfully');
    }

    public function adminProfileInfo(Request $request)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'date_of_birth' => 'sometimes|date',
            'gender' => 'sometimes|in:male,female,other',
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string|max:255',
            'religion' => 'sometimes|string|max:50',
            'nationality' => 'sometimes|string|max:50',
            'marital_status' => 'sometimes|in:single,married,divorced,widowed,separated',
        ]);

        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            $fields = [
                'name',
                'date_of_birth',
                'gender',
                'phone',
                'address',
                'religion',
                'nationality',
                'marital_status'
            ];
            foreach ($fields as $field) {
                if ($request->filled($field)) {
                    $user->$field = $request->$field;
                }
            }
            $user->save();
        }
        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
    }

    public function adminProfileUpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        if ($user instanceof User && Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect('/')->with('success', 'Password updated successfully. Please login with your new password.');
        }
        return redirect()->route('admin.profile')->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    public function adminDeleteAccount(Request $request)
    {
        $user = Auth::user();
        if ($user instanceof User) {
            $user->delete();
            Auth::logout();
            return redirect('/')->with('success', 'Account deleted successfully.');
        }
        return redirect()->route('admin.profile')->withErrors(['error' => 'Unable to delete account.']);
    }

    public function adminProfileUpdateRole(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);
        $user = User::findOrFail($userId);
        if ($user instanceof User) {
            $user->role_id = $request->role_id;
            $user->save();
            $roleName = $user->role ? $user->role->name : 'Role';
            return redirect()->route('admin.create')->with('success', 'Role updated to "' . $roleName . '" for user ' . $user->name . '.');
        }
        return redirect()->route('admin.create')->withErrors(['error' => 'Unable to update role.']);
    }

    public function adminUpdateApiUrl(Request $request)
    {
        $request->validate([
            'api_url' => 'required|url'
        ]);
        $settings = \App\Models\Setting::first();
        if (!$settings) {
            $settings = new \App\Models\Setting();
        }
        $settings->api_url = $request->api_url;
        $settings->save();

        return redirect()->back()->with('success', 'API URL updated successfully');
    }
}
