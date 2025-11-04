<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Notification;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AnnouncementController extends Controller
{
    //show member with documents (if any)
    public function showAnnouncements(){
        return Announcement::with('role', 'documents', 'status')->get();
    }

    //pass the 'members' variable to the members page for data display
    public function dispalyAnnouncement(){
        $announcements = $this->showAnnouncements();
        $statuses = Status::whereIn('status_name', ['draft', 'published', 'archived'])->get();

        return view('swisa-admin.announcements', compact('announcements', 'statuses'));
    }

    //function to add an announcement
    public function addAnnouncement(Request $request){
        try{
            // validate the form data/input
            $request->validate([
                'announcement_title' => 'required|string|max:255',
                'announcement_content' => 'required|string',
                'announcement_files' => 'nullable|image|mimes:jpeg,png,jpg,pdf,docx|max:10485760',
                'announcement_start' => 'required|date',
                'announcement_end' => 'nullable|date|after_or_equal:announcement_start',
                'announcement_status' => 'required|exists:statuses,id',
            ]);

            
            //store to table 'announcements'
            $announcement = Announcement::create([
                'role_id' => Auth::user()->role_id,
                'status_id' => $request->announcement_status,
                'title' => $request->announcement_title,
                'message' => $request->announcement_content,
                'posted_at' => $request->announcement_start,
                'end_at' => $request->announcement_end,
            ]);

            //handle the file upload
            if ($request->hasFile('announcement_files')) {
                $file = $request->file('announcement_files');
                $path = $file->store('announcements', 'public'); // saves in storage/app/public/announcements

                $announcement->update([
                    'image'  => $path,
                ]);
            }

            //store a confirmation message to table
            Notification::create([ 
                'user_id' => Auth::id(),
                'message' => 'Announcement ' .$request->announcement_title . ', have been posted!' ,
                'sent_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Announcement Added!');
        }catch(\Exception $error){
            Log::error('Announcement Creation Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while creating announcement.');
        }
    }

    //function to add an announcement
    public function editAnnouncementInfo(Request $request, $id){
        try{
            // validate the form data/input
            $request->validate([
                'announcement_title' => 'required|string|max:255',
                'announcement_content' => 'required|string',
                'announcement_files' => 'nullable|image|mimes:jpeg,png,jpg,pdf,docx|max:10485760',
                'announcement_audience' => 'equired',
                'announcement_start' => 'required|date',
                'announcement_end' => 'nullable|date|after_or_equal:announcement_start',
            ]);

            $announcement = Announcement::findOrFail($id);
            
            //store to table 'grants'
            $announcement->update([
                'role_id' => Auth::user()->role_id,
                'title' => $request->announcement_title,
                'audience' => $request->announcement_audience,
                'message' => $request->announcement_content,
                'posted_at' => $request->announcement_start,
                'end_at' => $request->announcement_end,
            ]);

            //handle the file upload
            if ($request->hasFile('announcement_files')) {
                $file = $request->file('announcement_files');
                $path = $file->store('announcements', 'public'); // saves in storage/app/public/announcements

                // replace old file if new file is inputed
                $announcement->documents()->delete();

                $announcement->update([
                    'image'  => $path,
                ]);
            }

            return redirect()->back()->with('success', 'Announcement Updated!');
        }catch(\Exception $error){
            Log::error('Announcement Update Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while updating announcement.');
        }
    }

    //delete Announcement
    public function deleteAnnouncement($id){
        try{
            $announcement = Announcement::findOrFail($id);

            $announcement->delete();

            return redirect()->route('announcements')->with('success', 'Announcement Deleted!');
        }catch(\Exception $error){
            Log::error('Announcement Deletion Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while deleting announcement.');
        }
    }
}
