<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReportMembership extends Model
{
    protected $table = 'user_info';

    public static function totalMembers()
    {
        return self::count();
    }

    public static function newMembersThisMonth()
    {
        return self::whereMonth('created_at', now()->month)
                   ->whereYear('created_at', now()->year)
                   ->count();
    }

    public static function activeMembersPercent()
    {
        $total = self::count();
        if ($total == 0) return 0;

        $active = self::where('last_login_at', '>=', now()->subDays(30))->count();
        return round(($active / $total) * 100);
    }
    
}
