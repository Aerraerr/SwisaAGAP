<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\Participant;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function scanQr(Request $request, $qr_code)
    {
        $trainingId = $request->training_id;

        // 1. FIND USER
        $user = UserInfo::where('qr_code', $qr_code)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ]);
        }

        // 2. FIND PARTICIPANT ENTRY
        $participant = Participant::where([
            'training_id' => $trainingId,
            'user_id'     => $user->user_id
        ])->first();

        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'User is not registered for this training.'
            ]);
        }

        // 3. CHECK IF ALREADY SCANNED
        if ($participant->qr_scanned == 1) {
            return response()->json([
                'success' => true,
                'already_scanned' => true,
                'member_id' => $user->user_id,
                'name' => $user->fname . ' ' . $user->lname,
                'message' => 'User already checked in.'
            ]);
        }

        // 4. UPDATE SCAN STATUS
        $participant->qr_scanned = 1;
        $participant->check_in_at = Carbon::now();
        $participant->save();

        // 5. RETURN SUCCESS
        return response()->json([
            'success' => true,
            'already_scanned' => false,
            'member_id' => $user->user_id,
            'name' => $user->fname . ' ' . $user->lname,
            'message' => 'Attendance recorded successfully!'
        ]);
    }
}
