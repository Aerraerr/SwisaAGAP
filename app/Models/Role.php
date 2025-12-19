<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Role extends Model
{
    use HasFactory;
    
    protected $table = 'roles';

    protected $fillable = [
        'role_name',
    ];

    // Users under this role
    public function users() {
        return $this->hasMany(User::class);
    }

    // ✅ Automatically format role_name when accessed
    public function getRoleNameAttribute($value)
    {
        return ucwords(str_replace('_', ' ', $value));
    }
}
