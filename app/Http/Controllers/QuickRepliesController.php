<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuickReply;
use App\Models\Role;


// ===========
// FOR SETTINGS
// ===========
class QuickRepliesController extends Controller
{
    // List all quick replies for the chat settings page
    public function index()
    {
        $quickReplies = QuickReply::with('role')->get();
        $roles = Role::all();

        return view('swisa-admin.chat-section', compact('quickReplies', 'roles'));
    }

    // Store a new quick reply
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'for_role_id' => 'nullable|exists:roles,id',
        ]);

        QuickReply::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'for_role_id' => $request->for_role_id,
        ]);

        return redirect()->back()->with('success', 'Quick reply added successfully!');
    }

    // Update an existing quick reply
    public function update(Request $request, QuickReply $quickReply)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'for_role_id' => 'nullable|exists:roles,id',
        ]);

        $quickReply->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'for_role_id' => $request->for_role_id,
        ]);

        return redirect()->back()->with('success', 'Quick reply updated successfully!');
    }

    // Delete a quick reply
    public function destroy(QuickReply $quickReply)
    {
        $quickReply->delete();

        return redirect()->back()->with('success', 'Quick reply deleted successfully!');
    }
}
