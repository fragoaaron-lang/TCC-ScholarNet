<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grade;
use App\Models\Requirement;
use App\Models\Curriculum;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{

    // Show grade encoder
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        // Get the department (global admin sees all, department secretaries see their department)
        $department = $admin->department;

        // Get selected year level from request or default to 'all'
        $selectedYear = request('year_level', 'all');

        // Filter students by department and year level
        $query = User::where('role', 'student');
        if ($department) {
            $query->where('course', $department);
        }
        if ($selectedYear !== 'all') {
            $query->where('year_level', $selectedYear);
        }
        $students = $query->get();

        // Get all grades organized by student and year
        $gradesByStudent = [];
        $allGrades = Grade::with('student')->orderBy('school_year')->orderBy('semester')->get();

        foreach ($allGrades as $grade) {
            $studentId = $grade->user_id;
            $year = $grade->school_year ?? 'Unknown Year';

            if (!isset($gradesByStudent[$studentId])) {
                $gradesByStudent[$studentId] = [
                    'student' => $grade->student,
                    'grades_by_year' => []
                ];
            }

            if (!isset($gradesByStudent[$studentId]['grades_by_year'][$year])) {
                $gradesByStudent[$studentId]['grades_by_year'][$year] = [];
            }

            $gradesByStudent[$studentId]['grades_by_year'][$year][] = $grade;
        }

        // Get curriculum for the department(s)
        if ($department) {
            $organizedCourses = Curriculum::getCoursesByDepartment($department);
        } else {
            // For global admin, show all departments as tabs or sections
            $departments = Curriculum::getUniqueDepartments();
            $organizedCourses = [];
            foreach ($departments as $dept) {
                $organizedCourses[$dept] = Curriculum::getCoursesByDepartment($dept);
            }
        }

        $grades = $allGrades;

        return view('admin.grades.index', compact('students', 'gradesByStudent', 'organizedCourses', 'department', 'admin', 'selectedYear', 'grades'));
    }

    // Save or update grades
    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data['grades'] as $student_id => $courses) {
            foreach ($courses as $course_title => $value) {
                if (!empty($value)) {
                    // Update existing grade or create new one
                    \App\Models\Grade::updateOrCreate(
                        [
                            'user_id' => $student_id,
                            'subject' => $course_title
                        ],
                        [
                            'grade' => $value
                        ]
                    );
                }
            }
        }

        return back()->with('success', 'Grades updated successfully!');
    }
}
