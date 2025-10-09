
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
<div class="p-4">
        <div class="bg-mainbg px-2 space-y-2">
        <div class="bg-mainbg px-2">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
                <div class="text-customIT flex flex-col">
                    <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Program Details</h2>
                    <p class="text-sm text-gray-600">
                        Organize, monitor, and showcase SWISA initiatives, programs, and community events.
                    </p>
                </div>
                @include('components.UserTab')
            </div>
        </div>
        <div class="grid grid-cols-12 gap-2 py-2 "  x-data="{ activeTab: 'initiative' }">
            <!-- Initiative tab -->
            <div x-show="activeTab === 'initiative'" class="col-span-12">
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
                            <button onclick="openModal('programQrModal')" 
                                class="min-w-[220px] px-5 py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">
                                QR Code
                            </button>
                            
                            <button onclick="openModal('editGrantModal')" 
                                class="min-w-[220px] px-5 py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">
                                Edit Info
                            </button>
                            
                            <button onclick="openModal('geneReportModal')" 
                                class="min-w-[220px] px-5 py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">
                                Generate Report
                            </button>
                            
                            <button onclick="openModal('endProgramModal')" 
                                class="min-w-[220px]  py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">
                                End Program
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div x-show="activeTab === 'initiative'" class="col-start-1 col-span-12 xl:col-span-8 xl:col-start-1 bg-white shadow-lg p-5 rounded-md overflow-auto">
                <div class="text-customIT flex justify-between gap-2 pb-2">
                    <h1 class="text-lg xl:text-2xl font-bold text-start pl-1 ">Program Attendees</h1>
                </div>
                <div class="overflow-auto h-[60vh] custom-scroll">
                    <table class="min-w-full border-spacing-y-1">
                    <thead class="sticky top-0 z-10  bg-snbg border-b border-gray-100">
                        <tr class="text-customIT text-left">
                            <th class="px-4 py-3 text-xs font-medium">NAME</th>
                            <th class="px-4 py-3 text-xs font-medium">ID NUMBER</th>
                            <th class="px-4 py-3 text-xs font-medium">MEMBER TYPE</th>
                            <th class="px-4 py-3 text-xs font-medium">STATUS</th>
                            <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 10; $i++)
                            <tr class="border border-gray-300 hover:bg-gray-100">
                                <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                                <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                                <td class="px-4 py-2 text-sm font-medium text-approved">
                                    <div class="bg-transparent rounded-md  inline-block">
                                        Active
                                    </div>
                                </td>
                                <td class="pl-4 py-3 text-sm">
                                    <div class="relative" x-data="{ show: false }" @click.away="show = false">
                                        <button @click="show = !show" class="border border-gray-300 rounded-sm pl-2">
                                            <img src="{{ asset('images/dot-menu.svg') }}" class="w-5 h-5 rounded-sm mr-2"/>
                                        </button>
                                        <!-- The Popover Menu, controlled by Alpine.js -->
                                        <div x-show="show" 
                                            class="absolute top-full right-0 z-100 w-56 bg-white rounded-lg shadow-xl p-4 border border-gray-200 origin-top-right">
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
                        @endfor
                    </tbody>

                    </table>
                </div>
                @include('components.pagination')
            </div>

            <div x-show="activeTab === 'initiative'" class="col-span-12 xl:col-start-9 xl:col-span-4">
                <div class="flex flex-col bg-white shadow-lg p-4 rounded-md overflow-auto">
                    <h2 class="text-lg xl:text-2xl text-customIT font-semibold pl-3 pt-1">Description</h2>
                    <p class="text-left text-sm text-bsctxt p-3 text-justify">
                        This comprehensive training program is designed to equip farmers with the latest knowledge and practical skills in crop management.
                        The curriculum covers key areas from advanced land preparation techniques to post-harvest technology. Participants will learn about 
                        integrated pest management (IPM) strategies to reduce chemical use, and effective methods for ensuring crop quality and minimizing 
                        post-harvest losses. The program combines theoretical knowledge with hands-on field sessions, allowing participants to apply what they learn in a real-world setting.
                    </p>
                </div>
                
                <div class="bg-white shadow-lg p-4 h-auto rounded-md mt-2 overflow-auto">
                    <p class="text-lg xl:text-xl text-upcoming font-semibold text-center">
                        {{ $training->date->format('d F, Y') }}
                    </p>

                    {{-- Check if training is tomorrow or another day --}}
                    <p class="text-center text-sm text-btncolor mt-1">
                        @if($training->date->isTomorrow())
                            This training is scheduled for <strong>Tomorrow</strong>.
                        @elseif($training->date->isToday())
                            This training is happening <strong>Today</strong>!
                        @else
                            This training is scheduled for <strong>{{ $training->date->diffForHumans() }}</strong>.
                        @endif
                    </p>

                    <div class="px-10 py-3">
                        <button @click="activeTab = 'participants'; showLoadingOverlayBtn()"  
                            class="w-full px-4 py-2 bg-btncolor text-white rounded-md hover:bg-opacity-80">
                            View Participants 
                        </button>
                    </div>

                </div>

            </div>


            <!-- participants tab start -->
            <div x-show="activeTab === 'participants'" class="col-span-12">
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
                                <p class="text-xs md:text-2xl font-semibold text-customIT">{{ $training->title}}</p>
                                <p class="text-[10px] lg:text-sm text-gray-500 mb-2">{{ $training->sector->sector_name}}</p>
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
                            <button onclick="openModal('geneReportModal')" 
                                class="min-w-[220px] px-5 py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">
                                Generate Report
                            </button>
                            <button disabled onclick="openModal('programQrModal')" 
                                class="min-w-[220px] px-5 py-2 rounded-lg border border-transparent text-transparent font-semibold 
                                    bg-white  transition-all duration-200 hover:bg-transparent " >
                                QR Code
                            </button>
                            
                            <button disabled onclick="openModal('editGrantModal')" 
                                class="min-w-[220px] px-5 py-2 rounded-lg border border-transparent text-transparent font-semibold 
                                    bg-white  transition-all duration-200 hover:bg-transparent ">
                                Edit Info
                            </button>
                            <button disabled onclick="openModal('endProgramModal')" 
                                class="min-w-[220px] px-5 py-2 rounded-lg border border-transparent text-transparent font-semibold 
                                    bg-white  transition-all duration-200 hover:bg-transparent ">
                                End Program
                            </button>
                        </div>
                    </div>
                </div>
            </div>
             <div x-show="activeTab === 'participants'" class="col-start-1 col-span-12 xl:col-span-8 xl:col-start-1 bg-white shadow-lg p-4 rounded-md overflow-auto">
                <div class="text-customIT flex justify-between gap-2 pb-2">
                    <h1 class="text-lg xl:text-2xl font-bold mr-40">Program Attendees</h1>
                </div>
                <div class="overflow-auto h-[60vh]">
                    <table class="min-w-full border-spacing-y-1">
                    <thead class="bg-snbg border border-gray-100">
                        <tr class="text-customIT text-left ">
                            <th class="px-4 py-3 text-xs font-medium">NAME</th>
                            <th class="px-4 py-3 text-xs font-medium">ID NUMBER</th>
                            <th class="px-4 py-3 text-xs font-medium">MEMBER TYPE</th>
                            <th class="px-4 py-3 text-xs font-medium">PRESENT</th>
                            <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 10; $i++)
                            <tr class="border border-gray-300 hover:bg-gray-100">
                                <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                                <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                                <td class="px-4 py-2 pl-6 gap-1">
                                    <input type="checkbox" class="peer h-5 w-5 appearance-none rounded-md border border-gray-300 bg-white transition-colors duration-200 checked:bg-btncolor focus:ring-btncolor checked:border-btncolor">
                                </td>
                                <td class="pl-4 py-3 text-sm">
                                    <div class="relative" x-data="{ show: false }" @click.away="show = false">
                                        <button @click="show = !show"  class=" rounded-sm pl-2">
                                            <img src="{{ asset('images/dot-menu.svg') }}"
                                            class="w-5 h-5 rounded-sm mr-2"/>
                                        </button>
                                        <!-- The Popover Menu, controlled by Alpine.js -->
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
                                                        <a onclick="openModal('endProgramModal')" class="block cursor-pointer px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    </table>
                </div>
                @include('components.pagination')
            </div>

            <div x-show="activeTab === 'participants'" class="col-span-12 xl:col-start-9 xl:col-span-4">
                <div class="flex flex-col bg-white shadow-lg px-4 text-center items-center py-6 rounded-md overflow-auto">
                    <h2 class="text-lg xl:text-2xl text-customIT font-semibold mb-6">QR CODE</h2>
                    <div class="flex justify-center bg-gray-200 mx-12 h-60 w-60">
                        <p class="text-sm text-bsctxt py-28">QR IMAGE</p>
                    </div>
                    <p class=" text-bsctxt text-md">INIT-EV112403232323</p>
                    <button onclick="openModal('programQrModal')" class="text-md mt-6 px-14 py-2 font-medium border border-btncolor text-btncolor rounded-md hover:bg-btncolor hover:text-white">
                        Expand QR Code
                    </button>
                </div>
                                <div class="bg-white shadow-lg pt-3 pb-3 pl-10 pr-10 h-auto rounded-md mt-2 overflow-auto">
                        <button  onclick="openQrScanner()" class="w-full px-4 py-2 bg-btncolor text-white rounded-md hover:bg-opacity-80">
                            Manage Attendance
                        </button>
                </div>     
                <div class="bg-white shadow-lg p-4 h-auto rounded-md mt-2 overflow-auto">
                    <p class="text-lg xl:text-xl text-upcoming font-semibold text-center">Back to Initiative</p>
                    <div class="px-10 py-3">
                        <button  @click="activeTab = 'initiative'" class="w-full px-4 py-2 bg-btncolor text-white rounded-md hover:bg-opacity-80">
                            Initiative
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
<!-- Scanner Modal -->
<div id="qrScannerModal" 
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-200">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-[700px] max-w-full">
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

        <!-- Upload Button -->
        <div class="mt-6">
            <input type="file" id="qrUpload" accept="image/*" 
                class="w-full py-3 border rounded-lg cursor-pointer text-center"/>
        </div>

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
<div id="scanSuccessModal" class="hidden fixed inset-0 flex justify-center items-start bg-black bg-opacity-50 z-50">
    <div class="bg-white p-6 mt-10 rounded-lg shadow-lg text-center w-[300px]">
        <h2 class="text-lg font-semibold text-green-600 mb-4">✅ Successfully Scanned!</h2>
        <div id="scanLinkOutput" class="mb-4 text-gray-800"></div>
        <button onclick="closeSuccessModal()" class="bg-green-600 text-white px-4 py-2 rounded-md">OK</button>
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

