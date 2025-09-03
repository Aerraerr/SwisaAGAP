@extends('layouts.app')

@section('content')
    <body class="bg-mainbg px-2 space-y-2">
        <div class="text-customIT text-2xl flex flex-col md:flex-row justify-between md:items-center mb-4">
            <h1 class="font-bold">Program Details</h1>
            <h1>Monday, 00 Month 2025</h1>
        </div>
        <div class="grid grid-cols-12 gap-2 py-2"  x-data="{ activeTab: 'initiative' }">
            <!-- Initiative tab -->
            <div x-show="activeTab === 'initiative'" class="col-span-12">
                <div class="bg-white shadow-lg p-4 h-auto rounded-md">
                    <div class="lg:flex h-full">
                        <div class="bg-gray-200 rounded-md h-44 w-full  lg:h-[260px] lg:w-[300px] flex items-center justify-center border-b border-gray-300 flex-shrink-0">
                            <span class="text-white text-md">IMAGE</span>
                        </div>
                        <div class="lg:ml-4 sm:flex-1 p-2">
                            <div>
                                <p class="text-xs md:text-2xl font-semibold text-customIT">Crop Management</p>
                                <p class="text-[10px] lg:text-sm text-gray-500 mb-2">Training Program</p>
                            </div>
                            <div class="mb-4 mt-10">
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">Status: </p>
                                    <span class="font-medium justify-end text-gray-800">Ongoing</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600  mb-1">Start Date: </p>
                                     <span class="font-medium text-gray-800">12 units</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">End Date: </p>
                                    <span class="font-medium text-gray-800">24</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">Participants: </p>
                                    <span class="font-medium text-gray-800">6</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col text-sm text-customIT font-medium m-14 gap-1">
                            <button onclick="openModal('programQrModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">QR Code</button>
                            <!-- temporary muna iyang modal sa edit, wara pa design para jan eh-->
                            <button onclick="openModal('editGrantModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Edit Info</button>
                            <button onclick="openModal('geneReportModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Generate Report</button>
                            <button onclick="openModal('endProgramModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">End Program</button>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'initiative'" class="col-start-1 col-span-12 xl:col-span-8 xl:col-start-1 bg-white shadow-lg p-4 rounded-md overflow-auto">
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
                                <div class="bg-gray-400 rounded-md">
                                    <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                        Active
                                    </td>
                                </div>
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
                                                        <a href="{{ route('view-profile') }}"  class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Profile</a>
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
                    <h2 class="text-lg xl:text-2xl text-customIT font-semibold">Program Description</h2>
                    <p class="text-left text-sm text-bsctxt p-6">
                        This comprehensive training program is designed to equip farmers with the latest knowledge and practical skills in crop management.
                        The curriculum covers key areas from advanced land preparation techniques to post-harvest technology. Participants will learn about 
                        integrated pest management (IPM) strategies to reduce chemical use, and effective methods for ensuring crop quality and minimizing 
                        post-harvest losses. The program combines theoretical knowledge with hands-on field sessions, allowing participants to apply what they learn in a real-world setting.
                    </p>
                </div>
                
                <div class="bg-white shadow-lg p-4 h-auto rounded-md mt-2 overflow-auto">
                    <p class="text-lg xl:text-xl text-upcoming font-semibold text-center">UPCOMING - 25 AUGUST 2025</p>
                    <div class="px-10 py-3">
                        <button  @click="activeTab = 'participants'" class="w-full px-4 py-2 bg-btncolor text-white rounded-md hover:bg-opacity-80">
                            View Participants
                        </button>
                    </div>
                </div>
            </div>

            <!-- participants tab -->
            <div x-show="activeTab === 'participants'" class="col-span-12">
                <div class="bg-white shadow-lg p-4 h-auto rounded-md">
                    <div class="lg:flex h-full">
                        <div class="bg-gray-200 rounded-md h-44 w-full  lg:h-[260px] lg:w-[300px] flex items-center justify-center border-b border-gray-300 flex-shrink-0">
                            <span class="text-white text-md">IMAGE</span>
                        </div>
                        <div class="lg:ml-4 sm:flex-1 p-2">
                            <div>
                                <p class="text-xs md:text-2xl font-semibold text-customIT">Crop Management</p>
                                <p class="text-[10px] lg:text-sm text-gray-500 mb-2">Training Program</p>
                            </div>
                            <div class="mb-4 mt-10">
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">Status: </p>
                                    <span class="font-medium justify-end text-gray-800">Ongoing</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600  mb-1">Start Date: </p>
                                     <span class="font-medium text-gray-800">12 units</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">End Date: </p>
                                    <span class="font-medium text-gray-800">24</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">Participants: </p>
                                    <span class="font-medium text-gray-800">6</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col text-sm text-customIT font-medium m-14 gap-1">
                            <button onclick="openModal('geneReportModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Generate Report</button>
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
                                                        <a href="{{ route('view-profile') }}"  class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Profile</a>
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
        @include('components.modals.edit-grant')
        @include('components.modals.end-program')
        @include('components.modals.program-qr')
        @include('components.modals.generate-report')
    </body>
@endsection