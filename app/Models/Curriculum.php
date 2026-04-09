<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'curriculums';

    protected $fillable = [
        'department',
        'semester',
        'course_title',
    ];

    private static function semesterOrdering(): array
    {
        return [
            'First Year – First Semester' => 1,
            'First Year – Second Semester' => 2,
            'Second Year – First Semester' => 3,
            'Second Year – Second Semester' => 4,
            'Third Year – First Semester' => 5,
            'Third Year – Second Semester' => 6,
            'Fourth Year – First Semester' => 7,
            'Fourth Year – Second Semester' => 8,
        ];
    }

    private static function getSemesterPriority(string $semester): int
    {
        $order = self::semesterOrdering();

        return $order[$semester] ?? 999;
    }

    public static function getCoursesByDepartment($department)
    {
        return self::where('department', $department)
            ->get()
            ->sortBy(function ($item) {
                return sprintf('%03d-%s', self::getSemesterPriority($item->semester), $item->course_title);
            })
            ->groupBy('semester');
    }

    public static function getUniqueDepartments()
    {
        return self::distinct()->pluck('department')->values();
    }
}
