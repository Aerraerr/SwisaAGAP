@extends('layouts.app')
@section('content')
@include('layouts.loading-overlay')

<div class="p-4 -mt-2">
    <div class="bg-mainbg px-4 min-h-screen mr-0 w-full">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Registered Members</h2>
                <p class="text-sm text-gray-600">
                    Manage, track, and update records of active and inactive SWISA members.
                </p>
            </div>
        </div>
        

        <!-- Members Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
                <h3 class="text-[#2C6E49] font-bold ">Total members</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalMembers}}</p>
                <p class="text-xs text-gray-400 mt-1">All Swisa-Agap members</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
                <h3 class="text-[#2C6E49] font-bold ">New members this month</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $monthlyMembers}}</p>
                <p class="text-xs text-gray-400 mt-1">Members this month</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
                <h3 class="text-[#2C6E49] font-bold ">New members today</h3>
                <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $todayMembers}}</p>
                <p class="text-xs text-gray-400 mt-1">Today's new members</p>
            </div>
        </div>



        <div class="bg-white p-5 rounded-xl shadow-xl border border-gray-300">
                <!--Sample Data-->
                <div x-data="{ activeTab: 'grid' }" class="mt-4">
                    @include('components.filters', ['targetTableId' => 'members-main-table'])

                        <!-- Main Grid Layout -->
                        <div x-show="activeTab === 'grid'" class="grid gap-2 grid-cols-1 sm:grid-cols-1 lg:grid-cols-3 w-full">
                            {{-- Active Members --}}
                            @foreach($members as $member)
                                 <x-cards.member-card
                                    status="active"
                                    name="{{ $member->first_name}} {{ $member->middle_name ?? ''}} {{ $member->last_name}}{{ $member->suffix ?? ''}}"
                                    role="{{ $member->user_info->sector->sector_name ?? 'no sector initialize'}}"
                                    memberId="{{ $member->id}}"
                                    registered="{{ $member->created_at->format('F d Y') }}"
                                    modalId="{{ $member->id}}"
                                />
                            @endforeach
                        </div>

                        <!-- for table/list front -->
                        <div x-show="activeTab === 'list'" class="tab-pane border-black">
                            <div class="overflow-auto-visible h-auto shadow-lg">
                                <table class="min-w-full bg-white border-spacing-y-1">
                                <thead class="bg-snbg border border-gray-100 px-8">
                                    <tr class="text-customIT text-left text-sm font-semibold">
                                        <th class="px-4 py-3">ID</th>
                                        <th class="px-4 py-3">NAME</th>
                                        <th class="px-4 py-3">EMAIL</th>
                                        <th class="px-4 py-3">PHONE</th>
                                        <th class="px-4 py-3">TYPE</th>
                                        <th class="px-4 py-3">REGISTERED SINCE</th>
                                        <th class="px-4 py-3">STATUS</th>
                                        <th class="px-4 py-3">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="members-main-table">
                                    @foreach($members as $member)
                                        <tr class="border border-gray-300 hover:bg-gray-100">
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $member->formatted_id}}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $member->name}}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $member->email}}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $member->user_info->contact_no ?? '-'}}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $member->user_info->sector->sector_name ?? '-'}}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $member->created_at->format('F d Y') }}</td>
                                        <td class="px-4 py-3 ">
                                            <div class="inline-block text-xs font-medium bg-approved text-white text-center px-3 py-1 rounded-full">
                                                {{ $member->status ?? '-'}}
                                            </div>
                                        </td>
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
                                                                <a href="{{ route('view-profile', $member->id) }}"  class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Profile</a>
                                                            </li>
                                                            <li>
                                                                <a onclick="openModal('viewApplicationModal')" class="block cursor-pointer px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Application</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-red-600 font-medium">Delete Member</a>
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
                        <!-- Pagination Controls -->
                        <div id="paginationControls" class="flex justify-center items-center space-x-2 mt-4">
                            <button id="prevPage" class="px-3 py-1 border rounded hover:bg-gray-100 text-sm">Previous</button>
                            <span id="pageInfo" class="text-sm text-gray-700"></span>
                            <button id="nextPage" class="px-3 py-1 border rounded hover:bg-gray-100 text-sm">Next</button>
                        </div>
                </div>
        </div>

    </div>
</div>
@endsection