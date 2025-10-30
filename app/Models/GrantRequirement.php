<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Document;
use App\Models\Grant;
use App\Models\Requirement;

class GrantRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'grant_id',
        'requirement_id',
    ];

    //RELATIONSHIPS

    //a gratn requirement belongs to a grant
    public function grant(){
        return $this->belongsTo(Grant::class);
    }

    //grant requirement belongs to a requirement
    public function requirement(){
        return $this->belongsTo(Requirement::class);
    }

    //grant requirement can have many documents
    public function doucments(){
        return $this->hasMany(Document::class);
    }
}