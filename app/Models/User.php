<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'email_verified_at',
        'last_email_verified_at',
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
    'termination_at',
    'email_verified_at',
    'last_email_verified_at'
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

    /**
     * Check if the user's email is verified.
     */
    public function hasVerifiedEmail(): bool
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Mark the user's email as verified.
     */
    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
            'last_email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Check if email verification has expired (requires re-verification every 30 days).
     * Returns true if re-verification is needed.
     */
    public function needsEmailReVerification(): bool
    {
        // If email is not verified yet, they need verification
        if (!$this->hasVerifiedEmail()) {
            return true;
        }

        // If last_email_verified_at is null, require verification
        if (is_null($this->last_email_verified_at)) {
            return true;
        }

        // Require re-verification every 30 days
        $requiresReVerification = $this->last_email_verified_at->addDays(30)->isPast();
        
        return $requiresReVerification;
    }

    /**
     * Send email verification notification.
     */
    public function sendEmailVerificationNotification(): void
    {
        $verification = EmailVerification::createForUser($this);
        $this->notify(new \App\Notifications\VerifyEmail($verification));
    }
}
