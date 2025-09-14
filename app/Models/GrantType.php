<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Grant;

class GrantType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
    ];

    //RELATIONSHIPS

    //a grant type has many grants
    public function grants(){
        return $this->hasMany(Grant::class, 'type_id');
    }
}
