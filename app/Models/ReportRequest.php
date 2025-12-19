<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportRequest extends Model
{
    use HasFactory;

    protected $table = 'applications'; // your table name
    protected $fillable = [
        'request_id',
        'item',
        'requester_name',
        'date_submitted',
        'status',
    ];
    public $timestamps = false; // if your table doesn't use created_at/updated_at
}
