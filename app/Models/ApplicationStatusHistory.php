<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStatusHistory extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'application_id',
        'status_id',
        'notes',
        'changed_by',
        'created_at',
        'updated_at',
    ];

    // ✅ Cast created_at and updated_at to datetime
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}