<?php

namespace App\Http\Controllers;

use App\Models\Feedback;

class ReportFeedbackController extends Controller
{
    public function index()
    {
        // Get all feedback with user relationship
        $feedbackList = Feedback::with('user')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($item) {
                return [
                    'id'        => $item->id,
                    'user'      => $item->user ? $item->user->name : 'Anonymous User',
                    'rating'    => $item->rating ?? 0,
                    'feedback'  => $item->feedback ?? '',
                    'date'      => $item->created_at->diffForHumans(),
                ];
            });

        // Average rating
        $average = Feedback::whereNotNull('rating')->avg('rating');
        $average = $average ? round($average, 2) : 0;

        // Rating percentage for large number
        $ratingPercent = $average ? round(($average / 5) * 100) : 0;

        // Count total ratings
        $totalRatings = Feedback::whereNotNull('rating')->count();

        // Breakdown (1–5 stars)
        $starCounts = [];
        for ($i = 5; $i >= 1; $i--) {
            $starCounts[$i] = Feedback::where('rating', $i)->count();
        }

        return view('swisa-admin.reports', [
            'feedbackList'  => $feedbackList,
            'averageRating' => $average,
            'ratingPercent' => $ratingPercent,
            'totalRatings'  => $totalRatings,
            'starCounts'    => $starCounts,
        ]);
    }
}
