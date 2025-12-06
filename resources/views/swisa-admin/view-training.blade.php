

@extends('layouts.app')

@section('content')
<style>
    .custom-scroll::-webkit-scrollbar {
        width: 4px;
        height: 2px; 
    }

    .custom-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background-color: #2C6E49; 
    }

    .custom-scroll::-webkit-scrollbar-thumb:hover {
        background-color: #94a3b8;
    }
</style>
@include('layouts.loading-overlay')
<div class="p-2">
        <div class="bg-mainbg px-2 space-y-2">
        <div class="grid grid-cols-12 gap-2 py-2 "  x-data="{ activeTab: 'initiative' }">
            <!-- Initiative tab -->
            <div class="col-span-12">
                    @include('components.breadcrumbs', [
                'params' =>[$training]
            ])
                <div class="bg-white shadow-lg p-4 h-auto rounded-md">
                    <div class="lg:flex h-full">
                        <div class="mt-3 bg-gray-200 rounded-md h-44 w-full  lg:h-[260px] lg:w-1/3 flex items-center justify-center border-b border-gray-300 flex-shrink-0">
                            <img 
                                src= "{{ $training->documents->first() ? asset('storage/' . $training->documents->first()->file_path) : asset('image/placeholder.png') }} "
                                alt="Training Image" 
                                class="object-cover w-full h-full"
                            >
                        </div>
                        <div class="lg:ml-4 sm:flex-1 p-2">
                            <div>
                                <p class="text-lg md:text-2xl font-semibold text-customIT">{{ $training->title}}</p>
                                <p class="text-md lg:text-sm text-gray-500 mb-2">{{ $training->sector->sector_name}}</p>
                            </div>
                            <div class="mb-4 mt-10">
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">Status: </p>
                                    <span class="font-medium justify-end text-gray-800">{{$training->date < now() ? 'Completed' : 'Upcoming'}}</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600  mb-1">Date: </p>
                                     <span class="font-medium text-gray-800">{{ $training->date->format('F d Y') }}</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">Time: </p>
                                    <span class="font-medium text-gray-800">{{ \Carbon\Carbon::createFromFormat('H:i:s', $training->time)->format('g:i A') }}</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">Venue: </p>
                                    <span class="font-medium text-gray-800">{{ $training->venue}}</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">Participants: </p>
                                    <span class="font-medium text-gray-800">{{ $training->participants->count()}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col text-sm font-medium m-14 gap-2">
                            {{--<button onclick="openModal('programQrModal')" 
                                class="min-w-[220px] px-5 py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">
                                QR Code
                            </button>--}}
                            
                            <button onclick="openModal('editTrainingModal')" 
                                class="min-w-[220px] px-5 py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">
                                Edit Info
                            </button>
                            
                            {{--<button onclick="openModal('geneReportModal')" 
                                class="min-w-[220px] px-5 py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">
                                Generate Report
                            </button>--}}
                            
                            <button onclick="openModal('endProgramModal')" 
                                class="min-w-[220px]  py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">
                                End Program
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BASE tab -->
<div x-show="activeTab === 'initiative'" class="col-start-1 col-span-12 xl:col-span-8 xl:col-start-1 bg-white shadow-lg p-5 rounded-md overflow-auto">
    <div class="text-customIT flex justify-between gap-2 pb-2">
        <h1 class="text-lg xl:text-2xl font-bold text-start pl-1">Program Attendees</h1>
    </div>
    <div class="overflow-auto h-[60vh] custom-scroll">
        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-lg">
            <thead class="bg-btncolor text-white rounded-t-lg">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Sector</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Attended At</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($training->participants as $user)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-3 text-sm font-medium text-gray-700">{{ $user->formatted_id }}</td>
                    <td class="px-6 py-3 text-sm text-gray-700">{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td class="px-6 py-3 text-sm text-gray-700">{{ $user->user_info->sector->sector_name ?? 'New Member' }}</td>
                    <td class="px-6 py-3 text-sm font-medium">
                        @if($user->pivot->check_in_at)
                            <span class="text-green-600 font-semibold">{{ \Carbon\Carbon::parse($user->pivot->check_in_at)->format('F d, Y') }}</span>
                        @elseif($isFinished)
                            <span class="text-red-500 font-semibold">Did Not Attend</span>
                        @else
                            <span class="text-gray-400">Not Yet Attended</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 text-sm">
                        <div class="relative" x-data="{ show: false }" @click.away="show = false">
                            <button @click="show = !show" class="border border-gray-300 rounded-sm pl-2">
                                <img src="{{ asset('images/dot-menu.svg') }}" class="w-5 h-5 rounded-sm mr-2"/>
                            </button>
                            <div x-show="show" 
                                class="absolute top-full right-0 z-10 w-56 bg-white rounded-lg shadow-xl p-4 border border-gray-200 origin-top-right">
                                <h3 class="text-md font-bold text-customIT mb-2">
                                    Choose an Action
                                </h3>
                                <div class="border-t border-gray-200 py-2">
                                    <ul class="space-y-2">
                                        <li>
                                            <a href="{{ route('view-profile', $training->id) }}"  class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Profile</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('grant-request') }}" class="block cursor-pointer px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View All Joined Trainings</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-400">No participants found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @include('components.pagination')
