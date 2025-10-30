<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\UserInfo;
use App\Models\Training;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'sector_name',
    ];

    //RELATIONSHIPS

    //a sector can have many users
    public function userInfo(){
        return $this->hasMany(UserInfo::class);
    }

    //sector can have many trainings
    public function trainings(){
        return $this->hasMany(Training::class);
    }
}