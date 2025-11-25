<?php
namespace App\Http\Controllers\mobile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreditScoreController extends Controller {
    public function show(Request $request) {
        $user = $request->user();

        // Eager load the relationships for efficiency
        $user->load('creditScore', 'creditScoreHistory');

        // Provide a default score of 0 if the relationship doesn't exist yet
        $currentScore = $user->creditScore ? $user->creditScore->score : 0;
        $history = $user->creditScoreHistory;

        return response()->json([
            'current_score' => $currentScore,
            'history' => $history,
        ]);
    }
}