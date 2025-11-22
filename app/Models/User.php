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
        'password',
        'phone_number',
        'mpin',
        'role_id',
        'login_method', 
        'phone_verified_at',
        'email_verified_at',
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
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // --- Relationships ---

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function userInfo(): HasOne
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

    /**
     * Get the credit score for the user.
     */
    public function creditScore(): HasOne
    {
        return $this->hasOne(CreditScore::class);
    }

    /**
     * Get the credit score history for the user.
     */
    public function creditScoreHistory(): HasMany
    {
        return $this->hasMany(CreditScoreHistory::class)->latest();
    }

     /*Adjust the user's credit score and log it in history*/
    public function adjustCreditScore(int $points, string $activity)
    {
        // Get or create credit score
        $creditScore = $this->creditScore()->firstOrCreate(
            ['user_id' => $this->id],
            ['score' => 0]
        );

        // Update the score
        $newScore = $creditScore->score + $points;
        
        // Don't let score go below 0
        $newScore = max(0, $newScore);
        
        $creditScore->update(['score' => $newScore]);

        // Log in history
        CreditScoreHistory::create([
            'user_id' => $this->id,
            'activity' => $activity,
            'points' => $points,
        ]);

        return $newScore;
    }

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
