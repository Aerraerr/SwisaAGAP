<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Sector;
use App\Models\User;


class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'sector_id',
        'title',
        'date',
        'time',
        'venue',
    ];

    //RELATIONSHIPS

    //a training belongs to a sector
    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    //
    public function participants(){
        return $this->belongsToMany(User::class, 'participants')
                    ->withTimestamps();
    }
}