</div>

<div x-show="activeTab === 'initiative'" class="col-span-12 xl:col-start-9 xl:col-span-4 space-y-2">
    <!-- Description Card -->
    <div class="flex flex-col bg-white shadow-lg p-4 rounded-md overflow-auto">
        <h2 class="text-lg xl:text-2xl text-customIT font-semibold pl-3 pt-1">Description</h2>
        <p class="text-left text-sm text-bsctxt p-3 text-justify">
            {!! nl2br(e($training->description ?? 'No description added to this initiative.')) !!}
        </p>

    </div>

    <!-- Training Date Card -->
    <div class="bg-white shadow-lg p-4 h-auto rounded-md overflow-auto">
        <p class="text-lg xl:text-xl text-upcoming font-semibold text-center">
            {{ $training->date->format('d F, Y') }}
        </p>

        <!-- Training Status Text -->
        <div class="mt-3 text-center">
            <p class="text-sm text-gray-600">
                @if($training->date->isTomorrow())
                    This training is scheduled for <strong>Tomorrow</strong>.
                @elseif($training->date->isToday())
                    This training is happening <strong>Today</strong>!
                @else
                    This training is scheduled for <strong>{{ $training->date->diffForHumans() }}</strong>.
                @endif
            </p>

            <div class="my-3 w-full flex justify-center">
                <div class="w-2/3 border-t border-gray-300"></div>
            </div>

            <p class="text-3xl font-bold">
                @if($training->date->isFuture())
                    <span class="text-upcoming">UPCOMING</span>
                @elseif($training->date->isToday())
                    <span class="text-green-600">ONGOING</span>
                @elseif($training->date->isPast())
                    <span class="text-red-600">ENDED</span>
                @endif
            </p>

            <div class="my-3 w-full flex justify-center">
                <div class="w-2/3 border-t border-gray-300"></div>
            </div>
        </div>

        <div class="px-10 py-3">
            <button @click="activeTab = 'participants'; showLoadingOverlayBtn()"  
                class="w-full px-4 py-2 bg-btncolor text-white rounded-md hover:bg-opacity-80">
                View Participants 
            </button>
        </div>
    </div>
