<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class EmailVerification extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'token',
        'expires_at',
        'verified_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /**
     * Get the user that owns the email verification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the token is expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Check if the token is verified.
     */
    public function isVerified(): bool
    {
        return !is_null($this->verified_at);
    }

    /**
     * Generate a 6-digit OTP token.
     */
    public static function generateToken(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Create a new email verification token for a user.
     */
    public static function createForUser(User $user): self
    {
        // Delete any existing unverified tokens for this user
        self::where('user_id', $user->id)
            ->whereNull('verified_at')
            ->delete();

        return self::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'token' => self::generateToken(),
            'expires_at' => Carbon::now()->addMinutes(15), // 15 minutes expiry
        ]);
    }
}
