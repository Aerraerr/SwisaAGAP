<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Giveback;
use App\Models\User;
use Illuminate\Http\Request;

class GivebackController extends Controller
{
    public function displayGivebacks(){
        $givebacks = Giveback::with(['user.user_info', 'application.grant', 'documents', 'status'])->get();
    
        return view('swisa-support_staff.giveback', compact('givebacks'));
    }

    public function viewGiveback($id){
        $giveback = Giveback::with(['user.user_info', 'application.grant', 'documents', 'status'])->findOrFail($id);

        $givebackHistory = Giveback::with(['status'])->where('user_id', $giveback->user_id)->orderBy('created_at', 'desc')->get(); //->where('id', '!=', $giveback->id)->
    
        return view('swisa-support_staff.view-giveback', compact('giveback', 'givebackHistory'));
    }

    public function updateStatus(Request $request, $id){
        $giveback = Giveback::findOrFail($id);

        $giveback->status_id = '46';
        $giveback->save();

        return redirect()->back()->with('success', 'Giveback marked as received.');
    }
}
