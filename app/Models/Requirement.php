<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Grant;
use App\Models\GrantRequirement;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'requirement_name',
    ];

    //a requirement can belong to many grants (through grant_requirements) (M:M)
    public function grants(){
        return $this->belongsToMany(Grant::class, 'grant_requirements')
                    ->withTimestamps();
    }

    //a requirement can be linked via grant_requirements
    public function grantRequirements(){
        return $this->hasMany(GrantRequirement::class);
    }
}
