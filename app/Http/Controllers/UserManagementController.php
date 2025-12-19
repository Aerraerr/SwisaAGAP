<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\QuickReply;
use App\Models\Role;

class UserManagementController extends Controller
{
    /**
     * Display the settings page with all users (except the logged-in one).
     */
    public function index()
    {
        // Fetch all users except the logged-in one
        $users = User::where('id', '!=', auth()->id())
            ->get()
            ->sortBy([
                ['role_id', 'asc'],     // Group by role (Members → Support Staff → Admin)
                ['last_name', 'asc'],   // Sort alphabetically by last name
                ['first_name', 'asc'],  // Sort alphabetically by first name
            ]);

        $roles = Role::all();
        $quickReplies = QuickReply::with('role')->get();

        return view('swisa-admin.settings', compact('users', 'roles', 'quickReplies'));
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
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }
}
