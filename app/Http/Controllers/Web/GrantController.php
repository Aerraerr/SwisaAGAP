<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Carbon\Carbon; 
use App\Models\Grant;
use App\Models\GrantType;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class GrantController extends Controller
{
    //show grants types
    public function showGrantTypes(){
        return GrantType::all();
    }

    //show grants with documents (if any)
    public function showGrants(){
        $perPage = (int) request('per_page', 10);
        $perPage = in_array($perPage, [10, 20, 50, 100]) ? $perPage : 10;
        
        return Grant::with('documents')->where('end_at', '>=', Carbon::today())
        //Order by the nearest date_end
        ->orderBy('end_at', 'asc')
        ->paginate($perPage)->withQueryString();
    }
    
    public function showRequirements(){
        return Requirement::all();
    }

    //add grant function
    public function addGrant(Request $request){
        try{
            // validate the form data/input
            $request->validate([
                'grant_name' => 'required|string|max:255',
                'grant_type' => 'required|exists:grant_types,id',
                'description' => 'nullable|string',
                'quantity' => 'required|numeric|min:1',
                'unit_per_request' =>  'required|numeric|min:1',
                'amount_per_quantity' => 'required|numeric|min:1',
                'requirements' => 'array', // multi requirements
                'requirements.*' => 'exists:requirements,id',
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
                'amount_per_quantity' => $request->amount_per_quantity,
                'available_at' => $request->start_date,
                'end_at' => $request->end_date,
            ]);

            //handle the file upload
            if ($request->hasFile('grant_image')) {
                $file = $request->file('grant_image');
                $path = $file->store('grants', 'public'); // saves in storage/app/public/grants

                $grant->documents()->create([
                    'file_path'  => $path,
                    'file_name'  => $file->getClientOriginalName(), //gets the file name (e.g. docs.jpg)
                ]);
            }

            // Attach requirements (if any selected)
            if ($request->has('requirements')) {
                $grant->requirements()->sync($request->requirements); //syncs to the pivot table 'grant_requirements'
            }

            return redirect()->back()->with('success', 'Grant Added!');
        }catch(\Exception $error){
            Log::error('Grant Creation Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while creating grant.');
        }
    }

    //function to display grant data via variables 'grantTypes' and 'grants'
    public function displayGrants(){
        $grants = $this->showGrants();
        $grantTypes = $this->showGrantTypes();
        $requirements = $this->showRequirements();

        return view('swisa-admin.grantsNequipment', compact('grantTypes', 'grants', 'requirements'));
    }

    //function to show specific data viewed in grants
    public function viewGrantDetails($id){
        $grant = Grant::with(['grant_type', 'documents', 'applications.user', 'applications.user.user_info', 'requirements'])->findOrFail($id);

        $totalAmount = $grant->total_quantity * $grant->amount_per_quantity;

        $grantTypes = GrantType::all();      
        $requirements = Requirement::all();
    
        return view('swisa-admin.view-grant', compact('grant', 'grantTypes', 'requirements', 'totalAmount'));
    }

    //function for adding stock grant
    public function addGrantStock(Request $request, $id){
        try{
            $request->validate([
                'options' => 'required|array',
                'options.*' => 'nullable|numeric|min:1',
            ]);

            $grant = Grant::findOrFail($id);

            $totalToAdd = collect($request->options)
                ->filter(fn($value) => !is_null($value) && $value !== '')
                ->sum();

            // Update total_quantity
            $grant->total_quantity += $totalToAdd;
            $grant->save();
            
            return redirect()->back()->with('success', 'Stock Added!');
        }catch(\Exception $error){
            Log::error('Adding Grant Stock Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while adding grant stock.');
        }
    }

    //function to edit info of the grant
    public function editGrantInfo(Request $request, $id){
        
        try{
            // validate the form data/input
            $request->validate([
                'grant_name' => 'required|string|max:255',
                'grant_type' => 'required|exists:grant_types,id',
                'description' => 'nullable|string',
                'quantity' => 'required|numeric|min:1',
                'unit_per_request' =>  'required|numeric|min:1',
                'requirements' => 'array', // multi requirements
                'requirements.*' => 'exists:requirements,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $grant = Grant::findOrFail($id);

            //store to table 'grants'
            $grant->update([
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

                // replace old file if new file is inputed
                $grant->documents()->delete();

                $grant->documents()->create([
                    'file_path'  => $path,
                    'file_name'  => $file->getClientOriginalName(), //gets the file name (e.g. docs.jpg)
                ]);
            }

            // Attach requirements (if any selected)
            if ($request->has('requirements')) {
                $grant->requirements()->sync($request->requirements); //syncs to the pivot table 'grant_requirements'
            }

            return redirect()->back()->with('success', 'Grant Updated!');
        }catch(\Exception $error){
            Log::error('Grant Update Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while updating grant.');
        }
    }
    
    //delete grant
    public function deleteGrant($id){
        try{
            $grant = Grant::with('documents')->findOrFail($id);

            // delete related documents (storage files + DB rows)
            foreach ($grant->documents as $document) {
                if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                    Storage::disk('public')->delete($document->file_path);
                }
                $document->delete();
            }
            $grant->delete();

            return redirect()->route('grantsNequipment')->with('success', 'Grant Deleted!');
        }catch(\Exception $error){
            Log::error('Grant Deletion Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while deleting grant.');
        }
    }
}
