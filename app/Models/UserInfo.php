<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Sector;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = 'user_info';

    protected $fillable = [
        'user_id',
        'sector_id',
        'fname',
        'mname',
        'lname',
        'suffix',
        'birthdate',
        'gender',
        'contact_no',
        'province',
        'city',
        'barangay',
        'zone',
        'profile_img',
        'farm_location',
        'land_size',
        'water_source',
        'sc_fname',
        'sc_mname',
        'sc_lname',
        'sc_suffix',
        'sc_gender',
        'sc_contact_no',
        'sc_email',
        'sc_province',
        'sc_city',
        'sc_barangay',
        'sc_zone',
        'relationship',
    ];

    const Sexes = ['Male', 'Female'];
    const Suffix = ['Jr', 'Sr', 'I', 'II', 'III', 'IV', 'V'];
    const Relation = ['Parent', 'Sibling', 'Spouse', 'Child', 'Friend', 'Guardian', 'Relative'];

    //RELATIONSHIPS

    // user_info belongs to one user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // user_info belongs to a sector
    public function sector(){
        return $this->belongsTo(Sector::class);
    }
}
