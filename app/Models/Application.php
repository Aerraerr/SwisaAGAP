<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Document;
use App\Models\User;
use App\Models\Status;
use App\Models\Grant;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grant_id',
        'status_id',
        'application_type',
        'purpose',
    ];

    // RELATIONSHIPS

    // application belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // application has a status
    public function status(){
        return $this->belongsTo(Status::class);
    }

    // application may belong to a grant
    public function grant(){
        return $this->belongsTo(Grant::class);
    }

    // ✅ ADDED: application has many documents (polymorphic)
    public function documents(){
        return $this->morphMany(Document::class, 'documentable');
    }

    // ✅ Add this relationship
    public function grantClaim()
    {
        return $this->hasOne(GrantClaim::class);
    }
}
