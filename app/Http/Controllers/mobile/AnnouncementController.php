<?php

namespace App\Http\Controllers\mobile;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Carbon\Carbon;

class AnnouncementController extends Controller
{
    public function index(Request $request)
   {
        $filter = $request->query('filter');
        $query = Announcement::query();

        if ($filter === 'today') {
            $query->whereDate('posted_at', Carbon::today());
        } elseif ($filter === 'last_week') {
            $query->whereBetween('posted_at', [
                Carbon::now()->subWeek(),   
                Carbon::now()
            ]);
        } elseif ($filter === 'last_month') {
            $query->whereBetween('posted_at', [
                Carbon::now()->subMonth(),
                Carbon::now()
            ]);
        }

        $announcements = $query->orderBy('posted_at', 'desc')->get();

        return response()->json($announcements);
    }

}
