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
        // Check submission deadline
        $deadline = config('scholarship.submission_deadline');
        if (now()->isAfter($deadline)) {
            return redirect()
                ->back()
                ->withErrors(['deadline' => 'The scholarship application deadline has passed. Applications must be submitted before ' . \Carbon\Carbon::parse($deadline)->format('F d, Y') . '.'])
                ->withInput();
        }

        $request->validate([
            'scholastic_record' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'scholarship_name' => 'required|string|max:255',
            'year_level' => 'required|string|max:50',
            'gpa' => 'required|numeric|min:1|max:5',
            'plan' => 'required|string',
        ]);

        $existingRequirement = Requirement::where('user_id', auth()->id())->first();
        $isUpdate = $existingRequirement !== null;

        $data = [
            'scholarship_name' => $request->scholarship_name,
            'sponsor' => 'Tomas Claudio Colleges', // Auto-filled
            'year_level' => $request->year_level,
            'gpa' => $request->gpa,
            'plan' => $request->plan,
            'status' => 'pending',
        ];

        // Only update file if a new one is uploaded
        if ($request->hasFile('scholastic_record')) {
            $filePath = $request->file('scholastic_record')->store('scholastic_records', 'public');
            $data['scholastic_record'] = $filePath;
        }

        Requirement::updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );

        $message = $isUpdate ? 'Application updated successfully!' : 'Requirements submitted successfully!';

        return redirect()
            ->route('requirements.index')
            ->with('success', $message);
    }

    // Generate PDF of the requirement
   public function generatePdf($id)
    {
        $requirement = Requirement::with('student')->findOrFail($id);

        $pdf = PDF::loadView('requirements.pdf', compact('requirement'));

        return $pdf->download('Application_Letter_' . $requirement->student->name . '.pdf');
    }
}
