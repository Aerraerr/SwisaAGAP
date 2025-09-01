@extends('layouts.app')

@section('content')
    <body class="bg-mainbg px-2">
        <div class="text-customIT text-2xl flex flex-col md:flex-row justify-between md:items-center mb-4">
            <h1 class="font-bold">Available Grants & Equipments</h1>
            <h1>Monday, 00 Month 2025</h1>
        </div>
        <div class="grid grid-cols-12 gap-2 py-2" x-data="{ selectedUser: null }">
            <div class="col-span-12">
                <div class="bg-white shadow-lg p-4 h-auto rounded-md">
                    <div class="lg:flex h-full">
                        <div class="bg-gray-200 rounded-md h-44 w-full  lg:h-[260px] lg:w-[300px] flex items-center justify-center border-b border-gray-300 flex-shrink-0">
                            <span class="text-white text-md">IMAGE</span>
                        </div>
                        <div class="lg:ml-4 sm:flex-1 p-2">
                            <div>
                                <p class="text-xs md:text-lg font-semibold text-customIT">Pangkakgag ni Peter</p>
                                <p class="text-[10px] lg:text-sm text-gray-500 mb-2">Machinery</p>
                            </div>
                            <div class="flex justify-between mb-4">
                                <div class="flex-1">
                                    <p class="font-semibold text-xs lg:text-lg text-customIT flex items-center mb-1">
                                        <svg class="h-4 w-4 mr-1 customIT" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 12a1 1 0 112 0 1 1 0 01-2 0zm1-5a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                        Stock Summary
                                    </p>
                                    <p class="ml-5 text-[10px] text-gray-500 lg:text-sm">Available: <span class="font-medium text-gray-800">12 units</span></p>
                                    <p class="ml-5 text-[10px] text-gray-500 lg:text-sm">Pending: <span class="font-medium text-gray-800">24</span></p>
                                    <p class="ml-5 text-[10px] text-gray-500 lg:text-sm">Approved: <span class="font-medium text-gray-800">6</span></p>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-xs lg:text-lg text-customIT flex items-center mb-1">
                                        <svg class="h-4 w-4 mr-1 text-customIT" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                                            Last Restocked
                                    </h4>
                                    <p class="ml-5 text-gray-500 text-[10px] lg:text-sm">Added On: <span class="font-medium text-gray-800">12</span></p>
                                    <p class="ml-5 text-gray-500 text-[10px] lg:text-sm">Last Updated: <span class="font-medium text-gray-800">10</span></p>
                                </div>
                            </div>
                            <div class="flex justify-between items-start pb-4">
                                <div class="flex-shrink-0">
                                    <h4 class="font-semibold text-xs lg:text-lg text-sm text-customIT flex items-center mr-2">
                                        <!-- Badge icon -->
                                        <svg class="h-4 w-4 mr-1 text-customIT" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 10a1 1 0 012 0v5a1 1 0 11-2 0v-5zm1-3a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                                        Eligibility Info
                                    </h4>
                                    <p class="text-[10px] lg:text-sm text-gray-500 ml-5">
                                    For: <span class="font-medium text-gray-800">Registered Member</span>
                                    </p>
                                </div>
                            </div>
                            <div class="w-full mx-94 flex items-center ml-auto">
                                <div class="h-2 md:h-4 w-full bg-gray-200 rounded-full">
                                    <div class="h-full bg-customIT rounded-full" style="width: 50%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden xl:flex flex-col text-sm text-customIT font-medium m-14 gap-1">
                            <button class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Generate Report</button>
                            <button onclick="openModal('addStockModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Add New Stock</button>
                            <button onclick="openModal('editGrantModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Edit Info</button>
                            <button onclick="openModal('deleteGrantModal')" class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Delete</button>
                        </div>
                        <div class="block xl:hidden flex justify-end" x-data="{ open: false }">
                            <!-- Main trigger button -->
                            <button 
                                @click="open = !open"
                                class="p-3 sm:top-[2px] sm:item-center border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white"
                            >
                                ☰
                            </button>

                            <!-- Dropdown menu -->
                            <div 
                                x-show="open" 
                                @click.outside="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50"
                            >
                                <ul class="flex flex-col text-sm text-customIT font-medium">
                                    <li><button class="w-full text-left px-4 py-2 hover:bg-btncolor hover:text-white">Generate Report</button></li>
                                    <li><button class="w-full text-left px-4 py-2 hover:bg-btncolor hover:text-white">Add New Stock</button></li>
                                    <li><button class="w-full text-left px-4 py-2 hover:bg-btncolor hover:text-white">Edit Info</button></li>
                                    <li><button class="w-full text-left px-4 py-2 hover:bg-btncolor hover:text-white">Delete</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table -->
            <div class="col-start-1 col-span-12 lg:col-span-8 bg-white shadow-lg p-4 rounded-md mt-2 overflow-auto">
                <div class="text-customIT text-lg flex justify-between gap-2 mb-2">
                    <h1 class="font-bold mr-40">Request Summary Table</h1>
                </div>
                <div class="overflow-auto" style="max-height: 90vh;">
                    <table class="min-w-full border-spacing-y-1">
                    <thead class="bg-snbg border border-gray-100">
                        <tr class="text-customIT text-left ">
                            <th class="px-4 py-3 text-xs font-medium">NAME</th>
                            <th class="px-4 py-3 text-xs font-medium">ID NUMBER</th>
                            <th class="px-4 py-3 text-xs font-medium">MEMBER TYPE</th>
                            <th class="px-4 py-3 text-xs font-medium">DATE SUBMITTED</th>
                            <th class="px-4 py-3 text-xs font-medium">STATUS</th>
                            <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border border-gray-300 hover:bg-gray-100 cursor-pointer"
                            @click="selectedUser = { 
                                name: 'Aeron Jead Marquez', 
                                id: '112233445566', 
                                type: 'Member Type', 
                                date: '25 Aug 2025', 
                                status: 'Approved',
                                phone: '09090909090',
                                email: 'ajm@gmail.com'
                            }">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <td class="px-4 py-2 text-sm text-gray-700">25 Aug 2025</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Approved
                                </td>
                            </div>
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
                                                    <a href="{{ route('grant-request') }}" class="block cursor-pointer px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Request</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr class="border border-gray-300 hover:bg-gray-100 cursor-pointer"
                            @click="selectedUser = { 
                                name: 'Aeron Jead Marquez', 
                                id: '112233445566', 
                                type: 'Member Type', 
                                date: '25 Aug 2025', 
                                status: 'Pending',
                                phone: '09090909090',
                                email: 'ajm@gmail.com'
                            }">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <td class="px-4 py-2 text-sm text-gray-700">25 Aug 2025</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-pending flex items-center gap-1">
                                    Pending
                                </td>
                            </div>
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
                                                    <a href="{{ route('grant-request') }}" class="block cursor-pointer px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Request</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100 cursor-pointer"
                            @click="selectedUser = { 
                                name: 'Aeron Jead Marquez', 
                                id: '112233445566', 
                                type: 'Member Type', 
                                date: '25 Aug 2025', 
                                status: 'Rejected' 
                                phone: '09090909090',
                                email: 'ajm@gmail.com'
                            }">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <td class="px-4 py-2 text-sm text-gray-700">25 Aug 2025</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-rejected flex items-center gap-1">
                                    Rejected
                                </td>
                            </div>
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
                                                    <a href="{{ route('grant-request') }}" class="block cursor-pointer px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Request</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @for($i = 1; $i < 7; $i++)
                            <tr class="border border-gray-300 hover:bg-gray-100 cursor-pointer"
                                @click="selectedUser = { 
                                name: 'Aeron Jead Marquez', 
                                id: '112233445566', 
                                type: 'Member Type', 
                                date: '25 Aug 2025', 
                                status: 'Pending'
                                phone: '09090909090',
                                email: 'ajm@gmail.com' 
                                }">
                                <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                                <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                                <td class="px-4 py-2 text-sm text-gray-700">25 Aug 2025</td>
                                <div class="bg-gray-400 rounded-md">
                                    <td class="px-4 py-2 text-sm font-medium text-pending flex items-center gap-1">
                                        Pending
                                    </td>
                                </div>
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
                                                        <a href="{{ route('grant-request') }}" class="block cursor-pointer px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Request</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    </table>
                </div>
            </div>
            <!-- right side pane -->
            <div class="col-span-12 lg:col-start-9 lg:col-span-4 ">
                <!-- thi is where the data of the clicked row should appear-->
                <div class="flex flex-col bg-white shadow-lg p-10 h-auto rounded-md mt-2 text-center overflow-auto">
                    <!-- Show default message if no user selected -->
                    <template x-if="!selectedUser">
                        <div>
                            <div class="flex flex-col items-center ">
                                <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                                    class="w-36 h-36 rounded-full shadow-md object-cover mb-4" />
                                <p class="text-2xl text-gray-300 font-semibold">Select User to View</p>
                            </div>
                            <div class="text-left m-6">
                                <p class="text-md text-gray-300 font-semibold">ID NO: </p>
                                <p class="text-md text-gray-300 font-semibold">MEMBER TPYE: </p>
                                <p class="text-md text-gray-300 font-semibold">DOB: </p>
                                <p class="text-md text-gray-300 font-semibold">CONTACT NO.</p>
                                <p class="text-md text-gray-300 font-semibold">EMAIL</p>
                            </div>
                        </div>
                    </template>

                    <!-- Show selected user details -->
                    <template x-if="selectedUser">
                        <div> 
                            <div class="flex flex-col items-center ">
                                <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                                    class="w-36 h-36 rounded-full shadow-md object-cover mb-4" />
                                <p class="text-[30px] text-customIT font-bold" x-text="selectedUser.name"></p>
                                <p class="text-btncolor">Registered Member</p>
                            </div>
                            <div class="text-left m-6">
                                <p class="text-md text-gray-600 font-semibold">ID NO: <span x-text="selectedUser.id" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="text-md text-gray-600 font-semibold">MEMBER TYPE: <span x-text="selectedUser.type" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="ttext-md text-gray-600 font-semibold">DOB: <span x-text="selectedUser.date" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="ttext-md text-gray-600 font-semibold">CONTACT NO: <span x-text="selectedUser.phone" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="ttext-md text-gray-600 font-semibold">EMAIL: <span x-text="selectedUser.email" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="text-md text-gray-600 font-semibold">REQUEST STATUS:<span class="text-md ml-4 font-semibold"
                                :class="{
                                    'text-approved': selectedUser.status === 'Approved',
                                    'text-pending': selectedUser.status === 'Pending',
                                    'text-rejected': selectedUser.status === 'Rejected'
                                    }"
                                x-text="selectedUser.status" class="text-sm font-extralight text-approved"></span></p>
                            </div>
                        </div>
                    </template>
                </div>
                
                <div class="bg-white shadow-lg p-3 h-auto rounded-md mt-2 overflow-auto">
                    <p class="text-lg text-gray-400 font-medium text-center">Feedback Insghts</p>
                    <div class="grid grid-cols-2">
                        <div class="col-span-1">
                            {{--details--}}
                        </div>

                        <div class="cols-start-2">
                           {{--Circle chart--}}
                        </div>
                    </div>
                    <div class="px-10 py-2">
                        <button class="w-full px-4 py-2 bg-btncolor text-white rounded-md hover:bg-opacity-80">
                            View All Feedback
                        </button>
                    </div>
                </div>

                <div class="bg-white shadow-lg p-3 h-auto rounded-md mt-2 overflow-auto">
                    <p class="text-lg text-gray-400 font-medium text-center">View All list for this Grant?</p>
                    <div class="px-10 py-2">
                        <button class="w-full px-4 py-2 bg-btncolor text-white rounded-md hover:bg-opacity-80">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @include('components.modals.edit-grant')
        @include('components.modals.add-grant-stock')
        @include('components.modals.delete-grant')
    </body>
@endsection