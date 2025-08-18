@extends('layouts.sidebar')

@section('content')
    <body class="bg-mainbg px-2">
        <div class="text-customIT text-2xl flex flex-col md:flex-row justify-between md:items-center mb-4">
            <h1 class="font-bold">Available Grants & Equipments</h1>
            <h1>Monday, 00 Month 2025</h1>
        </div>
        <div class="grid grid-cols-12 gap-2 py-2">
            <div class="col-span-12 lg:col-span-10 xl:col-span-8">
                <div class="bg-white shadow-lg p-4 h-[300px] rounded-md">
                    <div class="lg:flex h-full">
                        <div class="bg-gray-200 rounded-md h-28 w-full  lg:h-[260px] lg:w-[300px] flex items-center justify-center border-b border-gray-300 flex-shrink-0">
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
                            <div class="flex justify-between items-start">
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
                                <div class="w-1/2 flex items-center ml-auto">
                                    <div class="h-2 md:h-4 w-full bg-gray-200 rounded-full">
                                        <div class="h-full bg-customIT rounded-full" style="width: 50%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-lg p-4 h-auto rounded-md mt-2 overflow-auto">
                    <div class="text-customIT text-lg flex justify-between gap-2 mb-2">
                        <h1 class="font-bold mr-40">Request Summary Table</h1>
                    </div>
                    <div>
                        <table class="min-w-full border-spacing-y-1">
                        <thead class="bg-snbg border-y border-customIT">
                            <tr class="text-customIT text-left ">
                                <th class="px-4 py-2 text-sm font-semibold">Request Type</th>
                                <th class="px-4 py-2 text-sm font-semibold">Date Submitted</th>
                                <th class="px-4 py-2 text-sm font-semibold">Status</th>
                                <th class="px-4 py-2 text-sm font-semibold">Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-customIT">
                                <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Approved
                                </td>
                                <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                            </tr>
                            <tr class="border-b border-customIT">
                                <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Approved
                                </td>
                                <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                            </tr>
                            <tr class="border-b border-customIT">
                                <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                                <td class="px-4 py-2 text-sm font-medium text-approved flex items-center gap-1">
                                    Approved
                                </td>
                                <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                            </tr>
                            <tr class="border-b border-customIT">
                                <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                                <td class="px-4 py-2 text-sm font-medium text-rejected flex items-center gap-1">
                                    Rejected
                                </td>
                                <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                            </tr>
                            <tr class="border-b border-customIT">
                                <td class="px-4 py-2 text-sm text-gray-700">Pampalo kay Ron</td>
                                <td class="px-4 py-2 text-sm text-gray-700">Jan 24, 2025</td>
                                <td class="px-4 py-2 text-sm font-medium text-pending flex items-center gap-1">
                                    Pending
                                </td>
                                <td class="px-4 py-2 text-sm text-green-600 font-medium"><button>Reason.txt</button></td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2 xl:col-span-4 p-10 rounded-md">
                <div class="hidden xl:flex flex-col text-sm text-customIT font-medium m-14 gap-1">
                    <button class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Generate Report</button>
                    <button class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Add New Stock</button>
                    <button class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Edit Info</button>
                    <button class="w-full py-1.5 px-3 border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white">Delete</button>
                </div>

                <div class="block xl:hidden relative" x-data="{ open: false }">
                <!-- Main trigger button -->
                <button 
                    @click="open = !open"
                    class="w-auto p-3 sm:top-[0px] border-[3px] border-btncolor bg-white rounded-md shadow hover:bg-btncolor hover:text-white flex items-center"
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
    </body>
@endsection