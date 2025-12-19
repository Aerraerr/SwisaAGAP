<?php
namespace App\Http\Controllers\mobile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreditScoreController extends Controller {
    public function show(Request $request) {
        $user = $request->user();

        // Eager load the relationships for efficiency
        $user->load('creditScore', 'creditScoreHistory');

        // Now you can safely use the score - it defaults to 20 from the model
        $currentScore = $user->creditScore?->score ?? 20;
        $history = $user->creditScoreHistory;

        return response()->json([
            'current_score' => $currentScore,
            'history' => $history,
        ]);
    }
}
