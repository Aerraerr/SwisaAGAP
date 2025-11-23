<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Models\QuickReply;
use App\Models\User;
use App\Events\MessageSent;

class MobileChatController extends Controller
{
    // GET CHAT FOR MEMBER (no creation)
    public function getChat()
    {
        try {
            $memberId = auth()->id();
            if (!$memberId) {
                return response()->json(['error' => 'Unauthorized user'], 401);
            }

            // Fetch fixed admin by role_id = 3
            $admin = User::where('role_id', 3)->first();
            if (!$admin) {
                return response()->json(['error' => 'No admin user available'], 500);
            }

            // Retrieve existing chat ONLY, no creation
            $chat = Chat::where('user_id', $memberId)
                        ->where('admin_id', $admin->id)
                        ->first();

            if (!$chat) {
                return response()->json([
                    'success' => false,
                    'message' => 'No chat found for this user and admin.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'chat_id' => $chat->id,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // FETCH CHAT HISTORY
    public function getChatHistory($chatId)
    {
        try {
            // Eager load user relation with correct columns matching your users table schema
            $messages = Message::with('user:id,first_name,middle_name,last_name,suffix,role_id')
                ->where('chat_id', $chatId)
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json($messages);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // SEND MESSAGE
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'chat_id' => 'required|integer',
            'message' => 'required|string',
            'user_id' => 'nullable|integer',
        ]);

        try {
            $senderId = $validated['user_id'] ?? auth()->id();

            $message = Message::create([
                'chat_id' => $validated['chat_id'],
                'user_id' => $senderId,
                'message' => $validated['message'],
                'is_read' => 0,
            ]);

            $message->load('user');
            broadcast(new MessageSent($message))->toOthers();

            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // MARK MESSAGES AS READ
    public function markAsRead(Request $request)
    {
        try {
            $chatId = $request->input('chat_id');
            $chat = Chat::findOrFail($chatId);
            $userId = auth()->id();

            $chat->messages()
                ->where('user_id', '!=', $userId)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // GET QUICK REPLIES
    public function getQuickReplies($roleId)
    {
        try {
            $quickReplies = QuickReply::where('for_role_id', $roleId)
                ->select('id', 'question', 'answer', 'for_role_id')
                ->get();

            return response()->json($quickReplies);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
