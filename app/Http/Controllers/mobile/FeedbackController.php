<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller; // <-- This is required!
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating'   => 'nullable|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000',
        ]);

        Feedback::create([
            'rating'   => $validated['rating'] ?? null,
            'feedback' => $validated['feedback'] ?? null,
        ]);

        return response()->json(['success' => true, 'message' => 'Thank you for your feedback!']);
    }

    public function index()
    {
        $allFeedback = Feedback::orderBy('created_at', 'desc')->get();
        return response()->json(['success' => true, 'data' => $allFeedback]);
    }
}
