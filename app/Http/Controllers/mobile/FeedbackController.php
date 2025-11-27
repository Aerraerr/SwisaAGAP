<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
public function store(Request $request)
{
    $validated = $request->validate([
        'rating'   => 'nullable|integer|min:1|max:5',
        'feedback' => 'nullable|string|max:1000',
        'user_id'  => 'nullable|exists:users,id', // can be null
    ]);

    Feedback::create([
        'user_id'  => $validated['user_id'], // use request user_id or null
        'rating'   => $validated['rating'] ?? null,
        'feedback' => $validated['feedback'] ?? null,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Thank you for your feedback!'
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
