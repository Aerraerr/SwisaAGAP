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
        'title_name',
        'message',
        'image',
        'posted_at',
    ];

    //announcement belongs to a role
    public function role(){
        return $this->belongsTo(Role::class);
    }
}
