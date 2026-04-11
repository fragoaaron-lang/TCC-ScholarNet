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

        $user = auth()->user();

        if (empty($user->course)) {
            return redirect()
                ->back()
                ->withErrors(['course' => 'Your course is not set. Please update your profile before submitting an application.'])
                ->withInput();
        }

        // Check if Application from this user already exists
        $application = \App\Models\Application::where('user_id', auth()->id())->first();
        $isUpdate = $application !== null;

        $data = [
            'course' => $user->course,
            'scholarship_name' => $request->scholarship_name,
            'sponsor' => 'Tomas Claudio Colleges', // Auto-filled
            'year_level' => $request->year_level,
            'gpa' => $request->gpa,
            'plan' => $request->plan,
            'status' => 'pending',
            'user_id' => auth()->id(),
        ];

        // Only update file if a new one is uploaded
        if ($request->hasFile('scholastic_record')) {
            $filePath = $request->file('scholastic_record')->store('scholastic_records', 'public');
            $data['scholastic_record'] = $filePath;
        }

        if ($isUpdate) {
            $application->update($data);
        } else {
            \App\Models\Application::create($data);
        }

        $message = $isUpdate ? 'Application updated successfully!' : 'Application submitted successfully!';

        return redirect()
            ->route('student.dashboard')
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