function onScanSuccess(decodedText, decodedResult) {
    console.log(`✅ Code scanned = ${decodedText}`, decodedResult);

    const successModal = document.getElementById("scanSuccessModal");
    const linkOutput = document.getElementById("scanLinkOutput");

    if (decodedText.startsWith("http")) {
        linkOutput.innerHTML = `Scanned: <a href="${decodedText}" target="_blank" class="text-blue-600 underline">${decodedText}</a>`;
    } else {
        linkOutput.textContent = `Scanned: ${decodedText}`;
    }

    successModal.classList.remove("hidden");

    // Auto-close modal after 2 seconds
    setTimeout(() => {
        successModal.classList.add("hidden");
    }, 2000);
}

function openQrScanner() {
    const modal = document.getElementById("qrScannerModal");
    modal.classList.remove("opacity-0", "pointer-events-none");

    if (!html5QrCode) {
        html5QrCode = new Html5Qrcode("qr-reader");
    }

    // Request camera permission & start scanner
    Html5Qrcode.getCameras().then(cameras => {
        if (cameras && cameras.length) {
            html5QrCode.start(
                cameras[0].id,   // use first camera
                { fps: 10, qrbox: 350 },
                onScanSuccess
            ).catch(err => console.error("Camera start failed:", err));
        }
    }).catch(err => console.error("Camera permission denied:", err));
}

