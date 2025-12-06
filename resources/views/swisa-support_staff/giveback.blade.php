@extends('layouts.app')
@section('content')
<div class="p-4 -mt-2">
    <div class="bg-mainbg px-2">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Member Giveback</h2>
                <p class="text-sm text-gray-600">
                   View and manage all reported member contributions and statuses.
                </p>
            </div>
        </div>
    
    @include('components.breadcrumbs', ['breadcrumbName' => Route::currentRouteName()])

    <!-- Stats Cards for Initiatives & Events -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Initiatives -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">Total Givebacks</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $givebacks->count();}}</p>
            <p class="text-xs text-gray-400 mt-1">Overall givebacks</p>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
            <h3 class="text-[#2C6E49] font-bold ">This Month</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $givebacks->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">Total giveback this month</p>
        </div>

        <!-- Completed Events -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
            <h3 class="text-[#2C6E49] font-bold ">Today</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $givebacks->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])->count()}}</p>
            <p class="text-xs text-gray-400 mt-1">No giveback today</p>
        </div>
    </div>

    <div class="bg-white  p-5 rounded-xl shadow-xl border border-gray-300">
        <div x-data="{ activeTab: 'grid' }" class="mt-4">

            @include('components.filters', ['targetTableId' => 'giveback-main-table'])

            <div x-show="activeTab === 'grid'" id="giveback-card-container" class="pt-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                <!-- Card with specific data -->
                @forelse($givebacks as $giveback)
                    <x-cards.giveback-card
                        name="{{ $giveback->application->grant->title ?? '-'}}"
                        status="{{ ucfirst( $giveback->status->status_name ?? '-')}}"
                        cont_quantity="{{ $giveback->quantity ?? '-'}} {{ $giveback->quantity_unit ?? '-'}}"
                        cont_date="{{ $giveback->created_at->format('F d, Y h:i A') ?? '-'}}"
                        givebackId="{{ $giveback->id}}"
                        data-search="{{ strtolower($giveback->application->grant->title.' '.ucfirst( $giveback->status->status_name ?? '-').' '.$giveback->quantity.' '.$giveback->created_at->format('F d, Y h:i A')) }}"
                    />
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-5 text-center">
                        <p class="text-gray-500 text-lg font-medium">No Givebacks Found</p>
                        <p class="text-gray-400 text-sm">Try checking back later or adding new entries.</p>
                    </div>
                @endforelse
            </div>

            <!-- for table/list front -->
            <div x-show="activeTab === 'list'" class="tab-pane">
                    <div class="overflow-auto-visible h-auto shadow-lg">
                        <table class="min-w-full bg-white border-spacing-y-1">
                        <thead class="bg-snbg border border-gray-100 px-8">
                            <tr class="text-customIT text-left ">
                                <th class="px-4 py-3 text-xs font-medium">ID</th>
                                <th class="px-4 py-3 text-xs font-medium">NAME</th>
                                <th class="px-4 py-3 text-xs font-medium">QUANTITY</th>
                                <th class="px-4 py-3 text-xs font-medium">UNIT</th>
                                <th class="px-4 py-3 text-xs font-medium">DATE</th>
                                <th class="px-4 py-3 text-xs font-medium">STATUS</th>
                                <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="giveback-main-table">
                            @forelse($givebacks as $giveback)
                                <tr class="border border-gray-300 hover:bg-gray-100">
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $giveback->id ?? '-'}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $giveback->user->first_name ?? '-'}} {{ $giveback->user->middle_name ?? '-'}} {{ $giveback->user->last_name ?? '-'}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $giveback->quantity ?? '-'}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $giveback->quantity_unit ?? '-'}}</td>
                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $giveback->created_at?->format('M d, Y') ?? '-'}}</td>
                                    <td class="pr-4 py-2 text-sm text-gray-700">
                                        <div class="inline-block text-xs font-medium {{ $giveback->status->status_name == 'completed' ? 'bg-approved' : 'bg-pending' }} text-white text-center px-3 py-1 rounded-full">
                                            {{ ucfirst( $giveback->status->status_name )}}
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
                                                            <a href="{{route('view-giveback', $giveback->id)}}" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-gray-600 font-medium">View Giveback</a>
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
                                <tr>
                                    <td colspan="8" class="text-center py-8 text-gray-500 text-sm">No Givebacks Found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
            </div>
           <x-pagination :paginator="$givebacks" />
        </div>  
    </div>

</div>
</div>
@endsection
