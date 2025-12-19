@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')
    <div class="bg-mainbg px-2">
        <div class="text-customIT text-2xl flex flex-col md:flex-row justify-between md:items-center mb-4">
            <h1 class="font-bold">Available Grants & Equipments</h1>
        </div>
        @include('components.breadcrumbs', [
            'breadcrumbName' => 'view-grant',
            'params' => [$grant]  {{-- pass the grant instance --}}
        ])



        <div class="grid grid-cols-12 gap-2 py-2" x-data="{ selectedUser: null, activeTab: 'request-table' }">
            <div class="col-span-12">
                <div class="bg-white shadow-lg p-4 h-auto rounded-md">
                    <div class="lg:flex h-auto">
                        <div class="rounded-md h-full w-full  lg:h-[260px] lg:w-1/3 flex justify-center flex-shrink-0">
                            <img 
                                src= "{{ $grant->documents->first() ? asset('storage/' . $grant->documents->first()->file_path) : asset('image/placeholder.png') }} "
                                alt="Grant Image" 
                                class="object-cover w-full h-full"
                            >
                        </div>
                        <div class="lg:ml-4 sm:flex-1 p-2">
                            <div>
                                <p class="text-xs md:text-2xl font-semibold text-customIT">{{ $grant->title}}</p>
                                <p class="text-sm lg:text-md text-gray-500 mb-2">{{ $grant->grant_type->grant_type}}</p>
                            </div>
                            <div class="flex justify-between mb-4">
                                <div class="flex-1">
                                    <p class="font-semibold text-xs lg:text-lg text-customIT flex items-center mb-1">
                                        Stock Summary
                                    </p>
                                    <p class="ml-5 text-[10px] text-gray-500 lg:text-sm">Available: <span class="font-medium text-gray-800">{{ $grant->total_quantity}}</span></p>
                                    <p class="ml-5 text-[10px] text-gray-500 lg:text-sm">Unit per Request: <span class="font-medium text-gray-800">{{ $grant->unit_per_request}}</span></p>
                                    <p class="ml-5 text-[10px] text-gray-500 lg:text-sm">Pending: <span class="font-medium text-gray-800">none</span></p>
                                    <p class="ml-5 text-[10px] text-gray-500 lg:text-sm">Approved: <span class="font-medium text-gray-800">none</span></p>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-xs lg:text-lg text-customIT flex items-center mb-1">
                                            Availability
                                    </h4>
                                    <p class="ml-5 text-gray-500 text-[10px] lg:text-sm">Available Date: <span class="font-medium text-gray-800">{{ $grant->available_at->format('F d Y') }}</span></p>
                                    <p class="ml-5 text-gray-500 text-[10px] lg:text-sm">End Date: <span class="font-medium text-gray-800">{{ $grant->end_at->format('F d Y') }}</span></p>
                                </div>
                                <div class="flex justify-between items-start pb-4">
                                    <div class="flex-1 flex-shrink-0">
                                        <h4 class="font-semibold text-xs lg:text-lg text-sm text-customIT flex items-center mr-2">
                                            <!-- Badge icon -->
                                            Eligibility Info
                                        </h4>
                                        <p class="text-[10px] lg:text-sm text-gray-500 ml-5">
                                        For: <span class="font-medium text-gray-800">Registered Member</span>
                                        </p>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-xs lg:text-lg text-customIT flex items-center mb-1">Requirements</h4>
                                        @forelse($grant->requirements as $requirement)
                                            <p class="ml-5 text-[10px] lg:text-sm font-medium text-gray-800">-{{ $requirement->requirement_name }}</p>
                                        @empty
                                            <li class="text-gray-500">No requirements found.</li>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="xl:flex flex-col text-sm text-customIT font-medium m-14 gap-1">
                            <button onclick="openModal('geneReportModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Generate Report</button>
                            <button onclick="openModal('addStockModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Add New Stock</button>
                            <button onclick="openModal('editGrantModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Edit Info</button>
                            <button onclick="openModal('deleteGrantModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table -->
            <div x-show="activeTab === 'request-table'" class="col-start-1 col-span-12 lg:col-span-8 bg-white shadow-lg px-4 rounded-md mt-2">
                <div class="text-customIT text-lg flex justify-between gap-2 my-4">
                    <h1 class="font-bold mr-40">Request Summary Table</h1>
                </div>
                <div class="overflow-auto h-auto">
                    <table class="min-w-full overflow-auto border-spacing-y-1">
                    <thead class="bg-snbg border border-gray-100">
                        <tr class="text-customIT text-left ">
                            <th class="px-4 py-3 text-xs font-medium">NAME</th>
                            <th class="px-4 py-3 text-xs font-medium">ID NUMBER</th>
                            <th class="px-4 py-3 text-xs font-medium">MEMBER TYPE</th>
                            <th class="px-4 py-3 text-xs font-medium">DATE SUBMITTED</th>
                            <th class="px-4 py-3 text-xs font-medium">STATUS</th>
                            <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border border-gray-300 hover:bg-gray-100 cursor-pointer"
                            @click="selectedUser = { 
                                name: 'Aeron Jead Marquez', 
                                id: '112233445566', 
                                type: 'Member Type', 
                                date: '25 Aug 2025', 
                                status: 'Approved',
                                phone: '09090909090',
                                email: 'ajm@gmail.com'
                            }">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <td class="px-4 py-2 text-sm text-gray-700">25 Aug 2025</td>
                            <td class="px-4 py-3 ">
                                <div class="inline-block text-xs font-medium bg-approved text-white text-center px-3 py-1 rounded-full">
                                    Approved
                                </div>
                            </td>
                            <td class="pl-4 py-3 text-sm">
                                <div class="relative" x-data="{ show: false }" @click.away="show = false">
                                    <button @click="show = !show"  class="border border-gray-300 rounded-sm pl-2">
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
                                                    <a href="{{ route('view-profile', $grant->id) }}"  class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Profile</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('grant-request') }}" class="block cursor-pointer px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View All Request</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100 cursor-pointer"
                            @click="selectedUser = { 
                                name: 'Aeron Jead Marquez', 
                                id: '112233445566', 
                                type: 'Member Type', 
                                date: '25 Aug 2025', 
                                status: 'Rejected', 
                                phone: '09090909090',
                                email: 'ajm@gmail.com'
                            }">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <td class="px-4 py-2 text-sm text-gray-700">25 Aug 2025</td>
                            <td class="px-4 py-3 ">
                                <div class="inline-block text-xs font-medium bg-rejected text-white text-center px-3 py-1 rounded-full">
                                    Rejected
                                </div>
                            </td>
                            <td class="pl-4 py-3 text-sm">
                                <div class="relative" x-data="{ show: false }" @click.away="show = false">
                                    <button @click="show = !show"  class="border border-gray-300 rounded-sm pl-2">
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
                                                    <a href="{{ route('view-profile', $grant->id) }}"  class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Profile</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('grant-request') }}" class="block cursor-pointer px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Request</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @for($i = 1; $i < 9; $i++)
                            <tr class="border border-gray-300 hover:bg-gray-100 cursor-pointer"
                                @click="selectedUser = { 
                                name: 'Aeron Jead Marquez', 
                                id: '112233445566', 
                                type: 'Member Type', 
                                date: '25 Aug 2025', 
                                status: 'Pending',
                                phone: '09090909090',
                                email: 'ajm@gmail.com' 
                                }">
                                <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                                <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                                <td class="px-4 py-2 text-sm text-gray-700">25 Aug 2025</td>
                                <td class="px-4 py-3 ">
                                    <div class="inline-block text-xs font-medium bg-pending text-white text-center px-3 py-1 rounded-full">
                                        Pending
                                    </div>
                                </td>
                                <td class="pl-4 py-3 text-sm">
                                    <div class="relative" x-data="{ show: false }" @click.away="show = false">
                                        <button @click="show = !show"  class="border border-gray-300 rounded-sm pl-2">
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
                                                        <a href="{{ route('view-profile', $grant->id) }}"  class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('grant-request') }}" class="block cursor-pointer px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Request</a>
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
            <!-- right side pane -->
            <div x-show="activeTab === 'request-table'" class="col-span-12 lg:col-start-9 lg:col-span-4 ">
                <!-- thi is where the data of the clicked row should appear-->
                <div class="flex flex-col bg-white shadow-lg rounded-md mt-2 overflow-auto">
                    <!-- Show default message if no user selected -->
                    <template x-if="!selectedUser">
                        <div class="p-4">
                            <h2 class="text-lg xl:text-2xl text-customIT font-semibold">Program Description</h2>
                            <p class="text-left text-sm text-bsctxt p-6">{{ $grant->description }}</div>
                    </template>

                    <!-- Show selected user details -->
                    <template x-if="selectedUser">
                        <div class="p-10 h-auto text-center"> 
                            <div class="flex flex-col items-center ">
                                <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                                    class="w-36 h-36 rounded-full shadow-md object-cover mb-4" />
                                <p class="text-[30px] text-customIT font-bold" x-text="selectedUser.name"></p>
                                <p class="text-btncolor">Registered Member</p>
                            </div>
                            <div class="text-left mx-6 mt-6">
                                <p class="text-md text-gray-600 font-semibold">ID NO: <span x-text="selectedUser.id" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="text-md text-gray-600 font-semibold">MEMBER TYPE: <span x-text="selectedUser.type" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="ttext-md text-gray-600 font-semibold">DOB: <span x-text="selectedUser.date" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="ttext-md text-gray-600 font-semibold">CONTACT NO: <span x-text="selectedUser.phone" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="ttext-md text-gray-600 font-semibold">EMAIL: <span x-text="selectedUser.email" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="text-md text-gray-600 font-semibold">REQUEST STATUS:<span class="text-xs text-white px-3 py-1 rounded-full ml-4 font-semibold"
                                :class="{
                                    'bg-approved': selectedUser.status === 'Approved',
                                    'bg-pending': selectedUser.status === 'Pending',
                                    'bg-rejected': selectedUser.status === 'Rejected'
                                    }"
                                x-text="selectedUser.status" class="text-sm font-extralight text-approved"></span></p>
                            </div>
                        </div>
                    </template>
                </div>
                
                <div  x-show="activeTab === 'request-table' || activeTab === 'feedback'" class="bg-white shadow-lg p-8 h-auto rounded-md mt-2 overflow-auto">
                    <div class="px-5 py-2">
                        <p class="text-bsctxt font-medium mb-2">View all feedback for this Grant / Equipment?</p>
                        <button @click="activeTab = 'feedback'" class="w-full px-4 py-3 bg-btncolor text-white rounded-md hover:bg-opacity-80">
                            View All Feedback
                        </button>
                    </div>
                </div>
            </div>

            <!-- feedback section -->
            <div x-show="activeTab === 'feedback'" class="col-start-1 col-span-12 lg:col-span-8 bg-white shadow-lg px-6 rounded-md mt-2 relative">
                <div class="text-customIT text-lg flex justify-between gap-2 my-4">
                    <h1 class="font-bold mr-40">Member Feedback</h1>
                </div>
                <div class="bg-white h-auto rounded-md mt-2 overflow-auto" style="max-height: 85vh;">
                <!-- member feedback section-->
                @for($i = 0; $i < 5; $i++)
                    <div class="bg-white p-4 rounded-[4px] shadow-sm border-b border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                                class="w-10 h-10 rounded-full shadow-md object-cover mb-4" />
                                <p class="text-sm pb-4 px-2 text-bsctxt font-semibold">Aeron Jead Marquez</p>
                            </div>
                            <div class="text-md font-medium text-approved">Positive</div>
                        </div>
                        <div class="border border-gray-200 rounded-[4px] py-4 px-10">
                            <p class="text-bsctxt text-sm">This is a placeholder for the actual feedback content. The layout is designed to show how individual feedback items will appear.</p>
                        </div>
                    </div>
                @endfor
                </div>
                <div>
                    @include('components.pagination')
                </div>
            </div>
            <!-- right side pane -->
            <div x-show="activeTab === 'feedback'" class="col-span-12 lg:col-start-9 lg:col-span-4 ">

                <div class="bg-white shadow-lg p-8 h-auto rounded-md mt-2">
                    <p class="text-xl text-customIT font-semibold">Feedback Insghts</p>
                    <div class="grid grid-cols-2 mb-6">
                        <div class="col-span-1 mb-2">
                            <div class="my-6">
                                <p class="text-md text-customIT font-semibold">4.5/5<span class="text-md text-bsctxt ml-2 font-medium ">Assessed</span></p>
                                <p class="text-md text-customIT font-semibold">12<span class="text-md text-bsctxt ml-2 font-medium">Reviews</span></p>
                            </div>
                            <div class="flex text-btncolor items-center gap-2 md:gap-1">
                                <p class="w-6 h-6 md:w-4 md:h-4 rounded-full bg-approved shadow-lg"></p> 
                                <p class="font-medium">Positive</p>
                            </div>
                            <div class="flex text-iconsClr items-center gap-2 md:gap-1">
                                <p class="w-6 h-6 md:w-4 md:h-4 rounded-full bg-neutral shadow-lg"></p>
                                <p class="font-medium">Neutral</p>
                            </div>
                            <div class="flex text-iconsClr items-center gap-2 md:gap-1">
                                <p class="w-6 h-6 md:w-4 md:h-4 rounded-full bg-rejected shadow-lg"></p>
                                <p class="font-medium">Negative</p>
                            </div>
                        </div>

                        <div class="cols-start-2">
                           <!-- Chart container on the right -->
                            <div class="flex justify-center items-center h-44">
                                <!-- Canvas element where the chart will be drawn -->
                                <canvas id="feedbackChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-lg p-3 h-auto rounded-md mt-2 overflow-auto">
                    <p class="text-lg text-gray-400 font-medium text-center">View All list for this Grant?</p>
                    <div class="px-10 py-2">
                        <button @click="activeTab = 'request-table'" class="w-full px-4 py-3 bg-btncolor text-white rounded-md hover:bg-opacity-80">
                            View All Request
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @include('components.modals.edit-grant')
        @include('components.modals.add-grant-stock')
        @include('components.modals.delete-grant')
        @include('components.modals.generate-report')
        <script>
            // Get the canvas element to render the chart on
            const ctx = document.getElementById('feedbackChart');

            // Define the data for the chart
            const data = {
                labels: ['Positive', 'Neutral', 'Negative'],
                datasets: [{
                    data: [65, 20, 15],
                    backgroundColor: [
                        '#4C956C', // Positive
                        '#B2D6D3', // Neutral
                        '#F15B66'  // Negative
                    ],
                    hoverOffset: 4,
                    // Add border between slices to match the image
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            };

            // Define the options for the chart
            const options = {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '40%', // Creates the donut hole
                plugins: {
                    legend: {
                        display: false // Hide the default Chart.js legend
                    },
                    tooltip: {
                        enabled: false // Hide tooltips on hover
                    }
                }
            };

            // Create the new Chart.js instance
            new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: options
            });
        </script>
    </div>
@endsection