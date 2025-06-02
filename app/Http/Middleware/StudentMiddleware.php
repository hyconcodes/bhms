<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in to access this page.');
        }

        // Check if authenticated user has the Student role
        if (Auth::user()->role->name !== 'Student') {
            return redirect()->to('dashboard')
                ->with('error', 'Access denied. Only students can access that area.');
        }

        // User is authenticated and has Student role, proceed with the request
        return $next($request);
    }
}

