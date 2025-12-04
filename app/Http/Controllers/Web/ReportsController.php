<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportsController extends Controller
{
    
    public function engagement(Request $request)
    {
        return response()->json([
            'average_attendance' => Report::averageEventAttendance(),
            'total_participants' => Report::totalRegisteredParticipants(),
            'total_checked_in' => Report::totalCheckedIn(),
            'total_qr_scanned' => Report::totalQRScanned(),
            'top_training' => Report::mostAttendedTraining(),
            'training_breakdown' => Report::trainingBreakdown()
        ]);
    }
    

    
}
