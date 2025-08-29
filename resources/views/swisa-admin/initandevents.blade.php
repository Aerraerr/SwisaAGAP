@extends('layouts.app')

@section('content')
<div class="pt-4" x-data="{ view: 'grid' }"> {{-- Alpine.js state --}}
    <div class="bg-mainbg px-4 min-h-screen">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Initiatives and Events</h2>
            </div>
            @include('components.UserTab')
        </div>

        <!-- Top Stats + Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-3">
            <!-- Stats Cards -->
            <div class="flex flex-col gap-4 lg:col-span-1">
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

            @include("filters.forINITIATIVES")

        <!-- GRID VIEW -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-show="view === 'grid'">
            @foreach(range(1,3) as $i)
                <div class="bg-white shadow rounded-lg overflow-hidden flex flex-col">
                    <div class="m-5 h-40 bg-gray-200 flex items-center justify-center text-gray-400">
                        IMAGE
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="font-bold text-customIT">Suntukan sa B4</h3>
                        <p class="text-xs text-gray-500 mb-2">Organization Meeting</p>
                        
                        <div class="text-xs text-gray-600 space-y-1 mb-4">
                            <p><span class="font-semibold">Date:</span> 24 November 2025</p>
                            <p><span class="font-semibold">Venue:</span> Swisa Bldg Office</p>
                            <p><span class="font-semibold">Participants:</span> 45 / ++</p>
                        </div>

                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xs font-medium text-gray-600">Status</span>
                            <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-md">Open</span>
                        </div>

                        <a href="#" class="mt-auto px-4 py-2 bg-btncolor text-white rounded-md text-center">View</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- LIST VIEW -->
        <div class="bg-white shadow rounded-lg overflow-hidden" x-show="view === 'list'" x-cloak>
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-100 text-gray-600 font-semibold">
                    <tr>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Venue</th>
                        <th class="px-4 py-2">Participants</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(range(1,5) as $i)
                        <tr class="border-t">
                            <td class="px-4 py-2">Suntukan sa B4</td>
                            <td class="px-4 py-2">24 November 2025</td>
                            <td class="px-4 py-2">Swisa Bldg Office</td>
                            <td class="px-4 py-2">45 / ++</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-md">Open</span>
                            </td>
                            <td class="px-4 py-2">
                                <a href="#" class="text-btncolor hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex flex-col md:flex-row justify-between items-center mt-6 gap-3">
            <div class="flex items-center gap-2">
                <button class="px-3 py-1 bg-gray-200 rounded">Back</button>
                <div class="flex gap-1">
                    @foreach(range(1,6) as $i)
                        <button class="px-3 py-1 {{ $i==1 ? 'bg-btncolor text-white' : 'bg-white border' }} rounded">{{ $i }}</button>
                    @endforeach
                    <button class="px-3 py-1 bg-white border rounded">...</button>
                    <button class="px-3 py-1 bg-white border rounded">25</button>
                    <button class="px-3 py-1 bg-white border rounded">Next</button>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <p class="text-xs text-gray-600">Result per page</p>
                <select class="px-2 py-1 border rounded text-sm">
                    <option>12</option>
                    <option>24</option>
                    <option>48</option>
                </select>
            </div>
        </div>
    </div>
</div>
@endsection
