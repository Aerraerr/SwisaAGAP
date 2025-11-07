<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'grant_id',
        'status_id',
        'application_type',
        'purpose',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function grant()
    {
        return $this->belongsTo(Grant::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(ApplicationStatusHistory::class)
            ->orderBy('created_at', 'asc');  // Oldest first
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function grantClaim()
    {
        return $this->hasOne(GrantClaim::class);
    }
}
