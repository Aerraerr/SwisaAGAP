@extends('layouts.app')
@section('content')
<div class="p-4">
    <div class="bg-mainbg px-2">
    <div class="text-customIT text-2xl flex justify-between items-center mb-4">
        <h1 class="font-bold">Member Application Management</h1>
            @include('components.UserTab')
    </div>

    <div class="grid grid-cols-12 gap-1 md:gap-2">
        <!-- quick stats -->
        <div class="col-span-12 md:col-span-9 h-64 bg-white rounded-md shadow">
            <p class="font-bold text-center mt-20">LINE CHART</p>
        </div>
        <div class="col-span-12 md:col-span-3 md:col-start-10 bg-white rounded-md shadow py-3 px-5">
            <h2 class="text-customIT text-md font-bold">Application Status Overview</h2>
            <div class="my-2">
                <h2 class="font-semibold text-gray-600 text-xs">Cumulative Approved Request</h2>
                <p class="font-semibold text-btncolor text-xl">1,000</p>
            </div>
            <div class="my-2">
                <h2 class="font-semibold text-gray-600 text-xs">Cumulative Pending Request</h2>
                <p class="font-semibold text-btncolor text-xl">1,000</p>
            </div>
            <div class="my-2">
                <h2 class="font-semibold text-gray-600 text-xs">Cumulative Denied Request</h2>
                <p class="font-semibold text-btncolor text-xl">1,000</p>
            </div>
            <hr class="mx-2 my-3">
            <div class="font-semibold text-btncolor text-xs">
                <h3 href="" class="text-center cursor-pointer">View All Application Logs</h3>
            </div>
        </div>

        <!-- tab -->
        <div class="col-span-12 col-start-1 h-auto bg-white rounded-md shadow">
            <div class="bg-white rounded-xl shadow-md p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 text-center">
                    <!-- All Requests Tab -->
                    <div class="p-4 bg-btncolor text-white rounded-lg cursor-pointer transition-colors duration-200 hover:bg-gray-200 hover:rounded-sm hover:text-gray-700">
                        <i class="fas fa-list-ul mb-2 text-2xl"></i>
                        <p class="text-xs font-light">All Requests</p>
                    </div>
                    <!-- Pending Tab -->
                    <div class="p-4 bg-gray-200 text-gray-700 rounded-sm cursor-pointer transition-colors duration-200 hover:bg-btncolor hover:text-white hover:rounded-lg">
                        <i class="fas fa-hourglass-half mb-2 text-2xl"></i>
                        <p class="text-xs font-light">Pending</p>
                    </div>
                    <!-- Approved Tab -->
                    <div class="p-4 bg-gray-200 text-gray-700 rounded-sm cursor-pointer transition-colors duration-200 hover:bg-btncolor hover:text-white hover:rounded-lg">
                        <i class="fas fa-check-circle mb-2 text-2xl"></i>
                        <p class="text-xs font-light">Approved</p>
                    </div>
                    <!-- Denied Tab -->
                    <div class="p-4 bg-gray-200 text-gray-700 rounded-l-sm rounded-r-lg cursor-pointer transition-colors duration-200 hover:bg-btncolor hover:text-white hover:rounded-lg">
                        <i class="fas fa-times-circle mb-2 text-2xl"></i>
                        <p class="text-xs font-light">Denied</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- bottom content -->
        <div class="col-span-12 md:col-span-8 md:col-start-1 h-full bg-white px-6 py-4 rounded-md shadow">
            <div class="flex items-center">
                <img src="{{ asset('images/file-svg-green.svg') }}"
                    class="w-12 h-12" />
                <p class="text-customIT text-lg font-bold">Application List</p>
            </div>
            <div class="flex justify-end my-3">
                <input type="text" placeholder="Search here" class="w-1/2 h-9 bg-white text-xs text-gray-700 px-4 border-1 border-gray-300 rounded-md focus:outline-none">
            </div>
            <div class="overflow-auto">
                <table class="table table-hover min-w-full border-spacing-y-1">
                    <thead class="bg-snbg border-gray-300">
                        <tr class="text-customIT text-left text-xs font-semibold ">
                            <th class="px-4 py-3 rounded-tl-md">MEMBER ID</th>
                            <th class="px-4 py-3">NAME</th>
                            <th class="px-4 py-3">Date Submitted</th>
                            <th class="px-4 py-3 rounded-tr-md">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-approved text-white text-center h-5 w-20 rounded-full">
                                    Approved
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-rejected text-white text-center h-5 w-20 rounded-full">
                                    Rejected
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                    Pending
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                    Pending
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                    Pending
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                    Pending
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                    Pending
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                    Pending
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                    Pending
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                    Pending
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                    Pending
                                </div>
                            </td>
                        </tr>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3">
                                <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                    Pending
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-span-12 md:col-span-4 md:col-start-9 h-full bg-white items-center rounded-md shadow p-4">
            <div class="flex flex-col items-center mt-6">
                <img src="{{ asset('images/file-svg.svg') }}" class="w-32 h-32 pt-4"/>
            </div>
            <div class="text-center">
                <hr class="mx-10 my-3">
                <p class="text-gray-300 text-md">Select a request to view details</p>
            </div>
        </div>
        
    </div>
</div>
</div>
@endsection
