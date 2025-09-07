@extends('layouts.app')
@section('content')
@include('layouts.loading-overlay')
<div class="p-4">
    <div class="bg-mainbg px-2">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Initiatives and Events</h2>
                <p class="text-sm text-gray-600">
                    Organize, monitor, and showcase SWISA initiatives, programs, and community events.
                </p>
            </div>
            @include('components.UserTab')
        </div>


        <!-- Top Stats + Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-5 md:grid-cols-5 gap-2 mb-3">
            <!-- Stats Cards -->
        <div class="flex flex-col gap-2 lg:col-span-1">
            <!-- Total Session -->
            <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
                <!-- Icon -->
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="currentColor" 
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M6.75 3v2.25M17.25 3v2.25M3 8.25h18M4.5 
                            21h15a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 
                            0 00-1.5-1.5h-15A1.5 1.5 0 003 
                            7.5v12a1.5 1.5 0 001.5 1.5z" />
                    </svg>
                </div>
                <!-- Text -->
                <div>
                    <p class="text-sm font-semibold text-gray-600">Total Session</p>
                    <h3 class="text-xl font-bold text-customIT">123</h3>
                </div>
            </div>
            
            <!-- Total Participants -->
            <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
                <!-- Icon -->
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 24 24" 
                        fill="currentColor" 
                        class="w-6 h-6">
                        <path fill-rule="evenodd" 
                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" 
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <!-- Text -->
                <div>
                    <p class="text-sm font-semibold text-gray-600">Total Participants</p>
                    <h3 class="text-xl font-bold text-customIT">123</h3>
                </div>
            </div>

            <!-- Upcoming -->
            <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
                <!-- Icon -->
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="currentColor" 
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M12 6v6l3 3m6-3a9 9 0 
                            11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <!-- Text -->
                <div>
                    <p class="text-sm font-semibold text-gray-600">Upcoming</p>
                    <h3 class="text-xl font-bold text-customIT">123</h3>
                </div>
                
            </div>

            <!-- dat btn ini -->
            <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
                <!-- Icon -->
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="currentColor" 
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M12 6v6l3 3m6-3a9 9 0 
                            11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <!-- Text -->
                <div>
                    <p class="text-sm font-semibold text-gray-600">Upcoming</p>
                    <h3 class="text-xl font-bold text-customIT">123</h3>
                </div>
                
            </div>
        </div>


        <!-- Charts -->
        <div class="lg:col-span-4 grid grid-cols-1 md:grid-cols-4 gap-2">
            <div class=" w-full bg-white shadow rounded-lg p-4 md:col-span-3 lg:grid-cols-3">
                <!-- Icon + Label -->
                <div class="flex items-center gap-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18M9 17V9m4 8v-4m4 4V5" />
                    </svg>
                    <h3 class="text-md font-semibold text-gray-700">Member Participation</h3>
                </div>

                                <!-- Chart -->
                <div class=" w-full">
                    <canvas id="memberParticipationChart" class="w-full h-[280px]"></canvas>
                </div>
            </div>




            <div class="bg-white shadow rounded-lg p-4 md:col-span-1 lg:grid-cols-1">
                <h3 class="text-md font-semibold mb-2 text-gray-700">Upcoming By Category</h3>
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
        <div x-show="activeTab === 'list'" class="tab-pane bg-white p-5 rounded-lg">
                <div class="overflow-auto" style="max-height: 80vh;">
                    <table class="min-w-full bg-white border-spacing-y-1">
                    <thead class="bg-snbg border border-black-100 px-8">
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
</div>
</div>
<script>
    const ctx = document.getElementById('memberParticipationChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Members',
                    data: [95, 120, 100, 130, 90, 115, 100, 120, 110, 130, 95, 115],
                    backgroundColor: '#2f8f4e',
                    borderRadius: 6,
                    stack: 'Stack 0',
                },
                {
                    label: 'Target',
                    data: [110, 130, 120, 150, 110, 130, 115, 130, 125, 140, 110, 125],
                    backgroundColor: 'rgba(34, 197, 94, 0.3)',
                    borderRadius: 6,
                    stack: 'Stack 0',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',   // ✅ always aligns with the index (month)
                intersect: false // ✅ fixes tooltip mismatch when hovering
            },
            plugins: {
                tooltip: {
                    enabled: true,
                    mode: 'index',
                    intersect: false // ✅ ensures correct tooltip on hover
                },
                legend: {
                    position: 'bottom',
                    labels: { color: '#374151' }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#374151' },
                    stacked: true,
                },
                x: {
                    ticks: { color: '#374151' },
                    stacked: true,
                }
            }
        }
    });
</script>




@endsection
