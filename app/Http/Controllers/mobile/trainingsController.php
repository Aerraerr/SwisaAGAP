<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class TrainingsController extends Controller
{
    
public function index(Request $request)
{
    $userId = $request->user()->id; // token from sanctum

    // Today in app timezone
    $today = Carbon::today(config('app.timezone'));

    // Get trainings that Have date today or in the future and user is NOT attending yet
    $trainings = Training::whereDate('date', '>=', $today)
        ->whereDoesntHave('participants', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->withCount('participants')
        ->with('sector', 'documents')
        ->paginate(10);

    // Transform each training for additional info
    $trainings->getCollection()->transform(function ($training) use ($today) {
        $eventDate = Carbon::parse($training->date)
        ->timezone(config('app.timezone'))
        ->startOfDay();

        //  Set image URL if there’s at least one related document
        $training->image_url = $training->documents->first()
            ? asset('storage/' . $training->documents->first()->file_path)
            : null;

        // Set status
        $training->status = $eventDate->isSameDay($today) ? 'Today' : 'Upcoming';

        return $training;
    });

    return response()->json([
        'success' => true,
        'data' => $trainings,
    ]);
}



    // To attend a training
public function attend(Request $request, $trainingId)
{
    
    //  Get the authenticated user
    $userId = $request->user()->id;

    //  Check if user already attending
    $exists = DB::table('participants')
        ->where('training_id', $trainingId)
        ->where('user_id', $userId)
        ->exists();

    if ($exists) {
        return response()->json(['message' => 'Already attending this training'], 400);
    }

    //  Fetch the training before attaching
    $training = Training::findOrFail($trainingId);

    //  Attach using Eloquent relationship (cleaner than raw DB insert)
    $training->participants()->attach($userId);

    //  Create notification entry
    DB::table('notifications')->insert([
        'user_id' => $userId,
        'message' => "You are now attending '{$training->title}' on {$training->date} at {$training->venue}.",
        'is_read' => false,
        'sent_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
    'success' => true,
    'message' => 'You are now attending this training',
    'data' => $training
    ]);

}



// Get all trainings the user attends
public function myEvents(Request $request)
{
    $userId = $request->user()->id;
    $filter = $request->query('filter'); // Ongoing, Did not attend, Attended, All

    $trainings = Training::whereHas('participants', function ($q) use ($userId) {
    $q->where('user_id', $userId);
})
->withCount('participants')
->with('sector', 'documents')
->get()
->map(function ($training) use ($userId) {
    $eventDate = Carbon::parse($training->date)->startOfDay();
    $today = Carbon::today();

    // Set status
    if ($eventDate->isBefore($today)) {
        $training->status = 'Did not attend';
    } elseif ($eventDate->isSameDay($today) || $eventDate->isAfter($today)) {
        $training->status = 'Ongoing';
    }

    // Set is_attending
    $training->is_attending = $training->participants()
        ->where('user_id', $userId)
        ->exists();

           // image_url if document exists
        $training->image_url = $training->documents->first()
            ? asset('storage/' . $training->documents->first()->file_path)
            : null;

    return $training;
});

    // Apply filter
    if ($filter && $filter !== 'All') {
        $trainings = $trainings->filter(function ($training) use ($filter) {
            return $training->status === $filter;
        })->values();
    }

    return response()->json($trainings);
}


public function show(Request $request, $trainingId)
{
    $userId = $request->user()->id;

    $training = Training::withCount('participants')
        ->with('sector', 'documents')
        ->findOrFail($trainingId);

    // Add is_attending flag if user_id is given
    $training->is_attending = false;
    if ($userId) {
        $training->is_attending = $training->participants()
            ->where('user_id', $userId)
            ->exists();
    }

        // Add image_url if document exists
    $training->image_url = $training->documents->first()
        ? asset('storage/' . $training->documents->first()->file_path)
        : null;

    return response()->json($training);
}

public function cancelAttendance(Request $request, $trainingId)
{
    $userId = $request->user()->id;
    $training = Training::find($trainingId);

    if (!$training) {
        return response()->json(['message' => 'Training not found'], 404);
    }

    if (!$training->participants()->where('user_id', $userId)->exists()) {
        return response()->json(['message' => 'Not attending this event'], 404);
    }

    $training->participants()->detach($userId);

    
    DB::table('notifications')->insert([
    'user_id' => $userId,
    'message' => "You have cancelled your attendance for '{$training->title}'.",
    'is_read' => false,
    'sent_at' => now(),
    'created_at' => now(),
    'updated_at' => now(),
    ]);

    return response()->json(['message' => 'Attendance cancelled successfully', 'training' => $training]);

}
    
}

