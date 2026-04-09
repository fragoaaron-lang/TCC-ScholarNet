<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Requirement;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Application;

class AdminApplicationController extends Controller
{
    protected function departmentScopedRequirements()
    {
        $admin = Auth::guard('admin')->user();

        return Requirement::with('student')
            ->when($admin && $admin->department, function ($query) use ($admin) {
                return $query->whereHas('student', function ($q) use ($admin) {
                    $q->where('course', $admin->department);
                });
            });
    }

    public function index()
    {
        $admin = Auth::guard('admin')->user();

        $selectedYear = request('year_level', 'all');

        $query = $this->departmentScopedRequirements();

        if ($selectedYear !== 'all') {
            $query->whereHas('student', function ($q) use ($selectedYear) {
                $q->where('year_level', $selectedYear);
            });
        }

        $applications = $query->latest()->get();

        // For global admin, get all departments
        $departments = [];
        if (!$admin->department) {
            $departments = [
                'College of Business and Accountancy',
                'College of Computer Studies',
                'College of Criminology',
                'College of Education and Liberal Arts',
                'College of Hospitality Management',
                'College of Nursing',
                'College of Physical Therapy',
            ];
        }

        return view('admin.applications.index', compact('applications', 'departments', 'selectedYear'));
    }

    public function approve(Requirement $application)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin && $admin->department && $application->student && $application->student->course !== $admin->department) {
            abort(403, 'Unauthorized action.');
        }

        $application->update(['status' => 'approved']);

        return redirect()->route('admin.applications.index')->with('success', 'Application approved.');
    }

    public function reject(Requirement $application, Request $request)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin && $admin->department && $application->student && $application->student->course !== $admin->department) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $application->update([
            'status' => 'rejected',
            'rejection_reason' => $request->input('reason'),
        ]);

        if ($application->student) {
            $application->student->update([
                'termination_at' => now()->addHours(24),
                'status' => 'terminated_pending',
            ]);
        }

        return redirect()->route('admin.applications.index')->with('success', 'Application rejected. Student will be terminated.');
    }

    public function screening(Requirement $application)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin && $admin->department && $application->student && $application->student->course !== $admin->department) {
            abort(403, 'Unauthorized action.');
        }

        $application->update([
            'status' => 'screening',
            'screening_at' => now()
        ]);

        return redirect()->route('admin.applications.index')->with('success', 'Application marked as under screening.');
    }
}
