<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'for_role_id',
    ];

    // Relationship to Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'for_role_id');
    }
}
