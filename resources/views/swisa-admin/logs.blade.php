@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')
    <!-- Page Header -->
    <div class="p-4">
        <div class="bg-mainbg px-6 min-h-screen">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-3">
                <!-- Left side -->
                <div class="text-customIT flex flex-col">
                    <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Activity Logs</h2>
                    <p class="text-sm text-gray-600">Manage, track, and publish important information for SWISA members.</p>
                </div>

                <!-- Right side -->
                @include('components.UserTab')
            </div>

            <!-- Filters & Search -->
            <div class="bg-white shadow rounded-lg p-4 mb-6">
                <div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                    <!-- Search Bar -->
                    <div class="flex items-center w-full sm:w-1/3">
                        <input type="text" placeholder="Search by user, activity..."
                               class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-btncolor focus:outline-none">
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-wrap gap-2">
                        <select class="border rounded-lg px-3 py-2 text-sm">
                            <option value="">All Roles</option>
                            <option value="Admin">Admin</option>
                            <option value="Member">SWISA Member</option>
                            <option value="Officer">System Officer</option>
                        </select>

                        <select class="border rounded-lg px-3 py-2 text-sm">
                            <option value="">All Status</option>
                            <option value="success">Successful</option>
                            <option value="failed">Failed</option>
                            <option value="pending">Pending</option>
                        </select>

                        <input type="date" class="border rounded-lg px-3 py-2 text-sm">
                        <input type="date" class="border rounded-lg px-3 py-2 text-sm">
                        <button class="bg-btncolor text-white px-4 py-2 rounded-lg text-sm hover:bg-btnhover">Filter</button>
                    </div>
                </div>
            </div>

            <!-- Activity Logs Table -->
            <div class="p-4 bg-white rounded-lg">
                <div class="bg-white overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3 text-left">Timestamp</th>
                            <th class="px-4 py-3 text-left">User</th>
                            <th class="px-4 py-3 text-left">Role</th>
                            <th class="px-4 py-3 text-left">Activity</th>
                            <th class="px-4 py-3 text-left">IP Address</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Example Log Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">2025-08-30 10:15 AM</td>
                            <td class="px-4 py-3">Juan Dela Cruz</td>
                            <td class="px-4 py-3">Admin</td>
                            <td class="px-4 py-3">Logged In</td>
                            <td class="px-4 py-3">192.168.1.5</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Successful</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button class="text-btncolor hover:underline">View Details</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">2025-08-30 09:45 AM</td>
                            <td class="px-4 py-3">Maria Santos</td>
                            <td class="px-4 py-3">Member</td>
                            <td class="px-4 py-3">Submitted Membership Application</td>
                            <td class="px-4 py-3">192.168.1.12</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button class="text-btncolor hover:underline">View Details</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">2025-08-29 04:30 PM</td>
                            <td class="px-4 py-3">Pedro Ramos</td>
                            <td class="px-4 py-3">Officer</td>
                            <td class="px-4 py-3">Approved Request</td>
                            <td class="px-4 py-3">192.168.1.20</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Successful</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button class="text-btncolor hover:underline">View Details</button>
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">2025-08-29 04:30 PM</td>
                            <td class="px-4 py-3">Pedro Ramos</td>
                            <td class="px-4 py-3">Officer</td>
                            <td class="px-4 py-3">Approved Request</td>
                            <td class="px-4 py-3">192.168.1.20</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Successful</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button class="text-btncolor hover:underline">View Details</button>
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">2025-08-29 04:30 PM</td>
                            <td class="px-4 py-3">Pedro Ramos</td>
                            <td class="px-4 py-3">Officer</td>
                            <td class="px-4 py-3">Approved Request</td>
                            <td class="px-4 py-3">192.168.1.20</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Successful</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button class="text-btncolor hover:underline">View Details</button>
                            </td>
                        </tr>
                                                <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">2025-08-29 04:30 PM</td>
                            <td class="px-4 py-3">Pedro Ramos</td>
                            <td class="px-4 py-3">Officer</td>
                            <td class="px-4 py-3">Approved Request</td>
                            <td class="px-4 py-3">192.168.1.20</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Successful</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button class="text-btncolor hover:underline">View Details</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">2025-08-29 04:30 PM</td>
                            <td class="px-4 py-3">Pedro Ramos</td>
                            <td class="px-4 py-3">Officer</td>
                            <td class="px-4 py-3">Approved Request</td>
                            <td class="px-4 py-3">192.168.1.20</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Successful</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button class="text-btncolor hover:underline">View Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

            <!-- Pagination -->
            <div class="mt-4 flex justify-between items-center text-sm">
                <p class="text-gray-600">Showing 1 to 10 of 120 logs</p>
                <div class="flex gap-2">
                    <button class="px-3 py-1 border rounded hover:bg-gray-100">&lt;</button>
                    <button class="px-3 py-1 border rounded bg-btncolor text-white">1</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-100">2</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-100">3</button>
                    <button class="px-3 py-1 border rounded hover:bg-gray-100">&gt;</button>
                </div>
            </div>
        </div>
    </div>
@endsection
