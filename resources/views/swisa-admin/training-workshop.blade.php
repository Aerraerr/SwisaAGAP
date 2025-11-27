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
        </div>
    </div>

    <!-- Stats Cards for Initiatives & Events -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Initiatives -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">Total Initiatives</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $trainings->count()}}</p>
            <p class="text-xs text-gray-400 mt-1">Projects and programs launched</p>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
            <h3 class="text-[#2C6E49] font-bold ">Upcoming Events</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $upcomingEvents ?: 'none'}}</p>
            <p class="text-xs text-gray-400 mt-1">Scheduled this quarter</p>
        </div>

        <!-- Completed Events -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
            <h3 class="text-[#2C6E49] font-bold ">Completed Events</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $completedEvents ?: 'none'}}</p>
            <p class="text-xs text-gray-400 mt-1">Successfully held activities</p>
        </div>
    </div>

    <div class="bg-white  p-5 rounded-xl shadow-xl border border-gray-300">
        <div x-data="{ activeTab: 'grid' }" class="mt-4">
            
            <x-filters modalId="addTrainingModal" />
            
            <!-- Example of using the reusable component -->
            <div x-show="activeTab === 'grid'" class="pt-2  grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                <!-- Card with specific data -->
                @foreach($trainings as $training)
                    <x-cards.training-card
                        image="{{ $training->documents->first() ? asset('storage/'.$training->documents->first()->file_path) : asset('images/default-grant.jpg') }}"
                        title="{{ $training->title}}"
                        category="{{ $training->sector->sector_name}}"
                        venue="{{ $training->venue}}"
                        date="{{ $training->date->format('F d Y') }}"
                        time="{{ \Carbon\Carbon::createFromFormat('H:i:s', $training->time)->format('g:i A') }}"
                        status="{{$training->date < now() ? 'Completed' : 'Upcoming'}}"
                        participants="{{ $training->participants->count()}}"
                        trainingId="{{ $training->id}}"
                    />
                @endforeach
            </div>
            <div x-show="activeTab === 'list'" class="tab-pane rounded-lg">
                    <div class="overflow-auto-visible h-auto shadow-lg">
                        <table class="min-w-full bg-white border-spacing-y-1">
                        <thead class="bg-snbg border border-black-100 px-8">
                            <tr class="text-customIT text-left ">
                                <th class="px-4 py-3 text-xs font-medium">ID</th>
                                <th class="px-4 py-3 text-xs font-medium">TITLE</th>
                                <th class="px-4 py-3 text-xs font-medium">CATEGORY</th>
                                <th class="px-4 py-3 text-xs font-medium">DATE</th>
                                <th class="px-4 py-3 text-xs font-medium">TIME</th>
                                <th class="px-4 py-3 text-xs font-medium">VENUE</th>
                                <th class="px-4 py-3 text-xs font-medium">PARTICIPANTS</th>
                                <th class="px-4 py-3 text-xs font-medium">STATUS</th>
                                <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trainings as $training)
                                <tr class="border border-gray-300 hover:bg-gray-100">
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $training->id}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $training->title}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{$training->sector->sector_name}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $training->date->format('F d Y') }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ \Carbon\Carbon::createFromFormat('H:i:s', $training->time)->format('g:i A') }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $training->venue}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $training->participants->count()}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{$training->date < now() ? 'Completed' : 'Upcoming'}}</td>
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
                                                            <a href="{{ route('view-training', $training->id) }}" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View</a>
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
                            @endforeach
                        </tbody>
                        </table>
                    </div>
            </div>
        </div>
        @include('components.pagination')
    </div>
    @include('components.modals.add-training')
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
