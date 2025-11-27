<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'role',
        'activity',
        'ip_address',
        'status',
        'activity_timestamp',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
        'activity_timestamp' => 'datetime',
    ];

    /**
     * Relationship to the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
