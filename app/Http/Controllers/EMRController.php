<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
// use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use TCPDF;

// use PDF;

class EMRController extends Controller
{
    public function index()
    {
        $users = User::whereHas('role', fn($query) => $query->where('name', 'student'))
            ->orderBy('updated_at', 'desc')->paginate(8);
        return view('admin.emr', compact('users'));
    }

    public function updateBioData(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->update($request->all());
        return redirect()->route('admin.patient.view', $user->id)->with('success', 'Patient bio data updated successfully.');
    }

    public function updateMedicalHistory(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->update($request->all());
        return redirect()->route('admin.patient.view', $user->id)->with('success', 'Patient Medical History updated.');
    }
    public function updateInvestigationResults(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->update($request->all());
        return redirect()->route('admin.patient.view', $user->id)->with('success', 'Patient Investigation Results updated.');
    }
    public function downloadPDF(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Using TCPDF package
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('BHMS System');
        $pdf->SetTitle('Patient Medical Record');
        // Set margins
        $pdf->SetMargins(10, 10, 10);
        // Add a page
        $pdf->AddPage();
        // Get HTML content from view
        $html = view('pdf.patient_record', [
            'user' => $user,
            'title' => 'Patient Medical Record',
            'date' => now()->format('d/m/Y')
        ])->render();
        // Write HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // Generate filename
        $filename = 'patient_' . $user->id . '_' . now()->format('Y-m-d') . '.pdf';
        // Output PDF for download
        return $pdf->Output($filename, 'D');
    }

    public function emrSearchPatient(Request $request)
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
        return view('admin.emr', compact('users', 'query', 'roles'));
    }

    public function store(Request $request)
    {
        // Logic to store EMR data
        return redirect()->route('emr.index')->with('success', 'EMR created successfully.');
    }

    public function show($id)
    {
        // Logic to show a specific EMR
        return view('emr.show', compact('id'));
    }

    public function edit($id)
    {
        // Logic to edit a specific EMR
        return view('emr.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update EMR data
        return redirect()->route('emr.index')->with('success', 'EMR updated successfully.');
    }

    public function destroy($id)
    {
        // Logic to delete an EMR
        return redirect()->route('emr.index')->with('success', 'EMR deleted successfully.');
    }
}
