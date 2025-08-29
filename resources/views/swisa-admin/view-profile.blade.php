@extends('layouts.app')

@section('content')
    <body class="bg-mainbg">
        <div class="text-customIT text-2xl flex flex-col md:flex-row justify-between md:items-center mb-4">
            <h1 class="font-bold">View Profile</h1>
            <h1>Monday, 00 Month 2025</h1>
        </div>
<!-- Alpine.js wrapper so tab works -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-3">
        <!-- left part-->
        <div class="col-span-12 md:col-span-3 ">
            <div class="bg-white shadow flex justify-center pt-3 rounded-md">
                <div class="flex flex-col items-center m-2">
                    <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                    class="w-40 h-40 rounded-full shadow-md object-cover" />
                    <h3 class="text-xl font-semibold text-customIT">Ron Peter Mortega </h3>
                    <p class="border bg-snbg w-34 pl-6 pr-6 p-1 text-sm shadow rounded-3xl">Farmer</p>
                    <div class="flex">
                        <p class="text-xs text-gray-500 mt-2">Member ID: 123456789 </p>
                        <button><img src="{{ asset('images/copy-svg.svg') }}" alt="copy" class="w-8 h-8" /></button>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow  mt-2 p-3 rounded-md">
                <div class="flex flex-col text-customIT font-medium items-center gap-2">
                    <button class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">Send message </button>
                    <button onclick="openModal('viewApplicationModal')" class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">View All Application </button>
                    <button onclick="openModal('activityLogsModal')" class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">View Logs </button>
                    <button class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">Edit Profile </button>
                </div>
            </div>
        </div>
        <!--tab content middle part -->
        <div class="col-span-12 md:col-span-6">
            <!--tab content upper middle part -->
            <div class="bg-white shadow h-[250px] mb-4 pt-4 pl-6 pr-6 rounded-md">
                <div class="text-customIT text-md flex justify-between items-center mb-2">
                    <h1 class="font-bold">Basic Information</h1>
                    <button>
                        <img src="{{ asset('images/eye-svg.svg') }}" title="see details" class="w-8 h-8"/>
                    </button>
                </div>
                <div class="grid grid-cols-4 items-center mb-2 text-[10px] md:text-xs">
                    <div class="col-start-1">
                        <p class="text-customIT font-medium ">Full Name</p>
                        <p class="text-gray-500">Ron Peter Mortega</p>
                    </div>
                    <div class="col-start-2">
                        <p class="text-customIT font-medium">Member Type</p>
                        <p class="text-gray-500">Farmer</p>
                    </div>
                    <div class="col-start-3">
                        <p class="text-customIT font-medium">Joined Since</p>
                        <p class="text-gray-500">January 2025</p>
                    </div>
                    <div class="justify-center col-start-4">
                        <p class="text-customIT font-medium">Membership Status</p>
                        <p class="text-gray-500 bg-snbg text-center rounded-md shadow">Active</p>
                    </div>
                </div>
                <div class="text-customIT flex grid grid-cols-4 items-center text-[10px] md:text-xs mb-2">
                    <div class="col-start-1">
                        <p class="text-customIT font-medium">Gender</p>
                        <p class="text-gray-500">Gae</p>
                    </div>
                    <div class="col-start-2">
                        <p class="text-customIT font-medium">Email</p>
                        <p class="text-gray-500">*************</p>
                    </div>
                </div>
                <div class="text-customIT grid grid-cols-4 items-center text-[10px] md:text-xs  mb-2">
                    <div class="col-start-1">
                        <p class="text-customIT font-medium">Age</p>
                        <p class="text-gray-500">21 years old</p>
                    </div>
                    <div class="col-start-2">
                        <p class="text-customIT font-medium">Address</p>
                        <p class="text-gray-500">*************************</p>
                    </div>
                </div>
                <div class="text-customIT grid grid-cols-4 items-center text-[10px] md:text-xs  mb-2">
                    <div class="col-start-1">
                        <p class="text-customIT font-medium">Birthday</p>
                        <p class="text-gray-500">December 11, 2003</p>
                    </div>
                    <div class="col-start-2">
                        <p class="text-customIT font-medium">Contact Number</p>
                        <p class="text-gray-500">Primary: **************</p>
                    </div>
                    <div class="col-start-3 mt-4">
                        <p class="text-gray-500 text-xs block w-22 truncate">Secondary: **************</p>
                    </div>
                </div>
                <div class="text-customIT grid grid-cols-4 items-center text-[10px] md:text-xs mb-2">
                    <div class="col-start-1">
                        <p class="text-customIT font-medium">Benificiaries</p>
                        <p class="text-gray-500">************ *********** </p>
                    </div>
                </div>
            </div>
            <!--tab content lower middle part -->
            <div class="bg-white shadow h-[350px] overflow-auto p-4 rounded-md">
                <div class="text-customIT text-lg flex justify-between mb-2">
                    <h1 class="font-bold">Grant and Equipment History</h1>
                </div>
                <div class="overflow-auto">
                    <table class="min-w-full border-spacing-y-1">
                    <thead class="bg-snbg border-y border-gray-300">
                        <tr class="text-customIT text-left ">
                            <th class="px-4 py-2 text-sm font-semibold">Request Type</th>
                            <th class="px-4 py-2 text-sm font-semibold">Date Submitted</th>
                            <th class="px-4 py-2 text-sm font-semibold">Status</th>
                            <th class="px-4 py-2 text-sm font-semibold">Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border border-gray-300">
                            <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                            <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                Approved
                            </td>
                            <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                        </tr>
                        <tr class="border border-gray-300">
                            <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                            <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                Approved
                            </td>
                            <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                        </tr>
                        <tr class="border border-gray-300">
                            <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                            <td class="px-4 py-2 text-sm font-medium text-rejected flex items-center gap-1">
                                Rejected
                            </td>
                            <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                        </tr>
                        <tr class="border border-gray-300">
                            <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                            <td class="px-4 py-2 text-sm font-medium text-pending flex items-center gap-1">
                                Pending
                            </td>
                            <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                        </tr>
                        <tr class="border border-gray-300">
                            <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                            <td class="px-4 py-2 text-sm font-medium text-pending flex items-center gap-1">
                                Pending
                            </td>
                            <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                        </tr>
                        <tr class="border border-gray-300">
                            <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                            <td class="px-4 py-2 text-sm font-medium text-pending flex items-center gap-1">
                                Pending
                            </td>
                            <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                        </tr>
                        <tr class="border border-gray-300">
                            <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                            <td class="px-4 py-2 text-sm font-medium text-pending flex items-center gap-1">
                                Pending
                            </td>
                            <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                        </tr>
                        <tr class="border border-gray-300">
                            <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                            <td class="px-4 py-2 text-sm font-medium text-pending flex items-center gap-1">
                                Pending
                            </td>
                            <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--tab contents right part -->
        <div class="col-span-12 md:col-span-3">
            <!--tab contents upper right part -->
            <div class="bg-white p-4 h-[250px] mb-4 rounded-md shadow">
                <h2 class="text-md font-semibold text-customIT mb-4">Program Participation Summary</h2>
                <div class="grid grid-cols-2">
                    <div class="col-start-1 gap-2 text-md md:text-xs mt-4 md:mt-2">
                        <div class="flex text-btncolor gap-2 mb-2 md:gap-1">
                            <p class="w-6 h-6 md:w-3 md:h-3 rounded-full bg-btncolor"></p> 
                            <p>Programs Joined</p>
                        </div>
                        <div class="flex text-iconsClr gap-2 md:gap-1">
                            <p class="w-6 h-6 md:w-3 md:h-3 rounded-full bg-iconsClr"></p>
                            <p>Completion</p>
                        </div>
                    </div>
                    <div class="col-start-2">
                        <canvas id="programChart" class="w-[150px] h-[150px] md:w-[120px] md:h-[120px]"></canvas>
                    </div>
                </div>
            </div>
            <!--tab contents lower right part -->
            <div class="bg-white p-6 h-[350px] rounded-md shadow overflow-auto">
                <h2 class="text-md font-semibold text-customIT mb-4">Attached Documents</h2>
                <ul class="space-y-1 text-sm">
                <li class="flex justify-between items-center">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-700 font-medium block w-28 truncate" title="Government ID">Government ID</p>
                        <p class="text-[8px] text-gray-700">date uploaded: Jan 14, 2025</p>
                    </div>
                    <div class="flex gap-4 text-xs text-customIT font-medium">
                        <button>View</button>
                        <button>Download</button>
                    </div>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-700 font-medium block w-28 truncate" title="Proof of Ownership">Proof of Ownership</p>
                        <p class="text-[8px] text-gray-700">date uploaded: Jan 14, 2025</p>
                    </div>
                    <div class="flex gap-4 text-xs text-customIT font-medium">
                        <button>View</button>
                        <button>Download</button>
                    </div>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-700 font-medium block w-28 truncate" title="Proof of Ownership">Proof of Ownership</p>
                        <p class="text-[8px] text-gray-700">date uploaded: Jan 14, 2025</p>
                    </div>
                    <div class="flex gap-4 text-xs text-customIT font-medium">
                        <button>View</button>
                        <button>Download</button>
                    </div>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-700 font-medium block w-28 truncate" title="Proof of Ownership">Proof of Ownership</p>
                        <p class="text-[8px] text-gray-700">date uploaded: Jan 14, 2025</p>
                    </div>
                    <div class="flex gap-4 text-xs text-customIT font-medium">
                        <button>View</button>
                        <button>Download</button>
                    </div>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-700 font-medium block w-28 truncate" title="Proof of Ownership">Proof of Ownership</p>
                        <p class="text-[8px] text-gray-700">date uploaded: Jan 14, 2025</p>
                    </div>
                    <div class="flex gap-4 text-xs text-customIT font-medium">
                        <button>View</button>
                        <button>Download</button>
                    </div>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-700 font-medium block w-28 truncate" title="Proof of Ownership">Proof of Ownership</p>
                        <p class="text-[8px] text-gray-700">date uploaded: Jan 14, 2025</p>
                    </div>
                    <div class="flex gap-4 text-xs text-customIT font-medium">
                        <button>View</button>
                        <button>Download</button>
                    </div>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-700 font-medium block w-28 truncate" title="Proof of Ownership">Proof of Ownership</p>
                        <p class="text-[8px] text-gray-700">date uploaded: Jan 14, 2025</p>
                    </div>
                    <div class="flex gap-4 text-xs text-customIT font-medium">
                        <button>View</button>
                        <button>Download</button>
                    </div>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex-1 min-w-0">
                        <P class="text-xs text-gray-700 font-medium block w-28 truncate" title="Documents name 1 fit so long 123">Documents name 1 fit so long 123</P>
                        <p class="text-[8px] text-gray-700 ">date uploaded: Jan 14, 2025</p>
                    </div>
                    <div class="flex gap-4 text-xs text-customIT font-medium">
                        <button>View</button>
                        <button>Download</button>
                    </div>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex-1 min-w-0">
                        <P class="text-xs text-gray-700 font-medium block w-28 truncate" title="Documents name 1 fit so long 123">Documents name 1 fit so long 123</P>
                        <p class="text-[8px] text-gray-700 ">date uploaded: Jan 14, 2025</p>
                    </div>
                    <div class="flex gap-4 text-xs text-customIT font-medium">
                        <button>View</button>
                        <button>Download</button>
                    </div>
                </li>
                </ul>
            </div>
        </div>
    </div>
    @include('components.modals.grant-overview')
    @include('components.modals.view-applications')
    @include('components.modals.view-logs')
    </body>
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