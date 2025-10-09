<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Role;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'status_id',
        'title',
        'message',
        'audience',
        'image',
        'posted_at',
        'end_at',
    ];

    const AUDIENCE = ['All', 'Members', 'Support Staff', 'Admin'];

    // this makes it a Carbon instance
    protected $casts = [
        'posted_at' => 'date', 
        'end_at' => 'date',
    ];

    //announcement belongs to a role
    public function role(){
        return $this->belongsTo(Role::class);
    }

    //for the documents/picture of grant
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    //announcement has a status
    public function status(){
        return $this->belongsTo(Status::class);
    }
}
