<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Grant;
use App\Models\GrantType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrantController extends Controller
{
    //add grant function
    public function addGrant(Request $request){
        // validate the form data/input
        $request->validate([
            'grant_name' => 'required|string|max:255',
            'grant_type' => 'required|exists:grant_types,id',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric|min:1',
            'unit_per_request' =>  'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        //store to table 'grants'
        $grant = Grant::create([
            'title' => $request->grant_name,
            'type_id' => $request->grant_type,
            'description'   => $request->description,
            'total_quantity' => $request->quantity,
            'unit_per_request' =>  $request->unit_per_request,
            'available_at' => $request->start_date,
            'end_at' => $request->end_date,
        ]);

        //handle the file upload
        if ($request->hasFile('grant_image')) {
            $file = $request->file('grant_image');
            $path = $file->store('grants', 'public'); // saves in storage/app/public/grants

            $grant->documents()->create([
                'file_path'  => $path,
                'file_name'  => $file->getClientOriginalName(),
            ]);
        }


        return redirect()->back()->with('success', 'Grant Added!');
    }

    public function showGrantTypes(){
        $grantTypes = GrantType::all();
        return view('swisa-admin.grantsNequipment', compact('grantTypes'));
    }
}
