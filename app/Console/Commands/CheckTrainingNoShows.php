<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Training;
use App\Models\Participant;
use App\Models\CreditScore;
use App\Models\CreditScoreHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckTrainingNoShows extends Command
{
    protected $signature = 'training:check-no-shows';
    protected $description = 'Check for users who did not attend past trainings and deduct points';

    public function handle()
    {
        $pastTrainings = Training::where('date', '<', Carbon::today())->get();

        $this->info("Found {$pastTrainings->count()} past trainings to check.");

        foreach ($pastTrainings as $training) {
            // Get participants who did NOT scan QR code
            $noShows = Participant::where('training_id', $training->id)
                ->where('qr_scanned', 0) // Did not scan QR
                ->get();

            foreach ($noShows as $participant) {
                // Check if already deducted
                $alreadyDeducted = CreditScoreHistory::where('user_id', $participant->user_id)
                    ->where('training_id', $training->id)
                    ->where('change_amount', -5)
                    ->exists();

                if (!$alreadyDeducted) {
                    DB::transaction(function () use ($participant, $training) {
                        $creditScore = CreditScore::where('user_id', $participant->user_id)->first();
                        
                        if ($creditScore) {
                            $creditScore->current_score = max(0, $creditScore->current_score - 5);
                            $creditScore->save();

                            CreditScoreHistory::create([
                                'user_id' => $participant->user_id,
                                'training_id' => $training->id,
                                'change_amount' => -5,
                                'reason' => 'Did not attend training: ' . $training->title,
                            ]);

                            $this->info("Deducted 5 points from user {$participant->user_id} for missing {$training->title}");
                        }
                    });
                }
            }
        }

        $this->info('No-show check completed!');
        return 0;
    }
}
