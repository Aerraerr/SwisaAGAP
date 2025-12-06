<!-- Add this in your <head> if not already -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="lg:col-span-2 bg-white p-7 rounded-xl shadow">
    <p class="font-semibold primary-color dashheader flex items-center">
        <span class="material-icons mr-2 text-custom">link</span>
        Shortcuts / Quick Links
    </p>
    <ul class="text-sm mt-2 space-y-1">
        @if(Auth()->user()->role_id == 2)
            <li><a href="{{ route('assisted-creation')}}" class="text-custom">Add Member</a></li>
        @elseif(Auth()->user()->role_id == 3)
            <li><a href="{{ route('settings')}}" class="text-custom">Add Member</a></li>
        @endif
        <li><a href="{{ route('announcements')}}" class="text-custom">Post Announcement</a></li>
        <li><a href="{{ route('training-workshop')}}" class="text-custom">View Training</a></li>
    </ul>
</div>
