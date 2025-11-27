<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\QuickReply;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $chats = Chat::with([
            'admin',
            'supportStaff',
            'messages' => function ($q) {
                $q->latest()->limit(1);
            }
        ])
        ->when($user->role_id == 2, function ($q) use ($user) {
            $q->where('support_staff_id', $user->id);
        })
        ->when($user->role_id == 3, function ($q) use ($user) {
            // Admin can see all
        })
        ->get()
        ->sortByDesc(function ($chat) {
            return optional($chat->messages->first())->created_at ?? now()->subYears(10);
        })
        ->values();

        $chat = $chats->first();
        $messages = $chat ? $chat->messages()->with('user')->oldest()->get() : collect();
        $quickReplies = QuickReply::all();

        return view('swisa-admin.messages', compact('chats', 'chat', 'messages', 'quickReplies'));
    }

    public function show($userId)
    {
        $currentUser = auth()->user();
        $otherUser = User::findOrFail($userId);

        // Find or create chat
        $chat = Chat::where(function ($q) use ($currentUser, $otherUser) {
                $q->where('admin_id', $currentUser->id)
                  ->where('support_staff_id', $otherUser->id);
            })
            ->orWhere(function ($q) use ($currentUser, $otherUser) {
                $q->where('admin_id', $otherUser->id)
                  ->where('support_staff_id', $currentUser->id);
            })
            ->first();

        if (!$chat) {
            $chat = Chat::create([
                'admin_id' => $currentUser->role_id == 3 ? $currentUser->id : $otherUser->id,
                'support_staff_id' => $currentUser->role_id == 2 ? $currentUser->id : $otherUser->id,
            ]);
        }

        // 🔹 Sort chats again by last message created_at
        $chats = Chat::with(['admin','supportStaff','messages' => function ($q) {
            $q->latest()->limit(1);
        }])
        ->get()
        ->sortByDesc(function ($chat) {
            return optional($chat->messages->first())->created_at ?? now()->subYears(10);
        })
        ->values();

        $messages = $chat->messages()->with('user')->oldest()->get();
        $quickReplies = QuickReply::all();

        return view('swisa-admin.messages', compact('chats', 'chat', 'messages', 'quickReplies'));
    }

    public function sendMessage(Request $request, $chatId)
    {
        $request->validate(['message' => 'required|string']);

        $message = Message::create([
            'chat_id' => $chatId,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'is_read' => false,
            'created_at' => now(),
        ]);

        $message->load('user');
        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'id' => $message->id,
            'chat_id' => $message->chat_id,
            'user_id' => $message->user_id,
            'message' => $message->message,
            'created_at' => $message->created_at->format('Y-m-d h:i A'),
            'user' => [
                'id' => $message->user->id,
                'name' => $message->user->name,
            ],
        ]);
    }

    public function poll(Request $request, $chatId)
    {
        $lastId = $request->query('last_id', 0);
        $chat = Chat::findOrFail($chatId);

        $messages = $chat->messages()
            ->with('user:id,name')
            ->where('id', '>', $lastId)
            ->orderBy('id', 'asc')
            ->get();

        $unreadCount = $chat->messages()
            ->where('id', '>', $lastId)
            ->where('user_id', '!=', auth()->id())
            ->count();

        return response()->json([
            'messages' => $messages,
            'unread' => $unreadCount,
        ]);
    }

    public function load($userId)
    {
        $currentUser = auth()->user();
        $otherUser = User::findOrFail($userId);

        $chat = Chat::where(function ($q) use ($currentUser, $otherUser) {
                $q->where('admin_id', $currentUser->id)
                ->where('support_staff_id', $otherUser->id);
            })
            ->orWhere(function ($q) use ($currentUser, $otherUser) {
                $q->where('admin_id', $otherUser->id)
                ->where('support_staff_id', $currentUser->id);
            })
            ->first();

        if (!$chat) {
            $chat = Chat::create([
                'admin_id' => $currentUser->role_id == 3 ? $currentUser->id : $otherUser->id,
                'support_staff_id' => $currentUser->role_id == 2 ? $currentUser->id : $otherUser->id,
            ]);
        }

        $messages = $chat->messages()->with('user')->oldest()->get();
        $quickReplies = QuickReply::all();
        $html = view('partials.chat-panel', compact('chat', 'messages', 'quickReplies'))->render();

        return response()->json([
            'html' => $html,
            'chat_id' => $chat->id,
            'last_message_id' => $messages->last()->id ?? 0,
        ]);
    }

    public function checkUnread()
    {
        $currentUserId = auth()->id();
        $users = User::all();
        $result = [];

        foreach ($users as $user) {
            $chat = Chat::where(function ($q) use ($currentUserId, $user) {
                    $q->where('admin_id', $currentUserId)
                      ->where('support_staff_id', $user->id);
                })
                ->orWhere(function ($q) use ($currentUserId, $user) {
                    $q->where('admin_id', $user->id)
                      ->where('support_staff_id', $currentUserId);
                })
                ->first();

            if (!$chat) {
                $result[$user->id] = false;
                continue;
            }

            $hasUnread = $chat->messages()
                ->where('user_id', '!=', $currentUserId)
                ->where('is_read', false)
                ->exists();

            $result[$user->id] = $hasUnread;
        }

        return response()->json($result);
    }

    public function markAsRead($chatId)
    {
        $chat = Chat::findOrFail($chatId);
        $userId = auth()->id();

        $chat->messages()
            ->where('user_id', '!=', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
