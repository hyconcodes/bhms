<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DoctorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in to access this page.');
        }

        // Check if authenticated user has the admins role
        if (!in_array(Auth::user()->role->name, ['Super Admin', 'Doctor', 'Nurse', 'Lab Technician'])) {
            return redirect()->to('student')
                ->with('error', 'Access denied. Only Admins can access that area.');
        }

        // User is authenticated and has Student role, proceed with the request
        return $next($request);
    }
}
