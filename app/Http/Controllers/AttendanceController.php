<?php

namespace App\Http\Controllers;

use App\Models\CreditScore;
use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\Participant;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function scanQr(Request $request, $qr_code)
    {
        $trainingId = $request->training_id;

        // 1. FIND USER
        $user = User::where('qr_code', $qr_code)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ]);
        }

        // 2. FIND PARTICIPANT ENTRY
        $participant = Participant::where([
            'training_id' => $trainingId,
            'user_id'     => $user->id
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
                'member_id' => $user->id,
                'name' => $user->first_name . ' ' . $user->last_name,
                'message' => 'User already checked in.'
            ]);
        }

        // 4. UPDATE SCAN STATUS
        $participant->qr_scanned = 1;
        $participant->check_in_at = Carbon::now();
        $participant->save();

        //ADD +5 CREDIT SCORE
        $existingScore = CreditScore::where('user_id', $user->id)->first();

        if ($existingScore) {
            $existingScore->score += 5;
            $existingScore->save();
        } else {
            CreditScore::create([
                'user_id' => $user->id,
                'score'   => 5
            ]);
        }

        // 5. RETURN SUCCESS
        return response()->json([
            'success' => true,
            'already_scanned' => false,
            'member_id' => $user->id,
            'name' => $user->first_name . ' ' . $user->last_name,
            'message' => 'Attendance recorded successfully!'
        ]);
    }
}
