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
        </div>
    
        @include('components.breadcrumbs', ['breadcrumbName' => Route::currentRouteName()])


        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
                <h3 class="text-[#2C6E49] font-bold ">Overall Available</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $grants->count()}}</p>
                <p class="text-xs text-gray-400 mt-1">All submitted requests</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
                <h3 class="text-[#2C6E49] font-bold ">Available Grants</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $grants->count()}}</p>
                <p class="text-xs text-gray-400 mt-1">66% approval rate</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
                <h3 class="text-[#2C6E49] font-bold ">Available Equipment</h3>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $grants->count()}}</p>
                <p class="text-xs text-gray-400 mt-1">Awaiting review</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-xl border border-gray-300" >
            
                <div x-data="{ activeTab: 'grid' }" class="mt-4">

                    <x-filters modalId="addGrantModal" targetTableId="grants-list-table"/>

                    <!-- Example of using the reusable component -->
                    <div x-show="activeTab === 'grid'" id="grant-card-container" class="pt-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                    <!-- Card with specific data -->
                    @foreach($grants as $grant)
                        <x-cards.grant-card
                            title="{{ $grant->title}}"
                            image="{{ $grant->documents->first() ? asset('storage/'.$grant->documents->first()->file_path) : asset('images/default-grant.jpg') }}"
                            category="{{ $grant->grant_type->grant_type}}"
                            stockAvailable="{{ $grant->total_quantity}}"
                            available_date="{{ $grant->available_at->format('F d Y') }}"
                            end_date="{{ $grant->end_at->format('F d Y') }}"
                            grantId="{{ $grant->id}}"
                            data-search="{{ strtolower($grant->title.' '.$grant->grant_type->grant_type.' '.$grant->total_quantity.' '.$grant->available_at->format('F d Y').' '.$grant->end_at->format('F d Y') ) }}"
                        />
                    @endforeach
                    </div>

                    <!-- for table/list front -->
                    <div x-show="activeTab === 'list'" class="tab-pane">
                            <div class="overflow-auto-visible h-auto shadow-lg">
                                <table class="min-w-full bg-white border-spacing-y-1">
                                <thead class="bg-snbg border border-gray-100 px-8">
                                    <tr class="text-customIT text-left ">
                                        <th class="px-4 py-3 text-xs font-medium">ID</th>
                                        <th class="px-4 py-3 text-xs font-medium">ITEM NAME</th>
                                        <th class="px-4 py-3 text-xs font-medium">CATEGORY</th>
                                        <th class="px-4 py-3 text-xs font-medium">STOCK AVAILABLE</th>
                                        <th class="px-4 py-3 text-xs font-medium">AVAILABLE DATE</th>
                                        <th class="px-4 py-3 text-xs font-medium">END DATE</th>
                                        <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="grants-list-table">
                                    @foreach($grants as $grant)
                                        <tr class="border border-gray-300 hover:bg-gray-100">
                                            <td class="px-4 py-2 text-sm text-gray-700">GRNT{{$grant->id}}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700">{{ $grant->title}}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700"><p>{{ $grant->grant_type->grant_type }}</p></td>
                                            <td class="px-4 py-2 text-sm text-gray-700"><p class="pr-2">{{ $grant->total_quantity}}</p></td>
                                            <td class="px-4 py-2 text-sm text-gray-700">{{ $grant->available_at->format('F d Y') }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700">{{ $grant->end_at->format('F d Y') }}</td>
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
                                                                    <a href="{{ route('view-grant', $grant->id) }}" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Grant</a>
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
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                    </div>
                </div>
               <x-pagination :paginator="$grants" />
        </div>
    </div>
    @include('components.modals.add-grant')
</div>
@endsection
