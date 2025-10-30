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
// --- ADD THESE MISSING IMPORTS ---
use App\Models\CreditScore;
use App\Models\CreditScoreHistory;

class User extends Authenticatable
{
    // ⭐️ REQUIRED FOR SANCTUM: Add the HasApiTokens trait here
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'first_name',
    'middle_name',
    'last_name',
    'suffix',
    'email',
    'phone_number',
    'password',
    'mpin',
    'role_id',
    'email_verified_at',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'mpin', // Hide MPIN for security
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- Existing Relationships ---
    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function user_info(){
        return $this->hasOne(UserInfo::class);
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }

    public function documents(){
        return $this->morphMany(Document::class, 'documentable');
    }

    public function trainings(){
        return $this->hasMany(Training::class, 'participants');
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    // --- NEW CREDIT SCORE RELATIONSHIPS ---

    // In User.php model
public function creditScore()
{
    return $this->hasOne(CreditScore::class);
}

public function creditScoreHistory()
{
    return $this->hasMany(CreditScoreHistory::class);
}
}