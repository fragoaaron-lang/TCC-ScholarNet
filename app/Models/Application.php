<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Application extends Model
{
    protected $fillable = [
        'student_id', 'course_name', 'status'
    ];

    // Link application to student
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
