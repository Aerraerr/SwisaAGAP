<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Sector;

class UserInfo extends Model
{
    protected $table = 'user_info';
    
    protected $fillable = [
        'user_id',
        'farmer_type',
    
        'fname',
        'mname',
        'lname',
        'name', // ✅ Added (full name)
        'suffix',
        'birthdate',
        'civil_status',
        'gender',
        'profile_img',
        // ✅ NEW: Contact fields
        'contact_info',    // Raw input (email or phone)
        'phone_no',           // Extracted phone number
        'email',           // Extracted email
        
        'province',
        'city',
        'house_no',
        'barangay',
        'zone',
        'farm_location',
        'land_size',
        'water_source',
        
        // Secondary Contact
        'sc_fname',
        'sc_mname',
        'sc_lname',
        'sc_suffix',
        'sc_gender',
        
        // ✅ NEW: Secondary contact fields
        'sc_contact_info', // Raw input (email or phone)
        'sc_phone_no',        // Extracted phone number
        'sc_email',        // Extracted email
        
        'sc_province',
        'sc_city',
        'sc_house_no',
        'sc_barangay',
        'sc_zone',
        'relationship',
        'qr_code',
    ];

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedIdAttribute()
    {
        // Use the primary key or user_id
        $baseId = $this->id ?? $this->user_id ?? 0;

        return 'MEM-' . str_pad($baseId, 6, '0', STR_PAD_LEFT);
    }
    public function sector()
{
    return $this->belongsTo(Sector::class, 'sector_id', 'id');
}


}