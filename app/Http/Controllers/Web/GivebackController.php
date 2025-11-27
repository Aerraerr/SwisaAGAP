<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Giveback;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class GivebackController extends Controller
{
    public function displayGivebacks(){
        $givebacks = Giveback::with(['user.user_info', 'application.grant', 'status'])->get();
    
        return view('swisa-support_staff.giveback', compact('givebacks'));
    }

    public function viewGiveback($id){
        $giveback = Giveback::with(['user.user_info', 'application.grant', 'documents', 'status'])->findOrFail($id);

        $givebackHistory = Giveback::with(['status'])->where('user_id', $giveback->user_id)->orderBy('created_at', 'desc')->get(); //->where('id', '!=', $giveback->id)->
    
        return view('swisa-support_staff.view-giveback', compact('giveback', 'givebackHistory'));
    }

    public function updateStatus(Request $request, $id){
        try{
            $giveback = Giveback::with(['user.user_info', 'application.grant'])->findOrFail($id);

            $giveback->status_id = '46'; //received stattus
            $giveback->save();

             //store a confirmation message to table
            Notification::create([ 
                'user_id' => Auth::id(),
                'message' => "{$giveback->user->name}'s contribution to the grant '{$giveback->application->grant->title}' has been received.",
                'sent_at' => now(),
            ]);

            //for the member notification
            Notification::create([ 
                'user_id' => $giveback->user->id,
                'message' => "Thank you! Your contribution to the grant '{$giveback->application->grant->title}' has been received by Swisa Staff. Additional credit is granted to your account.",
                'sent_at' => now(),
            ]);

            /*send sms of the application
            if ($membership && $membership->phone_number) {
                
                $number = $membership->phone_number;
                $message = "[SWISA-AGAP] Contribution for grant '{$giveback->application->grant->title}' received by staff. Thank you.";

                SMSService::send($number, $message);
            }*/

            return redirect()->back()->with('success', 'Giveback marked as received.');
        }catch(\Exception $error){
            Log::error('Giveback Status Update Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while updating giveback status.');
        }
    }
}
