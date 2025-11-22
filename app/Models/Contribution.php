<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $table = 'contributions'; // ✅ Matches your migration
    
    protected $fillable = [
        'application_id',
        'user_id',
        'status_id',
        'type',
        'quantity',
        'image_path',
        'notes',
    ];

    // ✅ RELATIONSHIPS
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}