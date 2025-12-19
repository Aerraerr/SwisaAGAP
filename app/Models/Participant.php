<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Training;
use App\Models\User;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['training_id', 'user_id', 'qr_scanned', 'check_in_at'];

    //RELATIONSHIPS

    //participant belongs to a training
    public function training(){
        return $this->belongsTo(Training::class);
    }

    //participant belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
