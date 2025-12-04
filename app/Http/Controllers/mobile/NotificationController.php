<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NotificationController extends Controller
{
    //Get the notifications for a specific user
    public function index(Request $request)
{
    $user = $request->user(); 
    if (!$user) {
        return response()->json([], 401);
    }

    $limit = $request->query('limit', 6);

    $notifications = Notification::where('user_id', $user->id)
          ->orderBy('sent_at', 'desc')
          ->paginate($limit);

    $notifications->getCollection()->transform(function ($notif) {
        return [
            'id' => $notif->id,
            'message' => $notif->message,
            'is_read' => $notif->is_read,
            'sent_at' => Carbon::parse($notif->sent_at)->diffForHumans(),
        ];
    });

    return response()->json($notifications);
}


    // Mark notification as read
    public function markAsRead($id)
    {
        $notif = Notification::find($id);
        if (!$notif) {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        $notif->is_read = true;
        $notif->save();

        return response()->json(['message' => 'Notification marked as read']);
    }

    // Check if the user has any unread notifications
public function hasUnread(Request $request)
{
    $userId = $request->user()->id;

    if (!$userId) {
        return response()->json(['error' => 'Missing user_id'], 400);
    }

    $hasUnread = Notification::where('user_id', $userId)
        ->where('is_read', false)
        ->exists();

    return response()->json(['has_unread' => $hasUnread]);
}

public function markAsUnread($id)
{
    $notification = Notification::findOrFail($id);
    $notification->is_read = false;
    $notification->save();

    return response()->json(['message' => 'Notification marked as unread']);
}

public function destroy($id)
{
    $notif = Notification::find($id);

    if (!$notif) {
        return response()->json(['error' => 'Notification not found'], 404);
    }

    $notif->delete();

    return response()->json(['message' => 'Notification deleted successfully']);
}


}