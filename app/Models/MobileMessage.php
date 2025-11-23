<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileMessage extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'chat_id',
        'user_id',
        'message',
        'is_read',
    ];

    public function chat()
    {
        return $this->belongsTo('App\Models\Chat', 'chat_id');
    }

    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
