<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class RequirementController extends Controller
{
    // Display the student's requirement
    public function index()
    {
        $requirement = Requirement::where('user_id', auth()->id())->first();
        return view('requirements.index', compact('requirement'));
    }

    // Store or update requirement
    public function store(Request $request)
    {
        $request->validate([
            'scholastic_record' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'scholarship_name' => 'required|string|max:255',
            'sponsor' => 'required|string|max:255',
            'year_level' => 'required|string|max:50',
            'gpa' => 'required|numeric|min:1|max:5',
            'plan' => 'required|string|min:300',
        ]);

        $filePath = $request->file('scholastic_record')->store('scholastic_records', 'public');

        Requirement::updateOrCreate(
            [ 'user_id' => auth()->id(),],
            [
                'scholastic_record' => $filePath,
                'scholarship_name' => $request->scholarship_name,
                'sponsor' => $request->sponsor,
                'year_level' => $request->year_level,
                'gpa' => $request->gpa,
                'plan' => $request->plan,
                'status' => 'pending',
            ]
        );

        return redirect()
            ->route('requirements.index')
            ->with('success', 'Requirements submitted successfully!');
    }

    // Generate PDF of the requirement
   public function generatePdf($id)
    {
        $requirement = Requirement::with('student')->findOrFail($id);

        $pdf = PDF::loadView('requirements.pdf', compact('requirement'));

        return $pdf->download('Requirement_' . $requirement->student->name . '.pdf');
    }

}
