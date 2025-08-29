@extends('layouts.app')
@section('content')
<div class="bg-mainbg px-2">
    <div class="text-customIT text-2xl flex justify-between items-center mb-4">
        <h1 class="font-bold">Registered Members</h1>
        <h1>Monday, 00 Month 2025</h1>
    </div>

    <div x-data="{ activeTab: 'grid' }" class="mt-4">

     @include('components.filters')

            <div x-show="activeTab === 'grid'" class="tab-pane grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2"  >
                {{-- For demonstration, hardcoded cards are used --}}
                
                {{-- Active Members --}}
                <x-cards.member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-cards.member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-cards.member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-cards.member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-cards.member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-cards.member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />

                {{-- Inactive Members --}}
                <x-cards.member-card
                    status="inactive"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-cards.member-card
                    status="inactive"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-cards.member-card
                    status="inactive"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
            </div>
            
            <!-- for table/list front -->
            <div x-show="activeTab === 'list'" class="tab-pane">
                <div class="overflow-auto" style="max-height: 80vh;">
                    <table class="min-w-full bg-white border-spacing-y-1">
                    <thead class="bg-snbg border border-gray-100 px-8">
                        <tr class="text-customIT text-left ">
                            <th class="px-4 py-3 text-xs font-medium">NAME</th>
                            <th class="px-4 py-3 text-xs font-medium">AGE</th>
                            <th class="px-4 py-3 text-xs font-medium">EMAIL</th>
                            <th class="px-4 py-3 text-xs font-medium">CONTACT NO.</th>
                            <th class="px-4 py-3 text-xs font-medium">ID NUMBER</th>
                            <th class="px-4 py-3 text-xs font-medium">TYPE</th>
                            <th class="px-4 py-3 text-xs font-medium">REGISTERED SINCE</th>
                            <th class="px-4 py-3 text-xs font-medium">STATUS</th>
                            <th class="px-4 py-3 text-xs font-medium">ACTION</th>
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
                                <td class="px-4 py-3 text-sm font-medium text-approved">
                                    Active
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
                                                    <a href="#" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Profile</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Application</a>
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

</div>

@endsection
