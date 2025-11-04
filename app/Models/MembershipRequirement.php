<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'requirement_id',
    ];

    // Relationship: belongs to a requirement
    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }

    // Relationship: has many documents
    public function documents()
    {
        return $this->hasMany(Document::class, 'membership_requirement_id');
    }
}
