<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrantReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'notes',
    ];

    
    public function user(){
        return $this->belongsTo(User::class);
    }

     public function application(){
        return $this->belongsTo(Application::class);
    }

    public function documents(){
        return $this->morphMany(Document::class, 'documentable');
    }
}
