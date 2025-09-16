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

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
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

}
