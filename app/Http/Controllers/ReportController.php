<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScholarshipApprovalLetter;
use App\Models\Application;

class ReportController extends Controller
{
    /**
     * Display the report log index.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        // Only allow global admins to access report log
        if ($admin && $admin->department) {
            abort(403, 'Unauthorized access');
        }

        // Get all department secretaries with their departments
        $departments = Admin::whereNotNull('department')
            ->orderBy('department')
            ->get()
            ->groupBy('department');

        // Get student counts per department
        $departmentStats = [];
        foreach ($departments as $dept => $admins) {
            $departmentStats[$dept] = [
                'total_students' => User::whereRaw('LOWER(course) = ?', [strtolower($dept)])->where('role', 'student')->count(),
                'approved_students' => User::whereRaw('LOWER(course) = ?', [strtolower($dept)])->where('role', 'student')->where('is_approved', true)->count(),
                'pending_students' => User::whereRaw('LOWER(course) = ?', [strtolower($dept)])->where('role', 'student')->where('is_approved', false)->count(),
                'secretaries' => $admins,
            ];
        }

        return view('admin.reports.index', compact('departmentStats'));
    }

    /**
     * Display the department report.
     */
    public function show($department)
    {
        $admin = Auth::guard('admin')->user();

        // Allow global admins (no department) or department secretaries for their own department
        if ($admin && $admin->department && $admin->department !== $department) {
            abort(403, 'Unauthorized access');
        }

        // Get department secretary
        $secretary = Admin::whereRaw('LOWER(department) = ?', [strtolower($department)])->first();
        if (!$secretary) {
            return redirect()->route('admin.reports.index')->with('error', 'Department not found.');
        }

        // Get students for this department
        $students = User::whereRaw('LOWER(course) = ?', [strtolower($department)])
            ->where('role', 'student')
            ->get();

        // Group students by year level
        $studentsByYear = $students->groupBy('year_level');

        return view('admin.reports.show', compact('department', 'secretary', 'students', 'studentsByYear'));
    }

    /**
     * Send scholarship approval letter to president/board of directors.
     */
    public function sendApprovalEmail()
    {
        $admin = Auth::guard('admin')->user();

        // Only allow global admins to send approval emails
        if ($admin && $admin->department) {
            abort(403, 'Unauthorized access');
        }

        // Get all approved applications grouped by department
        $departments = [
            'College of Business and Accountancy',
            'College of Computer Studies',
            'College of Criminology',
            'College of Education and Liberal Arts',
            'College of Hospitality Management',
            'College of Nursing',
            'College of Physical Therapy',
        ];

        $approvedApplicationsByDepartment = [];
        foreach ($departments as $department) {
            $approvedApplications = Application::with('student')
                ->whereRaw('LOWER(course) = ?', [strtolower($department)])
                ->where('status', 'approved')
                ->orderBy('created_at')
                ->get();

            if ($approvedApplications->count() > 0) {
                $approvedApplicationsByDepartment[$department] = $approvedApplications;
            }
        }

        // Send email to president/board of directors
        $recipientEmail = config('mail.president_email', 'fragoaaron@gmail.com');

        Mail::to($recipientEmail)->send(new ScholarshipApprovalLetter($approvedApplicationsByDepartment, $admin, 'applications'));

        return redirect()->back()->with('email_sent', 'Scholarship approval letter has been sent to the Acting President.');
    }
}
