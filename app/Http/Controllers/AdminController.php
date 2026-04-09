<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Application;
use App\Models\Announcement;
use App\Jobs\TerminateStudentAccountJob;
use App\Models\Requirement;
use App\Models\Grade;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        // Students assigned to this department admin
        $students = User::where('role', 'student')
            ->when($admin && $admin->department, function ($query) use ($admin) {
                return $query->where('course', $admin->department);
            })
            ->get();

        // Get announcements based on admin role
        if ($admin && $admin->department) {
            // Department secretary sees: all_students, secretaries, and their department
            $announcements = Announcement::forDepartmentSecretary($admin->department)->latest()->get();
        } else {
            // Admin manager sees all announcements
            $announcements = Announcement::forAdminManager()->latest()->get();
        }

        // Filter applications by admin department
        $applications = Requirement::with('student')
            ->when($admin && $admin->department, function ($query) use ($admin) {
                return $query->whereHas('student', function ($q) use ($admin) {
                    $q->where('course', $admin->department);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter requirements by admin department
        $requirements = Requirement::with('student')
            ->when($admin && $admin->department, function ($query) use ($admin) {
                return $query->whereHas('student', function ($q) use ($admin) {
                    $q->where('course', $admin->department);
                });
            })
            ->latest()
            ->get();

        // Get department secretaries (all if global admin, only self if department secretary)
        $secretaries = Admin::when($admin && !$admin->department, function ($query) {
            // Global admin sees all department secretaries (department is not null)
            return $query->whereNotNull('department');
        })
        ->when($admin && $admin->department, function ($query) use ($admin) {
            // Department secretary sees only themselves
            return $query->where('id', $admin->id);
        })
        ->orderBy('department')
        ->get();

        // Only current admin's students (already department-scoped)
        $currentAdmin = $admin;

        // Get unique departments for global admin
        $departments = [];
        if ($admin && !$admin->department) {
            $departments = Admin::whereNotNull('department')
                ->distinct('department')
                ->pluck('department')
                ->toArray();
        }

        return view('admin.dashboard', compact(
            'students',
            'announcements',
            'applications',
            'requirements',
            'currentAdmin',
            'secretaries',
            'departments'
        ));
    }

    // Approve application
    public function approveApplication(Application $application)
    {
        $application->update(['status' => 'approved']);
        return back()->with('success', 'Application approved.');
    }

    // Reject application
    public function rejectApplication(Application $application)
    {
        $application->update(['status' => 'rejected']);
        return back()->with('error', 'Application rejected.');
    }

    // Create announcement
    public function createAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Announcement::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return back()->with('success', 'Announcement created successfully.');
    }

    // Delete announcement
    public function deleteAnnouncement(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Announcement deleted successfully.');
    }

    // Students list (all or department scoped)
    public function students(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $department = $admin->department ?: $request->query('department');

        if ($admin && $admin->department) {
            $department = $admin->department;
        }

        $selectedYear = $request->query('year_level', 'all');

        $students = User::where('role', 'student')
            ->when($department, function ($query, $department) {
                return $query->where('course', $department);
            })
            ->when($selectedYear !== 'all', function ($query) use ($selectedYear) {
                return $query->where('year_level', $selectedYear);
            })
            ->orderBy('course')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        // For global admin, get all departments; for department secretaries, show their department
        $departments = [];
        if (!$admin->department) {
            // Global admin sees all departments
            $allPossibleDepartments = [
                'College of Business and Accountancy',
                'College of Computer Studies',
                'College of Criminology',
                'College of Education and Liberal Arts',
                'College of Hospitality Management',
                'College of Nursing',
                'College of Physical Therapy',
            ];
            $departments = $allPossibleDepartments;
        }

        return view('admin.students.index', compact('students', 'department', 'departments', 'selectedYear'));
    }

    // Secretaries list
    public function secretaries(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $secretaries = Admin::when(!$admin->department, function ($query) {
            // Global admin sees all secretaries
            return $query->orderBy('department');
        })
        ->when($admin->department, function ($query) use ($admin) {
            // Department secretary only sees themselves
            return $query->where('id', $admin->id);
        })
        ->get();

        $departments = Admin::whereNotNull('department')->distinct()->pluck('department')->values();

        return view('admin.secretaries.index', compact('secretaries', 'departments'));
    }

    public function studentShow(User $student)
    {
        $admin = Auth::guard('admin')->user();
        if ($admin && $admin->department && $student->course !== $admin->department) {
            abort(403);
        }

        return view('admin.students.show', compact('student'));
    }

    public function studentGrades(User $student)
    {
        $admin = Auth::guard('admin')->user();
        if ($admin && $admin->department && $student->course !== $admin->department) {
            abort(403);
        }

        $grades = Grade::where('user_id', $student->id)
            ->orderBy('school_year')
            ->orderBy('semester')
            ->orderBy('subject')
            ->get()
            ->groupBy('school_year');

        return view('admin.students.grades', compact('student', 'grades'));
    }

    public function approveStudent(User $student)
    {
        $admin = Auth::guard('admin')->user();
        if ($admin && $admin->department && $student->course !== $admin->department) {
            abort(403);
        }

        $student->update(['is_approved' => true]);

        return back()->with('success', 'Student approved successfully.');
    }

    public function rejectStudent(User $student)
    {
        $admin = Auth::guard('admin')->user();
        if ($admin && $admin->department && $student->course !== $admin->department) {
            abort(403);
        }

        // Set rejection status and schedule termination
        $student->update([
            'is_approved' => false,
            'termination_at' => now()->addHours(24)
        ]);

        // Schedule account termination job
        TerminateStudentAccountJob::dispatch($student)->delay(now()->addHours(24));

        return back()->with('success', 'Student rejected. Account will be terminated in 24 hours.');
    }
}
