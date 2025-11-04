<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Sector;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrainingController extends Controller
{
    //show member with documents (if any)
    public function showTrainings(){
        return Training::with('documents', 'sector')->get();
    }

    public function showSectors(){
        return Sector::all();
    }

    //pass the 'members' variable to the members page for data display
    public function displayTraining(){
        $trainings = $this->showTrainings();
        $sectors = $this->showSectors();
        $upcomingEvents = Training::whereDate('date', '>=', now())->count();
        $completedEvents = Training::whereDate('date', '<', now())->count();

        return view('swisa-admin.training-workshop', compact('trainings', 'sectors', 'upcomingEvents', 'completedEvents'));
    }

    //add event function
    public function addTraining(Request $request){
        try{
            // validate the form data/input
            $request->validate([
                'event_name' => 'required|string|max:255',
                'sector' => 'required|exists:sectors,id',
                'description' => 'nullable|string',
                'venue' => 'required|string|max:255',
                'date' => 'required|date',
                'time' => 'required|date_format:H:i',
                'event_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5760',
            ]);

            //store to table 'training'
            $event = Training::create([
                'title' => $request->event_name,
                'sector_id' => $request->sector,
                'description'   => $request->description,
                'venue' => $request->venue,
                'date' => $request->date,
                'time' => $request->time,
            ]);

            //handle the file upload
            if ($request->hasFile('event_image')) {
                $file = $request->file('event_image');
                $path = $file->store('events', 'public'); // saves in storage/app/public/events

                $event->documents()->create([
                    'file_path'  => $path,
                    'file_name'  => $file->getClientOriginalName(), //gets the file name (e.g. docs.jpg)
                ]);
            }

            return redirect()->back()->with('success', 'Initiative/Event Added!');
        }catch(\Exception $error){
            Log::error('Event Creation Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while creating initiative/event.');
        }
    }

    //function to show specific data viewed in training
    public function viewTrainingDetails($id){
        $training = Training::with(['sector', 'documents', 'participants'])->findOrFail($id);

        $sectors = Sector::all();      
        $participants = Participant::all();

        return view('swisa-admin.view-training', compact('training', 'sectors', 'participants'));
    }

    //function to edit info of the grant
    public function editTrainingInfo(Request $request, $id){
        
        try{
            // validate the form data/input
            $request->validate([
                'event_name' => 'required|string|max:255',
                'sector' => 'required|exists:sectors,id',
                'description' => 'nullable|string',
                'venue' => 'required|string|max:255',
                'date' => 'required|date',
                'time' => 'required|date_format:H:i',
            ]);

            $training = Training::findOrFail($id);

            //store to table 'grants'
            $training->update([
                'title' => $request->event_name,
                'sector_id' => $request->sector,
                'description'   => $request->description,
                'venue' => $request->venue,
                'date' => $request->date,
                'time' => $request->time,
            ]);

            //handle the file upload
            if ($request->hasFile('event_image')) {
                $file = $request->file('event_image');
                $path = $file->store('events', 'public'); // saves in storage/app/public/grants

                // replace old file if new file is inputed
                $training->documents()->delete();

                $training->documents()->create([
                    'file_path'  => $path,
                    'file_name'  => $file->getClientOriginalName(), //gets the file name (e.g. docs.jpg)
                ]);
            }

            // Attach requirements (if any selected)
            if ($request->has('requirements')) {
                $training->requirements()->sync($request->requirements); //syncs to the pivot table 'grant_requirements'
            }

            return redirect()->back()->with('success', 'Training Updated!');
        }catch(\Exception $error){
            Log::error('Event Update Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while updating initiative/event.');
        }
    }

     //delete Training
    public function deleteTraining($id){
        try{
            $training = Training::findOrFail($id);

            $training->delete();

            return redirect()->route('training-workshop')->with('success', 'Training Deleted!');
        }catch(\Exception $error){
            Log::error('Event Deletion Error: ' . $error->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while deleting initiative/event.');
        }
    }
}
