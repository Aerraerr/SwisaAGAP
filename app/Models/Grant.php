<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\GrantType;
use App\Models\Application;
use App\Models\GrantRequirement;

class Grant extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'title',
        'description',
        'total_quantity',
        'unit_per_request',
        'available_at',
        'end_at',
    ];

    //RELATIONSHIPS

    //a grant belongs to a user
    public function grant_type(){
        return $this->belongsTo(GrantType::class, 'type_id');
    }

    //a grant can have many requirements
    public function grantRequirements(){
        return $this->hasMany(GrantRequirement::class);
    }

    //a grant can have many application
    public function applications(){
        return $this->hasMany(Application::class);
    }
}
