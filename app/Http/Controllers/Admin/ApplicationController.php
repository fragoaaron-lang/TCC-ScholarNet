<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index()
    {
        // Get all applications with student info
        $applications = Application::with('student')->latest()->get();

        return view('admin.applications.index', compact('applications'));
    }

    public function approve(Application $application)
    {
        $application->update(['status' => 'approved']);
        return back()->with('success', 'Application approved.');
    }

    public function reject(Application $application)
    {
        $application->update(['status' => 'rejected']);
        return back()->with('error', 'Application rejected.');
    }
}
