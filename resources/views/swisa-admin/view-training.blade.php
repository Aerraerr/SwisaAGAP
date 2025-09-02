@extends('layouts.app')

@section('content')
    <body class="bg-mainbg px-2">
        <div class="text-customIT text-2xl flex flex-col md:flex-row justify-between md:items-center mb-4">
            <h1 class="font-bold">Program Details</h1>
            <h1>Monday, 00 Month 2025</h1>
        </div>
        <div class="grid grid-cols-12 gap-2 py-2">
            <div class="col-span-12">
                <div class="bg-white shadow-lg p-4 h-auto rounded-md">
                    <div class="lg:flex h-full">
                        <div class="bg-gray-200 rounded-md h-44 w-full  lg:h-[260px] lg:w-[300px] flex items-center justify-center border-b border-gray-300 flex-shrink-0">
                            <span class="text-white text-md">IMAGE</span>
                        </div>
                        <div class="lg:ml-4 sm:flex-1 p-2">
                            <div>
                                <p class="text-xs md:text-2xl font-semibold text-customIT">Crop Management</p>
                                <p class="text-[10px] lg:text-sm text-gray-500 mb-2">Training Program</p>
                            </div>
                            <div class="mb-4 mt-10">
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">Status: </p>
                                    <span class="font-medium justify-end text-gray-800">Ongoing</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600  mb-1">Start Date: </p>
                                     <span class="font-medium text-gray-800">12 units</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">End Date: </p>
                                    <span class="font-medium text-gray-800">24</span>
                                </div>
                                <div class="flex items-center space-x-4 mb-1">
                                    <p class="font-semibold text-md text-gray-600 mb-1">Participants: </p>
                                    <span class="font-medium text-gray-800">6</span>
                                </div>
                            </div>
                        </div>
                        <div class="hidden xl:flex flex-col text-sm text-customIT font-medium m-14 gap-1">
                            <button class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">QR Code</button>
                            <button class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Edit Info</button>
                            <button class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Generate Report</button>
                            <button class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">End Program</button>
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
            <div class="col-start-1 col-span-8 bg-white shadow-lg p-4 rounded-md mt-2 overflow-auto">
                <div class="text-customIT text-lg flex justify-between gap-2 mb-2">
                    <h1 class="font-bold mr-40">Program Attendees</h1>
                </div>
                <div class="overflow-auto" style="max-height: 90vh;">
                    <table class="min-w-full border-spacing-y-1">
                    <thead class="bg-snbg border border-gray-100">
                        <tr class="text-customIT text-left ">
                            <th class="px-4 py-3 text-xs font-medium">NAME</th>
                            <th class="px-4 py-3 text-xs font-medium">ID NUMBER</th>
                            <th class="px-4 py-3 text-xs font-medium">MEMBER TYPE</th>
                            <th class="px-4 py-3 text-xs font-medium">STATUS</th>
                            <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Active
                                </td>
                            </div>
                            <td class="px-4 py-2 text-sm text-gray-700">...</td>
                        </tr>

                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Active
                                </td>
                            </div>
                            <td class="px-4 py-2 text-sm text-gray-700">...</td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Active
                                </td>
                            </div>
                            <td class="px-4 py-2 text-sm text-gray-700">...</td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Active
                                </td>
                            </div>
                            <td class="px-4 py-2 text-sm text-gray-700">...</td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Active
                                </td>
                            </div>
                            <td class="px-4 py-2 text-sm text-gray-700">...</td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Active
                                </td>
                            </div>
                            <td class="px-4 py-2 text-sm text-gray-700">...</td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Active
                                </td>
                            </div>
                            <td class="px-4 py-2 text-sm text-gray-700">...</td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Active
                                </td>
                            </div>
                            <td class="px-4 py-2 text-sm text-gray-700">...</td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Active
                                </td>
                            </div>
                            <td class="px-4 py-2 text-sm text-gray-700">...</td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-2 text-sm text-gray-700">112233445566</td>
                            <td class="px-4 py-2 text-sm text-gray-700">Member Type</td>
                            <div class="bg-gray-400 rounded-md">
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Active
                                </td>
                            </div>
                            <td class="px-4 py-2 text-sm text-gray-700">...</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>

            <div class="col-start-9 col-span-4 grid grid-rows-">
                <div class="flex flex-col bg-white shadow-lg p-10 rounded-md mt-2 overflow-auto">
                    <h2 class="text-2xl text-customIT font-semibold">Program Description</h2>
                    <p class="text-left text-sm text-gray-500 font-light">
                        This comprehensive training program is designed to equip farmers with the latest knowledge and practical skills in crop management.
                        The curriculum covers key areas from advanced land preparation techniques to post-harvest technology. Participants will learn about 
                        integrated pest management (IPM) strategies to reduce chemical use, and effective methods for ensuring crop quality and minimizing 
                        post-harvest losses. The program combines theoretical knowledge with hands-on field sessions, allowing participants to apply what they learn in a real-world setting.
                    </p>
                </div>
                
                <div class="bg-white shadow-lg p-4 h-auto rounded-md mt-2 overflow-auto">
                    <p class="text-lg text-gray-400 font-medium text-center">View All list for this Grant?</p>
                    <div class="px-10 py-3">
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