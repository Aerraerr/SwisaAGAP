<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['admin_id', 'user_id', 'support_staff_id'];
    

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function supportStaff()
    {
        return $this->belongsTo(User::class, 'support_staff_id');
    }

    //for mobile 
    public function member()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
