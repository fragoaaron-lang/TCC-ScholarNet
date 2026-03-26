<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Requirement; // Not Application

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Requirement::with('student')->orderBy('created_at', 'desc')->get();
        return view('admin.applications.index', compact('applications'));
    }
}
