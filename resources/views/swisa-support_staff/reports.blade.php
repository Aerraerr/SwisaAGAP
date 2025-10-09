@extends('layouts.app')
@section('content')
<div class="p-4">
    <div class="bg-mainbg px-2">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
        <div class="text-customIT flex flex-col">
            <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Equipment Reports</h2>
        </div>
        @include('components.UserTab')
    </div>

    <!-- Stats Cards for Initiatives & Events -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Initiatives -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">Total Reports</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">0</p>
            <p class="text-xs text-gray-400 mt-1">Overall reports</p>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
            <h3 class="text-[#2C6E49] font-bold ">This Month</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">0</p>
            <p class="text-xs text-gray-400 mt-1">Total report this month</p>
        </div>

        <!-- Completed Events -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
            <h3 class="text-[#2C6E49] font-bold ">Today</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">0</p>
            <p class="text-xs text-gray-400 mt-1">No report today</p>
        </div>
    </div>

    <div class="bg-white  p-5 rounded-xl shadow-xl">
        <div x-data="{ activeTab: 'grid' }" class="mt-4">

            @include('components.filters')

            <div x-show="activeTab === 'grid'" class="pt-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                <!-- Card with specific data -->
                @forelse($grantReports as $report)
                    <x-cards.report-card
                        item="{{ $report->application->grant->title ?? '-'}}"
                        type="{{ $report->application->grant->grant_type->grant_type ?? '-'}}"
                        item_id="{{ $report->application->grant->id ?? '-'}}"
                        status="To be review"
                        name="{{ $report->application->user->name ?? '-'}}"
                        request_date="{{ $report->application->created_at->format('M d, Y') ?? '-'}}"
                        last_report="{{ $report->updated_at->format('M d, Y') ?? '-'}}"
                        next_report="24 Sept 2025"
                        reportId="{{ $report->id ?? '-'}}"
                    />
                @empty
                    <x-cards.report-card
                        empty
                    />
                @endforelse
            </div>

            <!-- for table/list front -->
            <div x-show="activeTab === 'list'" class="tab-pane">
                    <div class="overflow-auto h-auto shadow-lg">
                        <table class="min-w-full bg-white border-spacing-y-1">
                        <thead class="bg-snbg border border-gray-100 px-8">
                            <tr class="text-customIT text-left ">
                                <th class="px-4 py-3 text-xs font-medium">ITEM NAME</th>
                                <th class="px-4 py-3 text-xs font-medium">TYPE</th>
                                <th class="px-4 py-3 text-xs font-medium">REQUEST ID</th>
                                <th class="px-4 py-3 text-xs font-medium">MEMBER NAME</th>
                                <th class="px-4 py-3 text-xs font-medium">REQUESTED AT</th>
                                <th class="px-4 py-3 text-xs font-medium">LAST REPROT</th>
                                <th class="px-4 py-3 text-xs font-medium">NEXT REPORT</th>
                                <th class="px-4 py-3 text-xs font-medium">STATUS</th>
                                <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($grantReports as $report)
                                <tr class="border border-gray-300 hover:bg-gray-100">
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $report->application->grant->title ?? '-'}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">
                                        <div class="mt-1">
                                            <p>{{ $report->application->grant->grant_type->grant_type ?? '-'}}</p>
                                            <p class="text-[10px] text-gray-500">returnable</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $report->application->id}}</td>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $report->application->user->name ?? '-'}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $report->application->created_at->format('M d, Y') ?? '-'}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $report->updated_at->format('M d, Y') ?? '-'}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">25 Sept 2025</td>
                                    <td class="pr-4 py-2 text-sm text-gray-700">
                                        <div class="inline-block text-xs font-medium bg-tbr border text-gray-700 text-center px-3 py-1 rounded-full">
                                            To be Review
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
                                                            <a href="{{ route('view-report', $report->id)}}" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-gray-600 font-medium">View Report</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-gray-600 font-medium">Update Status</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border border-gray-300 hover:bg-gray-100">
                                    <td class="px-4 py-2 text-sm text-gray-700">EMPTY</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
            </div>
            @include('components.pagination')
        </div>
    </div>

</div>
</div>
@endsection
