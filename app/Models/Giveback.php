<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giveback extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'user_id',
        'status_id',
        'type',
        'quantity',
        'image_path',
        'notes',
    ];

    // belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function application(){
        return $this->belongsTo(Application::class);
    }

    // belongs to a status
    public function status(){
        return $this->belongsTo(Status::class);
    }
}
