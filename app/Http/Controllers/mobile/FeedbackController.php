<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{

public function store(Request $request)
{
    $validated = $request->validate([
        'rating'    => 'nullable|integer|min:1|max:5',
        'feedback'  => 'nullable|string|max:1000',
        'anonymous' => 'nullable|boolean',
    ]);

    $user = $request->user(); // Sanctum, required 

    // For the feedback table: hide identity if anonymous
    $feedbackUserId = ($validated['anonymous'] ?? false)
        ? null
        : ($user?->id);

    Feedback::create([
        'user_id'  => $feedbackUserId,          // may be null
        'rating'   => $validated['rating'] ?? null,
        'feedback' => $validated['feedback'] ?? null,
    ]);

    // For the activity log: always tie to real user
    if ($user) {
        DB::table('activity_history')->insert([
            'user_id'    => $user->id,          // always fetch user id to show in the logs
            'type'       => 'Feedback Submitted',
            'message'    => 'You have submitted feedback.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return response()->json([
        'success' => true,
        'message' => 'Thank you for your feedback!',
    ]);
}

    public function index()
    {
        $allFeedback = Feedback::with('user') // include user info
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $allFeedback
        ]);
    }
    public function showFeedback()
{
    // Get all feedbacks with their related user (if user_id is null, user() will be null)
    $feedbacks = Feedback::with('user')->latest()->get();

    return view('dashboard', compact('feedbacks'));
}
}