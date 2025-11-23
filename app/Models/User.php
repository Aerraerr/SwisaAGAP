<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Application;
use App\Models\Document;
use App\Models\Notification;
use App\Models\Training;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\CreditScore;
use App\Models\CreditScoreHistory;
use App\Models\PhoneOtp;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'email',
        'phone_number',
        'password',
        'mpin',
        'login_method', // ✅ ADDED
        'role_id',
        'email_verified_at',
        'phone_verified_at', // ✅ ADDED
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'mpin',
        'remember_token',
    ];

    /* Get the attributes that should be cast.

     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime', // ✅ ADDED
            'password' => 'hashed',
        ];
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    // Alias for consistency
    public function user_info()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function trainings()
    {
        return $this->hasMany(Training::class, 'participants');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // ============================================
    // CREDIT SCORE RELATIONSHIPS
    // ============================================

    public function creditScore()
    {
        return $this->hasOne(CreditScore::class);
    }

    public function creditScoreHistory()
    {
        return $this->hasMany(CreditScoreHistory::class);
    }

    // ============================================
    // PHONE OTP RELATIONSHIPS
    // ============================================

    /**
     * Get phone OTP records for this user
     */
    public function phoneOtps()
    {
        return $this->hasMany(PhoneOtp::class, 'phone_number', 'phone_number');
    }

    /**
     * Get latest phone OTP
     */
    public function latestPhoneOtp()
    {
        return $this->hasOne(PhoneOtp::class, 'phone_number', 'phone_number')
            ->latestOfMany();
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    /**
     * Check if user's phone is verified
     */
    public function isPhoneVerified(): bool
    {
        return $this->phone_verified_at !== null;
    }

    /**
     * Check if user's email is verified
     */
    public function isEmailVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    /**
     * Get user's full name
     */
    public function getFullNameAttribute(): string
    {
        $name = trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
        if ($this->suffix && $this->suffix !== 'N/A') {
            $name .= " {$this->suffix}";
        }
        return $name;
    }

    /**
     * Get user's identifier (email or phone)
     */
    public function getIdentifierAttribute(): string
    {
        return $this->email ?? $this->phone_number ?? 'Unknown';
    }

    /**
     * Check if user registered with email
     */
    public function isEmailUser(): bool
    {
        return $this->login_method === 'email' || !empty($this->email);
    }

    /**
     * Check if user registered with phone
     */
    public function isPhoneUser(): bool
    {
        return $this->login_method === 'phone' || !empty($this->phone_number);
    }
}
