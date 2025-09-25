<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    //show member with documents (if any)
    public function showAnnouncements(){
        return Announcement::with('role', 'documents')->get();
    }

    //pass the 'members' variable to the members page for data display
    public function dispalyAnnouncement(){
        $announcements = $this->showAnnouncements();

        return view('swisa-admin.announcements', compact('announcements'));
    }

    //function to add an announcement
    public function addAnnouncement(Request $request){
        // validate the form data/input
        $request->validate([
            'announcement_title' => 'required|string|max:255',
            'announcement_content' => 'required|string',
            'announcement_files' => 'nullable|image|mimes:jpeg,png,jpg,pdf,docx|max:10485760',
            'announcement_start' => 'required|date',
            'announcement_end' => 'nullable|date|after_or_equal:announcement_start',
        ]);

        
        //store to table 'grants'
        $announcement = Announcement::create([
            'role_id' => Auth::user()->role_id,
            'title' => $request->announcement_title,
            'message' => $request->announcement_content,
            'posted_at' => $request->announcement_start,
        ]);

        //handle the file upload
        if ($request->hasFile('announcement_files')) {
            $file = $request->file('announcement_files');
            $path = $file->store('announcements', 'public'); // saves in storage/app/public/announcements

            $announcement->update([
                'image'  => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Announcement Added!');
    }

    //function to add an announcement
    public function editAnnouncementInfo(Request $request, $id){
        // validate the form data/input
        $request->validate([
            'announcement_title' => 'required|string|max:255',
            'announcement_content' => 'required|string',
            'announcement_files' => 'nullable|image|mimes:jpeg,png,jpg,pdf,docx|max:10485760',
            'announcement_start' => 'required|date',
            'announcement_end' => 'nullable|date|after_or_equal:announcement_start',
        ]);

        $announcement = Announcement::findOrFail($id);
        
        //store to table 'grants'
        $announcement->update([
            'role_id' => Auth::user()->role_id,
            'title' => $request->announcement_title,
            'message' => $request->announcement_content,
            'posted_at' => $request->announcement_start,
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
    }

    //delete Announcement
    public function deleteAnnouncement($id){
        $announcement = Announcement::findOrFail($id);

        $announcement->delete();

        return redirect()->route('announcements')->with('success', 'Announcement Deleted!');
    }
}
