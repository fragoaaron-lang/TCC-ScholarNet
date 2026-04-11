<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Grade;
use App\Models\Announcement;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch this student's applications
        $applicationsColumn = 'student_id';
        if (!\Schema::hasColumn('applications', $applicationsColumn)) {
            $applicationsColumn = 'user_id';
        }

        $applications = Application::where($applicationsColumn, $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch this student's grades (optional)
        $grades = Grade::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Determine the latest semester grade group for this student.
        $latestGrade = Grade::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $recentSemesterGrades = collect();
        $recentSemesterLabel = null;

        if ($latestGrade) {
            $recentSemesterGrades = Grade::where('user_id', $user->id)
                ->when($latestGrade->semester, function ($query, $semester) {
                    return $query->where('semester', $semester);
                })
                ->when($latestGrade->school_year, function ($query, $schoolYear) {
                    return $query->where('school_year', $schoolYear);
                })
                ->orderBy('subject')
                ->get();

            $recentSemesterLabel = trim(($latestGrade->semester ?? '') . ' ' . ($latestGrade->school_year ? '• ' . $latestGrade->school_year : ''));
        }

        // Fetch announcements for students:
        $announcements = Announcement::forStudents($user->course)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.dashboard', compact(
            'applications',
            'grades',
            'recentSemesterGrades',
            'recentSemesterLabel',
            'announcements'
        ));
    }
}
