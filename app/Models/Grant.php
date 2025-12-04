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
        'amount_per_quantity',
        'available_at',
        'end_at',
    ];

    // this makes it a Carbon instance
    protected $casts = [
        'available_at' => 'date', 
        'end_at' => 'date', 
    ];

    //RELATIONSHIPS

    //a grant belongs to a user
    public function grant_type(){
        return $this->belongsTo(GrantType::class, 'type_id');
    }

    public function grantType(){ // sa mobile mdj 
        return $this->belongsTo(GrantType::class, 'type_id');
    }

    //a grant can have many requirements
    public function requirements(){
        return $this->belongsToMany(Requirement::class, 'grant_requirements');
    }

    public function grant_requirements(){
        return $this->hasMany(GrantRequirement::class, 'grant_id');
    }

    public function grantRequirements(){
        return $this->hasMany(GrantRequirement::class, 'grant_id');
    }

    public function membership_requirements(){
        return $this->hasMany(MembershipRequirement::class, 'grant_id');
    }

    //a grant can have many application
    public function applications(){
        return $this->hasMany(Application::class);
    }

    //for the documents/picture of grant
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
