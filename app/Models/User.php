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
            'password' => 'hashed',
        ];
    }

    /*Boot method - automatically create credit score when user is created*/
    protected static function booted()
    {
        static::created(function ($user) {
            CreditScore::create([
                'user_id' => $user->id,
                'score' => 20
            ]);
        });
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
            ['score' => 20]
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
}
