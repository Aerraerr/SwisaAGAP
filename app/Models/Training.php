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
        'description',
        'date',
        'time',
        'venue',
    ];

    // this makes it a Carbon instance
    protected $casts = [
        'date' => 'date', 
    ];

    //RELATIONSHIPS

    //a training belongs to a sector
    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    //for the documents/picture of grant
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
    
    //
    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants', 'training_id', 'user_id')
                    ->withPivot(['qr_scanned', 'check_in_at'])
                    ->withTimestamps();
    }
    // reports



}
