<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::patch('admin/users/${userId}/toggle-status', [AuthController::class, 'toggleStaffStatus']);

// Route::patch('admin/users/{userId}/toggle-status', function ($userId) {
//     $user = User::findOrFail($userId);
//     $user->status = false;
//     $user->save();
//     return response()->json(['message' => 'User status updated successfully']);
// });
