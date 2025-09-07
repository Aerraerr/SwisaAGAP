@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')
    <div class="bg-mainbg">
        <div class="text-customIT text-2xl flex flex-col md:flex-row justify-between md:items-center mb-4">
            <h1 class="font-bold">View Profile</h1>
            @include('components.usertab')
        </div>

        <div class="grid grid-cols-1 md:grid-cols-8 xl:grid-cols-12 gap-2 xl:gap-3">
            <!-- left part-->
            <div class="col-span-12 md:col-span-3">
                <div class="bg-white shadow-lg flex justify-center pt-3 rounded-md">
                    <div class="flex flex-col items-center m-2">
                        <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                        class="w-30 h-30 md:w-28 md:h-28 lg:w-36 lg:h-36 xl:w-40 xl:h-40 rounded-full shadow-md object-cover mb-2" />
                        <h3 class="text-lg xl:text-xl font-semibold text-customIT">Ron Peter Mortega </h3>
                        <p class="border bg-snbg w-34 pl-6 pr-6 p-1 text-sm shadow rounded-3xl">Farmer</p>
                        <div class="flex">
                            <p class="text-xs text-gray-500 mt-2">Member ID: 123456789 </p>
                            <button><img src="{{ asset('images/copy-svg.svg') }}" alt="copy" class="w-8 h-8" /></button>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-lg  mt-3 p-3 rounded-md">
                    <div class="flex flex-col text-customIT font-medium items-center gap-2">
                        <button class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">Send message </button>
                        <button onclick="openModal('viewApplicationModal')" class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">View All Application </button>
                        <button onclick="openModal('activityLogsModal')" class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">View Logs </button>
                        <!--<button class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">Edit Profile </button>-->
                    </div>
                </div>
            </div>
            <!--tab content middle part -->
            <div class="col-span-12 md:col-span-5 xl:col-span-6">
                <!--tab content upper middle part -->
                <div x-data="{ showDetails: false }" class="md:col-span-5 bg-white shadow-lg w-full md:h-auto lg:h-auto xl:h-auto mb-3 py-4 px-6 rounded-md">
                    <div class="text-customIT text-sm md:text-xl flex justify-between items-center mb-2">
                        <h1 class="font-bold">Basic Information</h1>
                        <button @click="showDetails = !showDetails">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-4 md:grid-cols-2 lg:grid-cols-4 items-center mb-2 text-[10px] md:text-sm lg:text-md">
                        <div class="col-start-1">
                            <p class="text-customIT font-semibold ">Full Name</p>
                            <p class="text-gray-500 font-medium">Ron Peter Mortega</p>
                        </div>
                        <div class="col-start-2">
                            <p class="text-customIT font-semibold">Member Type</p>
                            <p class="text-gray-500 font-medium">Farmer</p>
                        </div>
                        <div class="col-start-3 md:col-start-1 lg:col-start-3">
                            <p class="text-customIT font-semibold">Joined Since</p>
                            <p class="text-gray-500 font-medium">January 2025</p>
                        </div>
                        <div class="justify-center col-start-4 md:col-start-2 lg:col-start-4 text-center">
                            <p class="text-customIT font-semibold">Membership Status</p>
                            <p class="inline-block text-xs font-medium bg-approved text-white px-4 py-1 rounded-full">
                                Active
                            </p>
                        </div>
                    </div>
                    <div class="text-customIT flex grid grid-cols-4 md:grid-cols-2 lg:grid-cols-4 items-center text-[10px] md:text-xs lg:text-md mb-2">
                        <div class="col-start-1">
                            <p class="text-customIT font-semibold">Gender</p>
                            <p class="text-gray-500 font-medium">Gae</p>
                        </div>
                        <div class="col-start-2">
                            <p class="text-customIT font-semibold">Email</p>
                            <p class="text-gray-500 font-medium">
                                <span x-show="!showDetails">*************</span>
                                <span x-show="showDetails">ron.p.mortega@email.com</span>
                            </p>
                        </div>
                    </div>
                    <div class="text-customIT grid grid-cols-4 md:grid-cols-2 lg:grid-cols-4 items-center text-[10px] md:text-xs lg:text-md  mb-2">
                        <div class="col-start-1">
                            <p class="text-customIT font-semibold">Age</p>
                            <p class="text-gray-500 font-medium">21 years old</p>
                        </div>
                        <div class="col-start-2">
                            <p class="text-customIT font-semibold">Address</p>
                            <p class="text-gray-500 font-medium">
                                <span x-show="!showDetails">*************</span>
                                <span x-show="showDetails">Rawis, Albay</span>
                            </p>
                        </div>
                    </div>
                    <div class="text-customIT grid grid-cols-4 md:grid-cols-2 lg:grid-cols-4 items-center text-[10px] md:text-xs lg:text-md  mb-2">
                        <div class="col-start-1">
                            <p class="text-customIT font-semibold">Birthday</p>
                            <p class="text-gray-500">December 11, 2003</p>
                        </div>
                        <div class="col-start-2">
                            <p class="text-customIT font-semibold">Contact Number</p>
                            <p class="text-gray-500 font-medium">
                                <span x-show="!showDetails">Primary: **************</span>
                                <span x-show="showDetails">Primary: 0912-345-6789</span>
                            </p>
                        </div>
                        <div class="col-start-2 mt-4">
                            <p class="text-gray-500 text-xs font-medium block w-22 truncate">
                                <span x-show="!showDetails">Secondary: **************</span>
                                <span x-show="showDetails">Secondary: 0998-765-4321</span>
                            </p>
                        </div>
                    </div>
                    <div class="text-customIT grid grid-cols-4 items-center text-[10px] md:text-xs lg:text-md mb-2">
                        <div class="col-start-1 col-span-2">
                            <p class="text-customIT font-semibold">Benificiaries</p>
                            <p class="text-gray-500 font-medium">
                                <span x-show="!showDetails">************ *********** </span>
                                <span x-show="showDetails">Juan Dela Cruz</span>
                            </p>
                        </div>
                    </div>
                </div>
                <!--tab content lower middle part -->
                <div class="md:col-span-12 bg-white shadow-lg xl:h-[50vh] overflow-auto p-4 rounded-md">
                    <div class="text-customIT text-lg flex justify-between mb-2">
                        <h1 class="font-bold">Grant and Equipment History</h1>
                    </div>
                    <div class="overflow-auto">
                        <table class="min-w-full border-spacing-y-1">
                        <thead class="bg-snbg border-y border-gray-300">
                            <tr class="text-customIT text-left text-sm font-semibold">
                                <th class="px-4 py-2">Requested Item</th>
                                <th class="px-4 py-2">Item Type</th>
                                <th class="px-4 py-2">Date Submitted</th>
                                <th class="px-4 py-2">Reason</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Tools</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                                <td class="px-4 py-2 text-sm text-gray-700 font-medium"><button onclick="openModal('viewReasonModal')">Reason</button></td>
                               <td class="px-4 py-3 ">
                                <div class="inline-block text-xs font-medium bg-approved text-white text-center px-3 py-1 rounded-full">
                                    Approved
                                </div>
                            </td>
                            </tr>
                            <tr class="border border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Tools</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                                <td class="px-4 py-2 text-sm text-gray-700 font-medium"><button onclick="openModal('viewReasonModal')">Reason</button></td>
                                <td class="px-4 py-3 ">
                                <div class="inline-block text-xs font-medium bg-rejected text-white text-center px-3 py-1 rounded-full">
                                    Rejected
                                </div>
                            </td>
                            </tr>
                            @for($i = 1; $i < 5; $i++)
                                <tr class="border border-gray-300">
                                    <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">Tools</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                                    <td class="px-4 py-2 text-sm text-gray-700 font-medium"><button onclick="openModal('viewReasonModal')">Reason</button></td>
                                    <td class="px-4 py-3 ">
                                        <div class="inline-block text-xs font-medium bg-pending text-white text-center px-3 py-1 rounded-full">
                                            Pending
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--tab contents right part -->
            <div class="col-span-12 md:col-start-4 md:col-span-5 xl:col-span-3">
                <!--tab contents upper right part -->
                <div class="bg-white p-4 h-auto mb-3 rounded-md shadow-lg">
                        <h2 class="text-md font-semibold text-customIT">Program Participation Summary</h2>
                        <div class="grid grid-cols-2 p-4 md:py-8 lg:py-12">
                            <div class="col-start-1 gap-2 text-md md:text-xs mt-6 md:p-8 lg:p-1">
                                <div class="flex text-btncolor gap-2 mb-2 md:gap-1">
                                    <p class="w-6 h-6 md:w-3 md:h-3 rounded-full bg-btncolor"></p> 
                                    <p>Programs Joined</p>
                                </div>
                                <div class="flex text-iconsClr gap-2 md:gap-1">
                                    <p class="w-6 h-6 md:w-3 md:h-3 rounded-full bg-iconsClr"></p>
                                    <p>Completion</p>
                                </div>
                            </div>
                            <div class="col-start-2 xl:col-start-2">
                                <canvas id="programChart" class="w-[150px] h-[150px] md:w-[150px] md:h-[150px] lg:w-[160px] lg:h-[160px]"></canvas>
                            </div>
                        </div>
                </div>
                <!--tab contents lower right part -->
                <div class="bg-white px-4 py-4 overflow-auto xl:h-[50vh] rounded-md shadow-lg flex flex-col">
                        <h2 class="text-ms md:text-lg font-semibold text-customIT mb-4 border-b pb-2 shrink-0">Attached Documents</h2>
                        <div class="overflow-auto flex-1 pr-2">
                            <ul class="space-y-1 text-sm">
                            <li class="flex justify-between items-center">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-700 font-medium block w-28 truncate" title="Government ID">Government ID</p>
                                    <p class="text-[9px] text-gray-700">date uploaded: Jan 14, 2025</p>
                                </div>
                                <div class="flex gap-4 text-xs text-customIT font-medium">
                                    <button onclick="openModal('viewDocumentModal')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 20" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                                        </svg>
                                    </button>
                                    <button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                    </button>
                                </div>
                            </li>
                            @for($i = 0; $i < 10; $i++)
                                <li class="flex justify-between items-center">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-700 font-medium block w-28 truncate" title="Proof of Ownership">Proof of Ownership</p>
                                        <p class="text-[9px] text-gray-700">date uploaded: Jan 14, 2025</p>
                                    </div>
                                    <div class="flex gap-4 text-xs text-customIT font-medium">
                                        <button onclick="openModal('viewDocumentModal')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 20" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                                            </svg>
                                        </button>
                                        <button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            @endfor
                            </ul>
                        </div>
                </div>
            </div>
        </div>
        @include('components.modals.grant-overview')
        @include('components.modals.view-applications')
        @include('components.modals.view-logs')
        @include('components.modals.view-reason')
        @include('components.modals.view-documents')
    </div>
    <script>
        const ctx = document.getElementById('programChart');
        new Chart(ctx, {
            type: 'pie',
            data: {
            labels: ['Programs Joined', 'Completion'],
            datasets: [{
                data: [60, 40], // sample data
                backgroundColor: ['#4C956C', '#68B2AB']
            }]
            },
            options: {
            responsive: false, // disable auto resize
            maintainAspectRatio: false, 
            plugins: { legend: { display: false } }
            }
        });

    </script>
@endsection