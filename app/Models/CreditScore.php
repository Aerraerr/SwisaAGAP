<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditScore extends Model
{
    protected $fillable = ['user_id', 'score'];

    public function setScoreAttribute($value)
    {
         $this->attributes['score'] = max(0, min($value, 50));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
