<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grade;

class GradeController extends Controller
{
    // Show grade encoder
    public function index()
    {
        $students = User::where('role', 'student')->get();
        $grades = Grade::with(['student', 'course'])->get();

        return view('admin.grades.index', compact('students', 'grades'));
    }

    // Save or update grades
    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data['grades'] as $student_id => $courses) {
            foreach ($courses as $course_title => $value) {
                // Update existing grade or create new one
                \App\Models\Grade::updateOrCreate(
                    [
                        'student_id' => $student_id,
                        'course_title' => $course_title
                    ],
                    ['value' => $value]
                );
            }
        }

        return back()->with('success', 'Grades updated successfully!');
    }
}
