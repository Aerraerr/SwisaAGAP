<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Role;
use App\Models\Application;
use App\Models\Document;
use App\Models\Notification;
use App\Models\Training;
use App\Models\UserInfo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\CreditScore;
use App\Models\CreditScoreHistory;
use App\Models\PhoneOtp;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasApiTokens, Notifiable;

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
        'qr_code',
        'login_method',
        'role_id',
        'email_verified_at',
        'phone_verified_at',
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
             'phone_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getFormattedIdAttribute(){
        return 'MEM-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    //RELATIONSHIP TO USERS\

    //for role: each user belongs to a role (1:1)
    public function role(){
        return $this->belongsTo(Role::class);
    }

    //for user_info: sa web
    public function user_info(){
        return $this->hasOne(UserInfo::class);
    }

    //for user_info: sa mobile ini
    public function userInfo(){
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