</div>

            <!-- OFFICIAL ATTENDEES-->
             <div x-show="activeTab === 'participants'" class="col-start-1 col-span-12 xl:col-span-8 xl:col-start-1 bg-white shadow-lg p-4 rounded-md overflow-auto">
                <div class="text-customIT flex justify-between gap-2 pb-2">
                    <h1 class="text-lg xl:text-2xl font-bold mr-40">Program Attendees</h1>
                </div>
                <div class="overflow-auto h-[60vh]">
    <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-lg">
        <thead class="bg-btncolor text-white rounded-t-lg">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Sector</th>
                <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider">Present</th>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Attend At</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @forelse($training->participants as $user)
            <tr class="hover:bg-gray-50 transition-colors duration-200">
                <td class="px-6 py-3 text-sm font-medium text-gray-700">{{ $user->formatted_id }}</td>
                <td class="px-6 py-3 text-sm text-gray-700">{{ $user->first_name }} {{ $user->last_name }}</td>
                <td class="px-6 py-3 text-sm text-gray-700">{{ $user->user_info->sector->sector_name ?? 'New Member' }}</td>
                <td class="px-6 py-3 text-center">
                    <input disabled type="checkbox" class="h-4 w-4 rounded border-gray-300 text-btncolor focus:ring-btncolor"
                        @if($user->pivot->qr_scanned == 1 && $user->pivot->check_in_at) checked @endif>
                </td>
                <td class="px-6 py-3 text-sm font-medium">
                    @if($user->pivot->check_in_at)
                        <span class="text-green-600 font-semibold">
                            {{ \Carbon\Carbon::parse($user->pivot->check_in_at)->format('F d, Y g:i A') }}
                        </span>

                    @elseif($isFinished)
                        <span class="text-red-500 font-semibold">Did Not Attend</span>
                    @else
                        <span class="text-gray-400">Not Yet Attended</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-400">No participants found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

                @include('components.pagination')
            </div>

<div x-show="activeTab === 'participants'" class="col-span-12 xl:col-start-9 xl:col-span-4 space-y-4">

    <!-- Scanner Mode Info -->
    <div class="flex flex-col bg-white shadow-lg px-4 text-center items-center py-6 rounded-md overflow-auto">

        <h2 class="text-lg xl:text-2xl text-customIT font-semibold mb-4">Scanner Mode</h2>

        <p class="text-bsctxt text-md mb-6">
            Enable the Scanner mode to manage attendance
        </p>

        <!-- Start Scanner Button -->
        <button 
            onclick="openQrScanner()" 
            @disabled(!$training->date->isToday())
            class="text-md px-6 py-2 font-medium border rounded-md
                {{ !$training->date->isToday() 
                    ? 'border-gray-300 text-gray-300 cursor-not-allowed' 
                    : 'border-btncolor text-btncolor hover:bg-btncolor hover:text-white'
                }}">
            Start Scanner
        </button>
        <!-- Status Label -->
        <p class="text-sm font-semibold">
            @if($training->date->isFuture())
                <span class="text-gray-600">You can only access the scanner on the scheduled date</span>
            @elseif($training->date->isToday())
                <span class="text-green-600"></span>
            @elseif($training->date->isPast())
                <span class="text-gray-600">You can only access the scanner on the scheduled date</span>
            @endif
        </p>


        <!-- Divider -->
        <div class="my-4 w-full flex justify-center">
            <div class="w-3/4 border-t border-gray-300"></div>
        </div>

        <!-- Status Label -->
        <p class="text-3xl font-semibold">
            @if($training->date->isFuture())
                <span class="text-upcoming">UPCOMING</span>
            @elseif($training->date->isToday())
                <span class="text-green-600">ONGOING</span>
            @elseif($training->date->isPast())
                <span class="text-red-600">ENDED</span>
            @endif
        </p>

        <!-- Divider -->
        <div class="my-4 w-full flex justify-center">
            <div class="w-3/4 border-t border-gray-300"></div>
        </div>

    </div>


   

<!-- Back to Initiative & Add Points -->
<div class="bg-white shadow-lg p-4 h-auto rounded-md overflow-auto space-y-3">
    <div class="px-4">
        <button @click="/* add points function here */" 
            class="w-full px-4 py-3 bg-btncolor text-white rounded-md hover:bg-green-700 transition">
            ADD POINTS
        </button>
    </div>
    <div class="px-4">
        <button @click="activeTab = 'initiative'" 
            class="w-full px-4 py-3 bg-white border-btncolor text-bold text-btncolor rounded-md hover:bg-opacity-80 transition">
            Back to Initiative
        </button>
    </div>
</div>


</div>


        </div>
        @include('components.modals.edit-training')
        @include('components.modals.end-program')
        @include('components.modals.program-qr')
        @include('components.modals.generate-report')
    </div>
