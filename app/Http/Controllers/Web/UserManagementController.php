<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\GrantType;
use App\Models\MembershipRequirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\QuickReply;
use App\Models\Requirement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Role;
use App\Models\Sector;

use function Symfony\Component\Clock\now;

class UserManagementController extends Controller
{
    /**
     * Display the settings page with all users (except the logged-in one).
     */
    public function index()
    {
        // Fetch all users except the logged-in one
        $users = User::where('id', '!=', auth::id())
            ->get()
            ->sortBy([
                ['role_id', 'asc'],     // Group by role (Members → Support Staff → Admin)
                ['last_name', 'asc'],   // Sort alphabetically by last name
                ['first_name', 'asc'],  // Sort alphabetically by first name
            ]);

        $roles = Role::all();
        $quickReplies = QuickReply::with('role')->get();
        $grantTypes = GrantType::get();
        $requirements = Requirement::get();
        $sectors = Sector::get();
        $membershipReqs = MembershipRequirement::with('requirement')->get();

        return view('swisa-admin.settings', compact('users', 'roles', 'quickReplies', 'grantTypes', 'requirements', 'sectors', 'membershipReqs'));
    }


    /**
     * Store a new user in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:users',
            'phone_number' => 'nullable|string|max:20|unique:users',
            'password'     => 'required|string|min:6',
            'role_id'      => 'required|integer',
        ]);

        User::create([
            'first_name'   => $validated['first_name'],
            'last_name'    => $validated['last_name'],
            'email'        => $validated['email'],
            'phone_number' => $validated['phone_number'] ?? null,
            'password'     => Hash::make($validated['password']),
            'role_id'      => $validated['role_id'],
        ]);

        return back()->with('success', 'User created successfully!');
    }

    /**
     * Delete a user from the system.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent the logged-in user from deleting their own account
        if ($user->id === auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }

    //function to add requiremnt
    public function addRequirement(Request $request){
        $request->validate([
            'req_name'   => 'required|string|max:255',
        ]);

        //store to requirement table
        Requirement::create([
            'requirement_name' => $request->req_name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Requirement added successfully!');
    }

    //function to add requiremnt
    public function addSector(Request $request){
        $request->validate([
            'sector'   => 'required|string|max:255',
        ]);

        //store to requirement table
        Sector::create([
            'sector_name' => $request->sector,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Sector added successfully!');
    }

    //function to add grant type
    public function addGrantType(Request $request){
        $request->validate([
            'grant_type'   => 'required|string|max:255',
        ]);

        //store to requirement table
        GrantType::create([
            'grant_type' => $request->grant_type,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Grant type added successfully!');
    }
    
    //function to add membership requiremnt
    public function addMembershipRequirement(Request $request){

        $request->validate([
            'requirement_id' => 'required|exists:requirements,id',
        ]);

        MembershipRequirement::create([
            'requirement_id' => $request->requirement_id,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Membership requirement added successfully!');
    }

    public function deleteGrantType($id){
        $grantType = GrantType::findOrFail($id);
        $grantType->delete();

        return redirect()->back()->with('success', 'Grant type ' .$grantType->grant_type. ' deleted successfully.');
    }

    public function deleteSector($id){
        $sector = Sector::findOrFail($id);
        $sector->delete();

        return redirect()->back()->with('success', 'Sector '.$sector->sector_name.' deleted successfully.');
    }

    public function deleteRequirement($id){
        try{
            $req = Requirement::findOrFail($id);
            $req->delete();

            return redirect()->back()->with('success', 'Requirement '. $req->requirement_name .' deleted successfully.');
        }catch(\Exception $error){
            Log::error('Requirement Deletion Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while deleting requirement.');
        }
    }

    public function deleteMembershipRequirement($id){
        try{
            $req = MembershipRequirement::findOrFail($id);
            $req->delete();

            return redirect()->back()->with('success', 'Requirement '. $req->requirement->requirement_name .' deleted successfully.');
        }catch(\Exception $error){
            Log::error('Membership Requirement Deletion Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while deleting membership requirement.');
        }
    }
}
