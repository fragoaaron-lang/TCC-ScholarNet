<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;

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
                'total_students' => User::where('course', $dept)->where('role', 'student')->count(),
                'approved_students' => User::where('course', $dept)->where('role', 'student')->where('is_approved', true)->count(),
                'pending_students' => User::where('course', $dept)->where('role', 'student')->where('is_approved', false)->count(),
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
        $secretary = Admin::where('department', $department)->first();
        if (!$secretary) {
            abort(404, 'Department not found');
        }

        // Get students for this department
        $students = User::where('course', $department)
            ->where('role', 'student')
            ->get();

        // Group students by year level
        $studentsByYear = $students->groupBy('year_level');

        return view('admin.reports.show', compact('department', 'secretary', 'students', 'studentsByYear'));
    }
}