</div>
<input type="hidden" id="trainingId" value="{{ $training->id }}">

<!-- Scanner Modal -->
<div id="qrScannerModal" 
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] opacity-0 pointer-events-none transition-opacity duration-200">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-[700px] max-w-full relative z-[10000]">
        <!-- Header -->
        <h2 class="text-xl font-bold text-center text-customIT mb-6">
            Scan User QR Code
        </h2>
        
        <!-- Camera Preview -->
        <div class="relative w-full h-[500px] bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center border">
            <div id="qr-reader" style="width:100%; height:100%;"></div>
        </div>

        <!-- Scan Result -->
        <div id="qr-result" class="mt-4 text-center text-lg font-semibold text-gray-700">
            Waiting for scan...

        </div>
                <!-- Insert Member Text
        <p class="mt-2 text-center text-gray-600 font-medium tex-sm">OR</p>
 
        <div class="mt-4 text-center text-lg font-semibold text-gray-700">
            Insert Member
            <div class="mt-2 flex items-center justify-center">
                <div class="flex w-72">
                    <input 
                        type="text" 
                        id="memberInput"
                        value="MEM-0000"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg shadow-sm 
                            focus:outline-none focus:ring-2 focus:ring-customIT focus:border-customIT
                            text-gray-700"
                    >
                    <button 
                        class="px-4 py-2 bg-customIT text-white font-semibold rounded-r-lg hover:bg-green-700"
                    >
                        Enter
                    </button>
                </div>
            </div>
        </div>
        -->





        <!-- Close Button -->
        <div class="mt-3">
            <button onclick="closeQrScanner()" 
                class="w-full py-3 text-white font-semibold bg-red-500 rounded-lg hover:bg-red-600 transition duration-200">
                Close Scanner
            </button>
        </div>
    </div>
</div>

<!-- SUCCESS MODAL -->
<div id="scanSuccessModal" 
     class="hidden fixed inset-0 flex justify-center items-start bg-black bg-opacity-50 z-[11000]">
    <div class="bg-white p-6 mt-10 rounded-lg shadow-2xl text-center w-[300px] relative">
        <h2 class="text-lg font-semibold text-green-600 mb-4">Successfully Scanned!</h2>
        <h4 class="text-lg font-semibold text-gray-600 mb-4">NAME: </h4>
        <h4 class="text-lg font-semibold text-gray-600 mb-4">MEMBER ID: </h4>
        <div id="scanLinkOutput" class="mb-4 text-gray-800"></div>
        <button onclick="closeSuccessModal()" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
            OK
        </button>
    </div>
</div>







<div id="loadingOverlayBtn" class="fixed inset-0 bg-white bg-opacity-100 z-[9999] flex items-center justify-center hidden">
    <div class="flex flex-col items-center">
        <svg class="animate-spin h-10 w-10 text-[#2C6E49]" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
        <p class="mt-3 text-[#2C6E49] font-semibold text-lg">Loading...</p>
    </div>
</div>


<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script>
    function showLoadingOverlayBtn() {
        document.getElementById("loadingOverlayBtn").classList.remove("hidden");

        // Auto hide after 1s (optional)
        setTimeout(() => {
            hideLoadingOverlayBtn();
        }, 1000);
    }

    function hideLoadingOverlayBtn() {
        document.getElementById("loadingOverlayBtn").classList.add("hidden");
    }
</script>

<script>
let html5QrCode; 

