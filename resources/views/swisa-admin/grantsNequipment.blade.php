@extends('layouts.app')
@section('content')
@include('layouts.loading-overlay')
<div class="p-4 -mt-2">
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

        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
                <h3 class="text-[#2C6E49] font-bold ">Overall Available</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">240</p>
                <p class="text-xs text-gray-400 mt-1">All submitted requests</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
                <h3 class="text-[#2C6E49] font-bold ">Available Grants</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">120</p>
                <p class="text-xs text-gray-400 mt-1">66% approval rate</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
                <h3 class="text-[#2C6E49] font-bold ">Available Equipment</h3>
                <p class="text-3xl font-bold text-yellow-600 mt-2">120</p>
                <p class="text-xs text-gray-400 mt-1">Awaiting review</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-xl" >
            
                <div x-data="{ activeTab: 'grid' }" class="mt-4">

                    @include('components.filters')

                    <!-- Example of using the reusable component -->
                    <div x-show="activeTab === 'grid'" class="pt-2 shadow-xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
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
                            <div class="overflow-auto h-auto shadow-lg">
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
                @include('components.pagination')
        </div>
    </div>
</div>
@endsection
