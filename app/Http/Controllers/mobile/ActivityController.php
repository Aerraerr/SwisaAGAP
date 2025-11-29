<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        // Application statuses to show in activity history
        $finalStatuses = ['pending', 'approved', 'claimed', 'completed'];

        /*
         * 1) MEMBERSHIP APPLICATIONS
         * applications.grant_id IS NULL  → membership
         */
        $membershipActivities = DB::table('applications')
            ->join('statuses', 'applications.status_id', '=', 'statuses.id')
            ->where('applications.user_id', $userId)
            ->whereIn('statuses.status_name', $finalStatuses)
            ->whereNull('applications.grant_id')
            ->select(
                'applications.id',
                DB::raw("'membership' as activity_type"),
                'statuses.status_name as status',
                DB::raw("
                    CASE 
                        WHEN statuses.status_name = 'pending'
                            THEN 'You submitted your membership application.'
                        WHEN statuses.status_name = 'approved'
                            THEN 'Your membership application has been approved. You can now access grants and benefits.'
                        WHEN statuses.status_name = 'claimed'
                            THEN 'Your membership has been fully activated.'
                        WHEN statuses.status_name = 'completed'
                            THEN 'Your membership application is completed.'
                        ELSE 'Your membership application has been updated.'
                    END as message
                "),
                'applications.created_at as timestamp',
                'applications.created_at'
            );

        /*
         * 2) GRANT APPLICATIONS
         * applications.grant_id IS NOT NULL  → grant
         * grants.title is the grant name
         */
        $grantActivities = DB::table('applications')
            ->join('statuses', 'applications.status_id', '=', 'statuses.id')
            ->join('grants', 'applications.grant_id', '=', 'grants.id')
            ->where('applications.user_id', $userId)
            ->whereIn('statuses.status_name', $finalStatuses)
            ->whereNotNull('applications.grant_id')
            ->select(
                'applications.id',
                DB::raw("'grant' as activity_type"),
                'statuses.status_name as status',
                DB::raw("
                    CASE 
                        WHEN statuses.status_name = 'pending'
                            THEN CONCAT('You applied to ', grants.title, '.')
                        WHEN statuses.status_name = 'approved'
                            THEN CONCAT('You have been approved for ', grants.title, '. You can now claim.')
                        WHEN statuses.status_name = 'claimed'
                            THEN CONCAT('You have claimed your ', grants.title, '.')
                        WHEN statuses.status_name = 'completed'
                            THEN CONCAT('Your application for ', grants.title, ' is completed.')
                        ELSE CONCAT('Your application for ', grants.title, ' has been updated.')
                    END as message
                "),
                'applications.created_at as timestamp',
                'applications.created_at'
            );

        /*
         * 3) CONTRIBUTIONS
         * Show pending + approved contributions
         */
        $contributionActivities = DB::table('contributions')
            ->join('statuses', 'contributions.status_id', '=', 'statuses.id')
            ->where('contributions.user_id', $userId)
            ->whereIn('statuses.status_name', ['pending', 'approved'])
            ->select(
                'contributions.id',
                DB::raw("'contribution' as activity_type"),
                'statuses.status_name as status',
                DB::raw("
                    CASE 
                        WHEN statuses.status_name = 'approved'
                            THEN 'You have successfully contributed. Your contribution is now recorded. Thank you.'
                        WHEN statuses.status_name = 'pending'
                            THEN 'You have submitted a contribution. Your contribution is now recorded. Thank you.'
                        ELSE 'Your contribution has been updated.'
                    END as message
                "),
                'contributions.created_at as timestamp',
                'contributions.created_at'
            );

        // UNION all and sort by timestamp DESC
        $activities = $membershipActivities
            ->unionAll($grantActivities)
            ->unionAll($contributionActivities)
            ->orderBy('timestamp', 'desc')
            ->get();

        return response()->json([
            'data'  => $activities,
            'total' => $activities->count(),
        ], 200);
    }
}
