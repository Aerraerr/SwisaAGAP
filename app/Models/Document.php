<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Status;
use App\Models\GrantRequirement;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'grant_requirement_id',
        'membership_requirement_id',
        'user_id',
        'status_id',
        'file_path',
        'file_name',
        'documentable_id',
        'documentable_type',
    ];

    //RELATIONSHIPS

    public function requirement(){
        return $this->belongsTo(Requirement::class, 'requirement_id');
    }
    //document belongs to a grant requirement
    public function grantRequirement(){
        return $this->belongsTo(GrantRequirement::class);
    }

    public function membershipRequirement()
    {
        return $this->belongsTo(MembershipRequirement::class);
    }

    //document belongs to a status
    public function status(){
        return $this->belongsTo(Status::class);
    }

    //document morphs to any model (Application, Grant, Training and more)
    public function documentable(){
        return $this->morphTo();
    }
}
