<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Document;
use App\Models\User;
use App\Models\Status;
use App\Models\Grant;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grant_id',
        'status_id',
        'application_type',
        'purpose',
        'is_checked_by_staff',
        'checked_by_staff_at',
        'form_img',
    ];

    protected $casts = [
        'checked_by_staff_at' => 'datetime',
    ];

    //for display id with additional number and prefix
    public function getFormattedIdAttribute(){
        // Determine prefix based on application_type
        $prefix = match ($this->application_type) {
            'Membership' => 'MEM',
            'Grant Application' => 'REQ',
            default => 'APP', // fallback if ever needed
        };

        // Zero-padding (6 digits)
        $number = str_pad($this->id, 6, '0', STR_PAD_LEFT);

        return $prefix . '-' . $number;
    }

    //RELATIONSHIPS

    //application belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //application has a status
    public function status(){
        return $this->belongsTo(Status::class);
    }

    //application may belong to a grant
    public function grant(){
        return $this->belongsTo(Grant::class);
    }

    public function statusHistories(){
        return $this->hasMany(ApplicationStatusHistory::class)
            ->orderBy('created_at', 'asc');  // Oldest first
    }

    //application has one or many documents
    public function documents(){
        return $this->morphMany(Document::class, 'documentable');
    }
    public function grantClaim(){
        return $this->hasOne(GrantClaim::class);
    }
}
