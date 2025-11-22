<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditScore extends Model
{
    protected $fillable = ['user_id', 'score'];

    // Set default value at model level
    protected $attributes = [
        'score' => 0,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
