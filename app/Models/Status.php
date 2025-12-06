<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Document;
use App\Models\Application;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_name',
    ];

    //RELATIONSHIPS

    //A status can belong to many applications
    public function applications(){
        return $this->hasMany(Application::class);
    }

    //status can belong to many a
    public function documents(){
        return $this->hasMany(Document::class);
    }

    public function giveback(){
        return $this->hasMany(Contribution::class);
    }
}