function closeQrScanner() {
    const modal = document.getElementById("qrScannerModal");
    modal.classList.add("opacity-0", "pointer-events-none");

    if (html5QrCode) {
        html5QrCode.stop()
            .then(() => html5QrCode.clear())
            .catch(err => console.error("Failed to stop scanner:", err));
    }
}

function closeSuccessModal() {
    document.getElementById("scanSuccessModal").classList.add("hidden");
}

// Custom Upload File
document.getElementById("qrUpload").addEventListener("change", e => {
    if (e.target.files.length === 0) return;
    const file = e.target.files[0];
    if (!html5QrCode) html5QrCode = new Html5Qrcode("qr-reader");

    html5QrCode.scanFile(file, true)
        .then(decodedText => {
            const successModal = document.getElementById("scanSuccessModal");
            const linkOutput = document.getElementById("scanLinkOutput");

            if (decodedText.startsWith("http")) {
                linkOutput.innerHTML = `Scanned: <a href="${decodedText}" target="_blank" class="text-blue-600 underline">${decodedText}</a>`;
            } else {
                linkOutput.textContent = `Scanned: ${decodedText}`;
            }

            successModal.classList.remove("hidden");

            // Auto-close modal after 2 seconds
            setTimeout(() => {
                successModal.classList.add("hidden");
            }, 2000);
        })
        .catch(err => {
            document.getElementById("qr-result").innerText = "❌ Failed to scan image.";
            console.error("Image scan failed:", err);
        });
});
</script>

@endsection