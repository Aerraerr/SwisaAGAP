<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // alion nalang pag okay na
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


    //RELATIONSHIP TO USERS\

    //for role: each user belongs to a role (1:1)
    public function role(){
        return $this->belongsTo(Role::class);
    }

    //for user_info: each user has one profile information (1:1)
    public function user_info(){
        return $this->hasOne(UserInfo::class);
    }

    //for applications: a user can submit many applications (1:M)
    public function applications(){
        return $this->hasMany(Application::class);
    }

    //for documents: a user can upload many documents (polymorphic relation)
    public function documents(){
        return $this->morphMany(Document::class, 'documentable');
    }

    //for trainings: a user can attend many trainings
    public function trainings(){
        return $this->hasMany(Training::class, 'participants');
    }

    //for notifications: a user can have many notifications
    public function notifications(){
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
