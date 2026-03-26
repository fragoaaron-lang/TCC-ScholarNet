<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use App\Models\Announcement;
use App\Models\Requirement;

class AdminController extends Controller
{
    public function index()
    {
        // Get all students
        $students = User::where('role', 'student')->get();

        // Get latest announcements
        $announcements = Announcement::latest()->get();

        // Get applications with related student
         $applications = Requirement::with('student')
        ->orderBy('created_at', 'desc')
        ->get();

        // Get requirements with related user
        $requirements = Requirement::with('student')->latest()->get();

        // Pass everything to dashboard view
        return view('admin.dashboard', compact(
            'students',
            'announcements',
            'applications',
            'requirements'
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
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Announcement created successfully.');
    }

    // Delete announcement
    public function deleteAnnouncement(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Announcement deleted successfully.');
    }
}
