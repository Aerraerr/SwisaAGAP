<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditScore extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'score'];

    public function setScoreAttribute($value)
    {
         $this->attributes['score'] = max(0, min($value, 50));
    }

    // ✅ Add relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
