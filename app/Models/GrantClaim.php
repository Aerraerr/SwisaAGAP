<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrantClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'user_id',
        'reference_number',
        'qr_code',
        'claim_status',
        'valid_until',
        'claimed_at',
    ];

    protected $casts = [
        'valid_until' => 'datetime',
        'claimed_at' => 'datetime',
    ];

    // Relationships
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
