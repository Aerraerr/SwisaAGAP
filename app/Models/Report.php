<?php

namespace App\Models;

use App\Models\Participant;
use App\Models\Training;

class Report
{
    public static function totalRegisteredParticipants()
    {
        return Participant::count();
    }

    public static function totalCheckedIn()
    {
        return Participant::whereNotNull('check_in_at')->count();
    }

    public static function totalQRScanned()
    {
        return Participant::where('qr_scanned', 1)->count();
    }

    public static function averageEventAttendance()
    {
        $total = self::totalRegisteredParticipants();
        $checkedIn = self::totalCheckedIn();
        return $total > 0 ? round(($checkedIn / $total) * 100, 2) : 0;
    }

    public static function mostAttendedTraining()
    {
        $training = Training::withCount('participants')
            ->orderByDesc('participants_count')
            ->first();

        return $training ? [
            'title' => $training->title,
            'participants' => $training->participants_count
        ] : null;
    }

    public static function trainingBreakdown()
    {
        return Training::withCount('participants')
            ->withCount(['participants as checked_in_count' => function($q) {
                $q->whereNotNull('check_in_at');
            }])
            ->get()
            ->map(function ($t) {
                return [
                    'title' => $t->title,
                    'total_participants' => $t->participants_count,
                    'checked_in' => $t->checked_in_count,
                    'attendance_rate' => $t->participants_count > 0 
                        ? round(($t->checked_in_count / $t->participants_count) * 100, 2)
                        : 0
                ];
            });
    }
}
