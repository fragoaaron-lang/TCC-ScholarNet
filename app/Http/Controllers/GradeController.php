<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course; // Make sure you have a Course model
use App\Models\Grade;  // Grade model
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    public function index()
    {
        // Get all students
        $students = User::where('role', 'student')->get();

        // Get all grades
        $grades = Grade::with(['student', 'course'])->get();

        // Pass to the view
        return view('admin.grades.index', compact('students', 'grades'));
    }
}