// MAIN SCAN HANDLER
async function onScanSuccess(decodedText) {
    console.log("QR Scanned:", decodedText);

    const successModal = document.getElementById("scanSuccessModal");
    const linkOutput = document.getElementById("scanLinkOutput");

    try {
        const trainingId = document.getElementById('trainingId')?.value ?? '';

        const response = await fetch(`/scan-qr-user/${decodedText}?training_id=${trainingId}`);
        const data = await response.json();

        // SUCCESSFUL USER MATCH
        if (data.success) {
            // SHOW USER NAME & ID
            successModal.querySelector("h4:nth-of-type(1)").textContent =
                `NAME: ${data.name ?? '-'}`;
                successModal.querySelector("h4:nth-of-type(2)").textContent =
                    `MEMBER ID: ${data.member_id ?? '-'}`;


            // HANDLE DOUBLE SCAN
            if (data.already_scanned) {
                linkOutput.textContent = "⚠️ Already checked in.";
            } else {
                linkOutput.textContent = "✅ Attendance recorded successfully!";
            }

        } else {
            // USER NOT FOUND OR NOT REGISTERED
            successModal.querySelector("h4:nth-of-type(1)").textContent = "NAME: -";
            successModal.querySelector("h4:nth-of-type(2)").textContent =
                `MEMBER ID: ${data.member_id ?? '-'}`;

            linkOutput.textContent = data.message ?? "❌ QR not recognized.";
        }

        // SHOW MODAL
        successModal.classList.remove("hidden");

        // AUTO-HIDE
        setTimeout(() => successModal.classList.add("hidden"), 2000);

    } catch (err) {
        console.error("Error fetching user info:", err);

        // SHOW ERROR MESSAGE
        successModal.querySelector("h4:nth-of-type(1)").textContent = "NAME: -";
        successModal.querySelector("h4:nth-of-type(2)").textContent = "MEMBER ID: -";
        linkOutput.textContent = "❌ Something went wrong while recording attendance.";

        successModal.classList.remove("hidden");
        setTimeout(() => successModal.classList.add("hidden"), 2000);
    }
}

// OPEN SCANNER MODAL
function openQrScanner() {
    const modal = document.getElementById("qrScannerModal");
    modal.classList.remove("opacity-0", "pointer-events-none");

    if (!html5QrCode) {
        html5QrCode = new Html5Qrcode("qr-reader");
    }

    Html5Qrcode.getCameras().then(cameras => {
        if (cameras && cameras.length) {
            html5QrCode.start(
                cameras[0].id,
                { fps: 10, qrbox: 350 },
                onScanSuccess
            ).catch(err => console.error("Camera start failed:", err));
        }
    }).catch(err => console.error("Camera permission denied:", err));
}

// CLOSE SCANNER
function closeQrScanner() {
    const modal = document.getElementById("qrScannerModal");
    modal.classList.add("opacity-0", "pointer-events-none");

    if (html5QrCode) {
        html5QrCode.stop()
            .then(() => html5QrCode.clear())
            .catch(err => console.error("Failed to stop scanner:", err));
    }
}

// CLOSE SUCCESS MODAL
function closeSuccessModal() {
    document.getElementById("scanSuccessModal").classList.add("hidden");
}

// OPTIONAL: SCAN FROM UPLOADED IMAGE
document.getElementById("qrUpload")?.addEventListener("change", e => {
    if (e.target.files.length === 0) return;

    const file = e.target.files[0];
    if (!html5QrCode) html5QrCode = new Html5Qrcode("qr-reader");

    html5QrCode.scanFile(file, true)
        .then(decodedText => onScanSuccess(decodedText))
        .catch(err => {
            document.getElementById("qr-result").innerText = "❌ Failed to scan image.";
            console.error("Image scan failed:", err);
        });
});
</script>


<script>
// INPUT MODE
const input = document.getElementById('memberInput');
const prefix = 'MEM-0000';

// Prevent backspacing/deleting the prefix
input.addEventListener('keydown', (e) => {
    // Allow navigation keys
    const allowedKeys = ['ArrowLeft','ArrowRight','ArrowUp','ArrowDown','Tab'];
    if (allowedKeys.includes(e.key)) return;

    // Prevent backspace or delete before the prefix
    if ((input.selectionStart <= prefix.length && e.key === 'Backspace') ||
        (input.selectionStart < prefix.length && e.key === 'Delete')) {
        e.preventDefault();
    }
});

// Ensure prefix stays intact
input.addEventListener('input', () => {
    if (!input.value.startsWith(prefix)) {
        input.value = prefix + input.value.slice(prefix.length);
    }
});
</script>


@endsection