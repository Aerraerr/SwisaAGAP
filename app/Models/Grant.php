<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grant extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'title',
        'description',
        'total_quantity',
        'unit_per_request',
        'available_at',
        'end_at',
    ];

    // RELATIONSHIPS
    public function grantType()
    {
        return $this->belongsTo(GrantType::class, 'type_id');
    }

    public function grantRequirements()
    {
        return $this->hasMany(GrantRequirement::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}