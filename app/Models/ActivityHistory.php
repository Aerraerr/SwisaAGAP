<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityHistory extends Model
{
    use SoftDeletes;

    protected $table = 'activity_history';

    protected $fillable = [
        'user_id',
        'type',
        'message',
    ];

    // Relationship: Each activity belongs to a user
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
