<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use App\Models\Curriculum;

class StudentGradeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $grades = Grade::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $gradeMap = $grades->mapWithKeys(function ($grade) {
            return [strtolower(trim($grade->subject)) => $grade];
        });

        $curriculumSubjects = collect();
        if ($user->course) {
            $curriculumSubjects = Curriculum::getCoursesByDepartment($user->course);
        }

        $totalSubjects = $curriculumSubjects->flatten()->count();
        $gradedCount = $grades->count();
        $pendingCount = max(0, $totalSubjects - $gradedCount);
        $averageGrade = $grades->isNotEmpty() ? $grades->avg('grade') : null;

        return view('student.grades', compact('grades', 'gradeMap', 'curriculumSubjects', 'totalSubjects', 'gradedCount', 'pendingCount', 'averageGrade'));
    }
}
