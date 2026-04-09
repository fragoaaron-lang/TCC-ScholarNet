<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    // Show list of announcements
    public function index()
    {
        $admin = auth('admin')->user();

        if ($admin && $admin->department) {
            $announcements = Announcement::forDepartmentSecretary($admin->department)->latest()->get();
        } else {
            $announcements = Announcement::forAdminManager()->latest()->get();
        }

        return view('admin.announcements.index', compact('announcements', 'admin'));
    }

    // Store new announcement
    public function store(Request $request)
    {
        $admin = auth('admin')->user();

        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];

        if (!$admin->department) {
            $rules['audience_type'] = 'required|in:all_students,secretaries,department';
            $rules['target_department'] = 'nullable|string';
        }

        $request->validate($rules);

        if ($admin->department) {
            $audienceType = 'department';
            $targetDepartment = $admin->department;
        } else {
            $audienceType = $request->input('audience_type');
            $targetDepartment = $audienceType === 'department' ? $request->input('target_department') : null;
        }

        Announcement::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'audience_type' => $audienceType,
            'target_department' => $targetDepartment,
            'user_id' => null,
            'admin_id' => $admin->id,
        ]);

        return back()->with('success', 'Announcement created successfully.');
    }

    // Delete announcement
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Announcement deleted successfully.');
    }
}
