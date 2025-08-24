<?php

namespace App\Http\Controllers;

use App\Models\Clinical;
use Illuminate\Http\Request;
use App\Models\User;

class ClinicalController extends Controller
{
    public function index()
    {
        $users = User::whereHas('role', fn($query) => $query->where('name', 'student'))
            ->orderBy('updated_at', 'desc')->paginate(8);
        return view('clinical.index', compact('users'));
    }
    public function viewClinicalRecord(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        return view('clinical.patient', compact('user'));
    }
    // public function updateClinicalRecord(Request $request, $userId)
    // {
    //     $user = User::findOrFail($userId);
    //     $user->update($request->all());
    //     return redirect()->route('clinical.patient', $user->id)->with('success', 'Clinical record updated successfully.');
    // }
    public function updateVitalSigns(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $clinical = Clinical::where('user_id', $userId)->first();
        if($clinical){
            $clinical->update([
                'vital_signs' => $request->vital_signs,
                'user_id' => $userId,
            ]);
        }else{
            $clinical = Clinical::create([
                'vital_signs' => $request->vital_signs,
                'user_id' => $userId,
            ]);
        }      

        return redirect()->route('clinical.view', $user->id)->with('success', 'Vital Signs updated successfully.');
    }
    public function updateLabTest(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->update($request->all());
        return redirect()->route('clinical.view', $user->id)->with('success', 'Lab Test Results updated successfully.');
    }
    public function updateDiagnosisAndPrescription(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->update($request->all());
        return redirect()->route('clinical.view', $user->id)->with('success', 'Diagnosis and Prescription updated successfully.');
    }
}
