<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'audience_type',
        'target_department',
        'user_id',
        'admin_id',
    ];

    /**
     * Scope announcements for a department secretary.
     * They get:
     * - all_students
     * - secretaries
     * - department-specific (their department)
     */
    public function scopeForDepartmentSecretary($query, $department)
    {
        return $query->where(function ($q) use ($department) {
            $q->where('audience_type', 'all_students')
              ->orWhere('audience_type', 'secretaries')
              ->orWhere(function ($q2) use ($department) {
                  $q2->where('audience_type', 'department')
                     ->where('target_department', $department);
              });
        });
    }

    /**
     * Scope announcements for admin manager (global admin).
     * Admin manager gets everything.
     */
    public function scopeForAdminManager($query)
    {
        return $query;
    }

    /**
     * Scope announcements for students (student dashboard):
     * - all_students
     * - department-specific for student course
     */
    public function scopeForStudents($query, $department)
    {
        return $query->where(function ($q) use ($department) {
            $q->where('audience_type', 'all_students')
              ->orWhere(function ($q2) use ($department) {
                  $q2->where('audience_type', 'department')
                     ->where('target_department', $department);
              });
        });
    }
}

