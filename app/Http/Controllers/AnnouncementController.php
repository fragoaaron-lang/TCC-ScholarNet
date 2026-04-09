<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    // Show announcements list
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        // Filter announcements based on admin role
        if ($admin && $admin->department) {
            // Department secretary: see all-students announcements + their department announcements
            $announcements = Announcement::forDepartmentSecretary($admin->department)->latest()->get();
        } else {
            // Admin manager: see all-students + secretaries + department announcements
            $announcements = Announcement::forAdminManager()->latest()->get();
        }

        return view('admin.announcements.index', [
            'announcements' => $announcements,
            'admin' => $admin
        ]);
    }

    // Add new announcement
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'audience_type' => 'required|in:all_students,secretaries,department',
            'target_department' => 'nullable|string',
        ]);

        $admin = Auth::guard('admin')->user();
        $data = $request->only('title', 'content', 'audience_type');
        $data['admin_id'] = $admin->id;

        // If department secretary creates announcement, it's automatically for their department
        if ($admin->department) {
            $data['audience_type'] = 'department';
            $data['target_department'] = $admin->department;
        } else {
            // Admin manager can choose audience
            if ($request->audience_type === 'department' && $request->target_department) {
                $data['target_department'] = $request->target_department;
            }
        }

        Announcement::create($data);

        return back()->with('success', 'Announcement created successfully.');
    }

    // Delete announcement
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Announcement deleted.');
    }
}

