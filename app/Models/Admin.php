<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'department', // include department
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Students managed by this admin, matched by department/course.
     */
    public function students()
    {
        return $this->hasMany(User::class, 'course', 'department')
            ->where('role', 'student');
    }
}
