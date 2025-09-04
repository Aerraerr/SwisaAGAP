@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="pt-4">
        <div class="bg-mainbg px-4 min-h-screen">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
                <!-- Left side -->
                <div class="text-customIT flex flex-col">
                    <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Reports</h2>
                    <p class="text-sm text-gray-600">Generate detailed insights and summaries of SWISA-AGAP activities.</p>
                </div>

                <!-- Right side -->
                @include('components.UserTab')
            </div>

            <!-- Filters -->
            <div class="bg-white p-4 rounded-2xl shadow mb-6 flex flex-col md:flex-row gap-3 items-start md:items-center">
                <div class="flex gap-3 w-full md:w-auto">
                    <input type="date" class="border rounded-lg px-3 py-2 text-sm w-full md:w-auto">
                    <input type="date" class="border rounded-lg px-3 py-2 text-sm w-full md:w-auto">
                </div>
                <select class="border rounded-lg px-3 py-2 text-sm w-full md:w-auto">
                    <option>All Categories</option>
                    <option>Farming</option>
                    <option>Fishing</option>
                    <option>Livestock</option>
                </select>
                <button class="bg-custom text-white px-4 py-2 rounded-lg text-sm shadow">Export</button>
            </div>

            <!-- Main Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Membership Reports -->
                <div class="bg-white rounded-2xl shadow p-4 col-span-2">
                    <h3 class="text-lg font-semibold mb-3 text-[#2C6E49]">Member Growth Over Time</h3>
                    <canvas id="memberGrowthChart" class="h-56"></canvas>
                </div>

                <div class="bg-white rounded-2xl shadow p-4">
                    <h3 class="text-lg font-semibold text-[#2C6E49] mb-3">Member Distribution by Type</h3>
                    <canvas id="memberTypeChart" class="h-56"></canvas>
                </div>

                <!-- Request Reports -->
                <div class="bg-white rounded-2xl shadow p-4">
                    <h3 class="text-lg font-semibold text-[#2C6E49] mb-3">Requests by Category</h3>
                    <canvas id="requestsCategoryChart" class="h-56"></canvas>
                </div>

                <div class="bg-white rounded-2xl shadow p-4">
                    <h3 class="text-lg font-semibold text-[#2C6E49] mb-3">Request Status Breakdown</h3>
                    <canvas id="requestStatusChart" class="h-56"></canvas>
                </div>

                <div class="bg-white rounded-2xl shadow p-4 col-span-2">
                    <h3 class="text-lg font-semibold text-[#2C6E49] mb-3">Monthly Request Trend</h3>
                    <canvas id="monthlyRequestTrend" class="h-56"></canvas>
                </div>

                <!-- Tables -->
                <div class="bg-white rounded-2xl shadow p-4 col-span-3">
                    <h3 class="text-lg font-semibold text-[#2C6E49] mb-3">Top Requested Equipment</h3>
                    <table class="w-full text-sm text-left border-t">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2">Equipment</th>
                                <th class="px-4 py-2">Requests</th>
                                <th class="px-4 py-2">Granted</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t">
                                <td class="px-4 py-2">Tractor</td>
                                <td class="px-4 py-2">120</td>
                                <td class="px-4 py-2">95</td>
                            </tr>
                            <tr class="border-t">
                                <td class="px-4 py-2">Fishing Net</td>
                                <td class="px-4 py-2">85</td>
                                <td class="px-4 py-2">70</td>
                            </tr>
                            <tr class="border-t">
                                <td class="px-4 py-2">Swine Feeds</td>
                                <td class="px-4 py-2">60</td>
                                <td class="px-4 py-2">55</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Custom Report Generator -->
                <div class="bg-white rounded-2xl shadow p-4 col-span-3 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-[#2C6E49]">Custom Report Generator</h3>
                        <p class="text-sm text-gray-500">Filter data and generate a custom export.</p>
                    </div>
                    <button class="bg-custom text-white px-6 py-2 rounded-lg shadow">Generate Report</button>
                </div>
            </div>
        </div>
    </div>
@endsection
