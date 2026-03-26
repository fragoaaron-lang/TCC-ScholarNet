<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Application; // <-- Add this line!

class AdminApplicationController extends Controller
{
    public function index()
    {
        $applications = Requirement::with('student')->latest()->get();
        return view('admin.applications.index', compact('applications'));
    }

    public function approve(Requirement $application)
    {
        $application->update(['status' => 'approved']);
        return redirect()->route('admin.applications.index')->with('success', 'Application approved.');
    }

  public function reject($applicationId)
{
    $application = Application::findOrFail($applicationId);
    $user = $application->user;

    // Mark application as rejected
    $application->status = 'rejected';
    $application->save();

    // Set rejection reason and termination (e.g., 24 hours from now)
    $user->rejection_reason = 'You did not meet the scholarship requirements.';
    $user->termination_at = now()->addHours(24);
    $user->status = 'terminated_pending'; // Optional status to differentiate
    $user->save();

    return redirect()->back()->with('success', 'Application rejected. Student will be terminated.');
}
}
