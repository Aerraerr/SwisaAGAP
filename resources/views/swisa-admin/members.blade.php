@extends('layouts.app')
@section('content')

<div class="p-4">
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


        <!-- Dashboard Top Widgets + Member Demographics + Another Chart -->
        <div class="w-full grid grid-cols-1 lg:grid-cols-5 gap-2 mb-6">
            
            <!-- Column 1: Stats Widgets -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-2">
                <!-- Total Members -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4">
                    <!-- Icon -->
                    <div class="p-2 bg-green-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#2C6E49" class="size-6">
                        <path d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
                        </svg>
                    </div>
                    <!-- Text -->
                    <div>
                        <h3 class="text-xl font-bold text-customIT">1,123</h3>
                        <p class="text-gray-600 text-sm">Total Members</p>
                    </div>
                </div>

                <!-- Pending Applications -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4">
                    <!-- Icon -->
                    <div class="p-2 bg-yellow-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#CA8A04" class="size-6">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                        </svg>

                    </div>
                    <!-- Text -->
                    <div>
                        <h3 class="text-xl font-bold text-customIT">20</h3>
                        <p class="text-gray-600 text-sm">Pending Applications</p>
                    </div>
                </div>

        <!-- Rejected Applications -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4">
            <!-- Icon -->
            <div class="p-2 bg-red-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="h-6 w-6 text-red-600" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <!-- Text -->
            <div>
                <h3 class="text-xl font-bold text-customIT">20</h3>
                <p class="text-gray-600 text-sm">Rejected Applications</p>
            </div>
        </div>
    </div>
    @include('charts.member-demographics')
    @include('charts.member-registrations')
    </div>


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
            <div x-show="activeTab === 'list'" class="tab-pane">
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
        </div> 
        @include('components.pagination')
    </div>
    @include('components.modals.view-applications')
</div>
@endsection
