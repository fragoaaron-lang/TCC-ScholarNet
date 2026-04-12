<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'email_verified_at',
        'password',
        'role', // 'student', 'admin', etc.
        'is_approved',
        'termination_at',
        'first_name',
        'middle_name',
        'last_name',
        'student_number',
        'course',
        'year_level',
        'profile_photo'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
protected $dates = [
    'termination_at'
];
    // A student may have many applications
 public function requirements()
{
    return $this->hasMany(Requirement::class);
}

public function applications()
{
    return $this->hasMany(Application::class, 'student_id');
}

    /**
     * Get the email verification tokens for the user.
     */
    public function emailVerifications()
    {
        return $this->hasMany(EmailVerification::class);
    }
}
