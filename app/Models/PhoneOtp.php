<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PhoneOtp extends Model
{
    protected $fillable = [
        'phone_number',
        'otp',
        'expires_at',
        'verified',
        'attempts',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified' => 'boolean',
        'attempts' => 'integer',
    ];

    /**
     * Check if OTP is still valid
     */
    public function isValid(): bool
    {
        return !$this->verified 
            && now()->lessThan($this->expires_at)
            && $this->attempts < 3; // ✅ Max 3 attempts
    }

    /**
     * Check if OTP is expired
     */
    public function isExpired(): bool
    {
        return now()->greaterThan($this->expires_at);
    }

    /**
     * Increment verification attempts
     */
    public function incrementAttempts(): void
    {
        $this->increment('attempts');
    }

    /**
     * Scope: Get active OTP for phone number
     */
    public function scopeActiveForPhone($query, string $phoneNumber)
    {
        return $query->where('phone_number', $phoneNumber)
            ->where('verified', false)
            ->where('expires_at', '>', now())
            ->where('attempts', '<', 3) // ✅ Max 3 attempts
            ->latest();
    }

    /**
     * Relationship: User (if phone is verified and linked)
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'phone_number', 'phone_number');
    }
}
