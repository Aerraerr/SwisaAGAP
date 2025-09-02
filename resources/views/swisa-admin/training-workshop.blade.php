@extends('layouts.app')
@section('content')
<body class="bg-mainbg px-2">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
        <div class="text-customIT flex flex-col">
            <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Initiatives and Events</h2>
        </div>
        @include('components.UserTab')
    </div>

    <!-- Top Stats + Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-3">
        <!-- Stats Cards -->
        <div class="flex flex-col gap-2 lg:col-span-1">
            <div class="bg-white shadow rounded-lg p-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Total Session</p>
                    <h3 class="text-xl font-bold text-customIT">123</h3>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Total Participants</p>
                    <h3 class="text-xl font-bold text-customIT">123</h3>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600">Upcoming</p>
                    <h3 class="text-xl font-bold text-customIT">123</h3>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-sm font-semibold mb-2 text-gray-700">Member Participation</h3>
                <div class="h-40 flex items-center justify-center text-gray-400">
                    <span>[Chart Placeholder]</span>
            </div>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-sm font-semibold mb-2 text-gray-700">Upcoming By Category</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-500">Organization Meeting</p>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-btncolor h-2 rounded-full" style="width:25%"></div>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Title 2</p>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-btncolor h-2 rounded-full" style="width:50%"></div>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Title 3</p>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-btncolor h-2 rounded-full" style="width:75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-data="{ activeTab: 'grid' }" class="mt-4">
        @include('components.filters')
        
        <!-- Example of using the reusable component -->
        <div x-show="activeTab === 'grid'" class="pt-2 bg-gray-100 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
            <!-- Card with specific data -->
            <x-cards.training-card
                title="Suntukan sa B4"
                category="farmvile"
                date="sept 20, 2025"
                time="9:00 am"
                participants="24"
            />
            <x-cards.training-card
                title="Suntukan sa B4"
                category="farmvile"
                date="sept 20, 2025"
                time="9:00 am"
                participants="24"
            />
            <x-cards.training-card
                title="Suntukan sa B4"
                category="farmvile"
                date="sept 20, 2025"
                time="9:00 am"
                participants="24"
            />
            <x-cards.training-card
                title="Suntukan sa B4"
                category="farmvile"
                date="sept 20, 2025"
                time="9:00 am"
                participants="24"
            />
            <x-cards.training-card
                title="Suntukan sa B4"
                category="farmvile"
                date="sept 20, 2025"
                time="9:00 am"
                participants="24"
            />
            <x-cards.training-card
                title="Suntukan sa B4"
                category="farmvile"
                date="sept 20, 2025"
                time="9:00 am"
                participants="24"
            />
        </div>
        <div x-show="activeTab === 'list'" class="tab-pane">
                <div class="overflow-auto" style="max-height: 80vh;">
                    <table class="min-w-full bg-white border-spacing-y-1">
                    <thead class="bg-snbg border border-gray-100 px-8">
                        <tr class="text-customIT text-left ">
                            <th class="px-4 py-3 text-xs font-medium">TITLE</th>
                            <th class="px-4 py-3 text-xs font-medium">CATEGORY</th>
                            <th class="px-4 py-3 text-xs font-medium">DATE</th>
                            <th class="px-4 py-3 text-xs font-medium">TIME</th>
                            <th class="px-4 py-3 text-xs font-medium">VENUE</th>
                            <th class="px-4 py-3 text-xs font-medium">PARTICIPANTS</th>
                            <th class="px-4 py-3 text-xs font-medium">I&E ID</th>
                            <th class="px-4 py-3 text-xs font-medium">LAST UPDATE</th>
                            <th class="px-4 py-3 text-xs font-medium">STATUS</th>
                            <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Bungagan sa B4</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Org Meeting</td>
                            <td class="px-4 py-2 text-sm text-gray-700">25 Aug 2025</td>
                            <td class="px-4 py-2 text-sm text-gray-700">9:00 am</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Swisa Office</td>
                            <td class="px-4 py-2 text-sm text-gray-700">35/40</td>
                            <td class="px-4 py-2 text-sm text-gray-700">123456789</td>
                            <td class="px-4 py-2 text-sm text-gray-700">25 Aug 2025</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Ongoing</td>
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
                                                    <a href="{{ route('view-training') }}" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-red-600 font-medium">Delete Initiatives/Events</a>
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
</body>
@endsection
