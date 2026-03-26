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

        // Fetch announcements (global + personal)
        $announcements = Announcement::where(function($query) use ($user) {
            $query->whereNull('user_id')          // Global announcements
                  ->orWhere('user_id', $user->id); // Personal announcements
        })->orderBy('created_at', 'desc')->get();

        return view('student.dashboard', compact('applications', 'grades', 'announcements'));
    }
}
