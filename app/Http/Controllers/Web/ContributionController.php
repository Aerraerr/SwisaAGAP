<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\CreditScore;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\SMSService;
use Illuminate\Support\Facades\Auth;

class ContributionController extends Controller
{
    public function displayGivebacks(){
        $perPage = (int) request('per_page', 10);
        $perPage = in_array($perPage, [10, 20, 50, 100]) ? $perPage : 10;

        $givebacks = Contribution::with(['user.user_info', 'application.grant', 'status'])->paginate($perPage)->withQueryString();
    
        return view('swisa-support_staff.giveback', compact('givebacks'));
    }

    public function viewGiveback($id){
        $giveback = Contribution::with(['user.user_info', 'application.grant', 'status'])->findOrFail($id);

        $givebackHistory = Contribution::with(['status'])->where('user_id', $giveback->user_id)->orderBy('created_at', 'desc')->get(); //->where('id', '!=', $giveback->id)->
    
        return view('swisa-support_staff.view-giveback', compact('giveback', 'givebackHistory'));
    }

    public function updateStatus(Request $request, $id){
        try{
            $giveback = Contribution::with(['user.user_info', 'application.grant'])->findOrFail($id);

            $giveback->status_id = '5'; //received stattus
            $giveback->save();

            //add credit addtion + 10

             //store a confirmation message to table
            Notification::create([ 
                'user_id' => Auth::id(),
                'message' => "{$giveback->user->first_name} {$giveback->user->last_name}'s contribution to the grant '{$giveback->application->grant->title}' has been received.",
                'sent_at' => now(),
            ]);

            //for the member notification
            Notification::create([ 
                'user_id' => $giveback->user->id,
                'message' => "Thank you! Your contribution to the grant '{$giveback->application->grant->title}' has been received by Swisa Staff. Additional credit is granted to your account.",
                'sent_at' => now(),
            ]);

            // Check if a CreditScore record already exists for this user.
            $existingScore = CreditScore::where('user_id', $giveback->user->id)->first();

            if ($existingScore) {
                // Add 10 to current score
                $existingScore->score += 5;
                $existingScore->save();

                Log::info('Credit Score updated (+10) for User ID: ' . $giveback->user->id);
            } else {
                // Create new score if none exists
                CreditScore::create([
                    'user_id' => $giveback->user->id,
                    'score' => 20, // Or 10 if you want starting score to be same as bonus
                ]);

                Log::info('Credit Score created for new member User ID: ' . $giveback->user->id);
            }

            //send sms of the application
            if (
                $giveback->user && 
                $giveback->user->user_info && 
                $giveback->user->user_info->phone_number) {
                $number = $giveback->user->user_info->phone_number;

                $message = "[SWISA-AGAP] Contribution for grant '{$giveback->application->grant->title}' has been received by staff. Thank you.";

                SMSService::send($number, $message);
            }

            return redirect()->back()->with('success', 'Giveback marked as received.');
        }catch(\Exception $error){
            Log::error('Giveback Status Update Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while updating giveback status.');
        }
    }
}
