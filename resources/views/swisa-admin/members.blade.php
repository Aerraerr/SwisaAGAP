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
            @include('components.UserTab')
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
                <h3 class="text-[#2C6E49] font-bold ">Total Members</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">785</p>
                <p class="text-xs text-gray-400 mt-1">All submitted requests</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
                <h3 class="text-[#2C6E49] font-bold ">Pending Applications</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">510</p>
                <p class="text-xs text-gray-400 mt-1">66% approval rate</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
                <h3 class="text-[#2C6E49] font-bold ">Rejected Applicationds</h3>
                <p class="text-3xl font-bold text-yellow-600 mt-2">120</p>
                <p class="text-xs text-gray-400 mt-1">Awaiting review</p>
            </div>
        </div>


        <div class="bg-white p-5 rounded-xl shadow-xl">
                    <!--Sample Data-->
                <div x-data="{ activeTab: 'grid' }" class="mt-4">
                    @include('components.filters')

                                            <!-- Main Grid Layout -->
                        <div x-show="activeTab === 'grid'" class="grid gap-2 grid-cols-1 sm:grid-cols-1 lg:grid-cols-3 w-full">
                            {{-- Active Members --}}
                            @for ($i = 1; $i <= 3; $i++)
                                <x-cards.member-card
                                    status="active"
                                    name="Full Name"
                                    role="General Producer"
                                    memberId="123-456"
                                    registered="1/01/2023"
                                    meetings="Meetings: 10/10"
                                />
                            @endfor
                        
                            {{-- Inactive Members --}}
                            @for ($i =1; $i <= 3; $i++)
                                <x-cards.member-card
                                    status="inactive"
                                    name="Full Name"
                                    role="General Producer"
                                    memberId="123-456"
                                    registered="1/01/2023"
                                    meetings="Meetings: 10/10"
                                />
                            @endfor
                        </div>

                        <!-- for table/list front -->
                        <div x-show="activeTab === 'list'" class="tab-pane border-black">
                            <div class="overflow-auto h-auto shadow-lg">
                                <table class="min-w-full bg-white border-spacing-y-1">
                                <thead class="bg-snbg border border-gray-100 px-8">
                                    <tr class="text-customIT text-left text-sm font-semibold">
                                        <th class="px-4 py-3">NAME</th>
                                        <th class="px-4 py-3">AGE</th>
                                        <th class="px-4 py-3">EMAIL</th>
                                        <th class="px-4 py-3">CONTACT NO.</th>
                                        <th class="px-4 py-3">ID NUMBER</th>
                                        <th class="px-4 py-3">TYPE</th>
                                        <th class="px-4 py-3">REGISTERED SINCE</th>
                                        <th class="px-4 py-3">STATUS</th>
                                        <th class="px-4 py-3">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <tr class="border border-gray-300 hover:bg-gray-100">
                                        <td class="flex px-4 py-3 text-sm text-gray-700">
                                            <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                                            class="w-5 h-5 rounded-full shadow-md mr-2"/>
                                            Aeron Jead Marquez</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">21</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">Aeron@gmail.com</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">09090900909</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">123456789</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">Basic</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">25 Aug 2025</td>
                                        <td class="px-4 py-3 ">
                                            <div class="inline-block text-xs font-medium bg-approved text-white text-center px-3 py-1 rounded-full">
                                                Approved
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
                                                                <a href="{{ route('view-profile') }}"  class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Profile</a>
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
                                    <?php endfor; ?>        
                                </tbody>
                                </table>
                            </div>
                        </div>
                        @include('components.pagination')
                </div>

        </div>

    </div>
    @include('components.modals.view-applications')
</div>
@endsection
