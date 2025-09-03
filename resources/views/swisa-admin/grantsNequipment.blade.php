@extends('layouts.app')
@section('content')
<div class="p-4">
    <div class="bg-mainbg px-2">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
        <div class="text-customIT flex flex-col">
            <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Grants and Equipments</h2>
            <p class="text-sm text-gray-600">
                Manage, track, and monitor the availability of grants and equipment for SWISA members.
            </p>
        </div>
        @include('components.UserTab')
    </div>


    <!-- Top Stats + Charts -->
    <div class="grid grid-cols-12 gap-2 mb-3">
        <!-- Stats Cards -->
        <div class="flex flex-col gap-2 col-span-3">
            <!-- Overall Available -->
            <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
                <!-- Icon -->
                <div class="p-2 rounded-full bg-purple-100 text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="currentColor" 
                        class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M9 12.75l2.25 2.25L15 9.75m-6.75-6h7.5A2.25 2.25 0 0118 6v12a2.25 2.25 0 01-2.25 2.25h-7.5A2.25 2.25 0 016 18V6A2.25 2.25 0 018.25 3.75z" />
                    </svg>
                </div>
                <!-- Text -->
                <div>
                    <p class="text-sm font-semibold text-gray-600">Overall Available</p>
                    <h3 class="text-xl font-bold text-customIT">123</h3>
                </div>
            </div>


            <!-- Available Grants -->
            <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
                <!-- Icon -->
                <div class="p-2 rounded-full bg-green-100 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="currentColor" 
                        class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 
                            0 012-2h5.586a1 1 0 01.707.293l5.414 
                            5.414a1 1 0 01.293.707V19a2 2 
                            0 01-2 2z" />
                    </svg>
                </div>
                <!-- Text -->
                <div>
                    <p class="text-sm font-semibold text-gray-600">Available Grants</p>
                    <h3 class="text-xl font-bold text-customIT">123</h3>
                </div>
            </div>

            <!-- Available Equipment -->
            <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
                <!-- Icon -->
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="currentColor" 
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M3 7.5h18M3 12h18M3 16.5h18M5 20h14a2 2 0 
                            002-2V6a2 2 0 00-2-2H5a2 2 0 
                            00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <!-- Text -->
                <div>
                    <p class="text-sm font-semibold text-gray-600">Available Equipment</p>
                    <h3 class="text-xl font-bold text-customIT">123</h3>
                </div>
            </div>
        </div>

        <div class="col-start-4 col-span-5">
            <div class="bg-white shadow h-full rounded-lg p-4 flex items-center justify-between">
                <p class="item-center start-center">line graph</p>
            </div>
        </div>
        <div class="col-start-9 col-span-2">
            <div class="bg-white shadow h-full rounded-lg p-4 flex items-center justify-between">
                <p class="item-center start-center">Grants Allocated</p>
                pie chart
            </div>
        </div>
        <div class="col-start-11 col-span-2">
            <div class="bg-white shadow h-full rounded-lg p-4 flex items-center justify-between">
                <p class="item-center start-center">Status Request</p>
                pie chart
            </div>
        </div>
    </div>

    <div x-data="{ activeTab: 'grid' }" class="mt-4">

        @include('components.filters')

        <!-- Example of using the reusable component -->
        <div x-show="activeTab === 'grid'" class="pt-2 bg-gray-100 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
        <!-- Card with specific data -->
        <x-cards.grant-card
            title="Pangkagkag ni Peter"
            category="Machinery"
            stockAvailable="12"
            pendingRequests="24"
            approved="6"
            addedOn="12 units"
            lastUpdated="24"
            eligibility="Registered Members"
            allocationPercentage="50"
        />

        <!-- Another card with different data -->
        <x-cards.grant-card
            title="Another Grant"
            category="Agriculture"
            stockAvailable="5"
            pendingRequests="10"
            approved="3"
            addedOn="10 units"
            lastUpdated="15"
            eligibility="All Members"
            allocationPercentage="30"
        />

        <!-- A third card -->
        <x-cards.grant-card
            title="Third Grant"
            category="Technology"
            stockAvailable="20"
            pendingRequests="15"
            approved="10"
            addedOn="20 units"
            lastUpdated="18"
            eligibility="New Members"
            allocationPercentage="75"
        />
        <x-cards.grant-card
            title="Pangkagkag ni Peter"
            category="Machinery"
            stockAvailable="12"
            pendingRequests="24"
            approved="6"
            addedOn="12 units"
            lastUpdated="24"
            eligibility="Registered Members"
            allocationPercentage="50"
        />
        <x-cards.grant-card
            title="Pangkagkag ni Peter"
            category="Machinery"
            stockAvailable="12"
            pendingRequests="24"
            approved="6"
            addedOn="12 units"
            lastUpdated="24"
            eligibility="Registered Members"
            allocationPercentage="50"
        />
        <x-cards.grant-card
            title="Pangkagkag ni Peter"
            category="Machinery"
            stockAvailable="12"
            pendingRequests="24"
            approved="6"
            addedOn="12 units"
            lastUpdated="24"
            eligibility="Registered Members"
            allocationPercentage="50"
        />
        </div>

        <!-- for table/list front -->
        <div x-show="activeTab === 'list'" class="tab-pane">
                <div class="overflow-auto" style="max-height: 80vh;">
                    <table class="min-w-full bg-white border-spacing-y-1">
                    <thead class="bg-snbg border border-gray-100 px-8">
                        <tr class="text-customIT text-left ">
                            <th class="px-4 py-3 text-xs font-medium">ITEM NAME</th>
                            <th class="px-4 py-3 text-xs font-medium">CATEGORY</th>
                            <th class="px-4 py-3 text-xs font-medium">STOCK SUMMARY</th>
                            <th class="px-4 py-3 text-xs font-medium">ELIGIBILITY</th>
                            <th class="px-4 py-3 text-xs font-medium">ID NUMBER</th>
                            <th class="px-4 py-3 text-xs font-medium">LAST UPDATE</th>
                            <th class="px-4 py-3 text-xs font-medium">ALLOCATION</th>
                            <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Pangkagkag</td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                <div class="mt-1">
                                    <p>Tools</p>
                                    <p class="text-[10px] text-gray-500">returnable</p>
                                </div>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                <div class="mt-1">
                                    <p class="pr-2">Available:<span> 16 units</span></p>
                                    <p class="text-[10px] text-gray-500">Approved: 6</p>
                                </div>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">All Registered Member</td>
                            <td class="px-4 py-2 text-sm text-gray-700">123456789</td>
                            <td class="px-4 py-2 text-sm text-gray-700">25 Aug 2025</td>
                            <td class="pr-4 py-2 text-sm text-gray-700">
                                <div class=" h-2 w-full bg-gray-200 rounded-full">
                                    <div
                                        class="h-full bg-customIT rounded-full"
                                        style="width: 50%;">
                                    </div>
                                    <p class="text-center text-[10px]">50%</p>
                                </div>
                            </td>
                            <td class="pl-4 py-2 text-sm">
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
                                                    <a href="{{ route('view-grant') }}" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Grant</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Application</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-red-600 font-medium">Delete Grant</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                    </table>
                </div>
        </div>
    </div>

</div>
</div>
@endsection
