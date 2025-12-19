<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileChat extends Model
{
    use HasFactory;

    protected $table = 'quick_replies';

    protected $fillable = [
        'question',
        'answer',
        'for_role_id',
    ];
}
