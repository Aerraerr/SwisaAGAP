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
        'title',
        'message',
        'image',
        'posted_at',
    ];

    // this makes it a Carbon instance
    protected $casts = [
        'posted_at' => 'date', 
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
}
