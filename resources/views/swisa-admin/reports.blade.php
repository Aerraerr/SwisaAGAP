@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')

<div class="p-4">
    <div class="bg-mainbg px-4 min-h-screen">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Reports</h2>
                <p class="text-sm text-gray-600">Generate detailed insights and summaries of SWISA-AGAP activities.</p>
            </div>
            @include('components.UserTab')
        </div>

        <!-- Tabs + Filters in One Row -->
        <div class="rounded-xl mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <!-- Tabs Navigation -->
            <div class="bg-white rounded-xl shadow p-3">
                <nav class="flex flex-wrap gap-2 text-sm font-medium">
                    <button onclick="showSection(event, 'membership')" class="tab-btn active-tab px-3 py-2 rounded-lg">Membership</button>
                    <button onclick="showSection(event, 'requests')" class="tab-btn px-3 py-2 rounded-lg">Requests</button>
                    <button onclick="showSection(event, 'financial')" class="tab-btn px-3 py-2 rounded-lg">Financial</button>
                    <button onclick="showSection(event, 'communication')" class="tab-btn px-3 py-2 rounded-lg">Communication</button>
                    <button onclick="showSection(event, 'engagement')" class="tab-btn px-3 py-2 rounded-lg">Engagement</button>
                    <button onclick="showSection(event, 'performance')" class="tab-btn px-3 py-2 rounded-lg">Performance</button>
                    <button onclick="showSection(event, 'custom')" class="tab-btn px-3 py-2 rounded-lg">Custom</button>
                </nav>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-xl shadow p-3 flex flex-wrap gap-1 items-center">
                <div class="flex gap-1">
                    <input type="date" class="border rounded-lg px-3 py-2 text-sm">
                    <input type="date" class="border rounded-lg px-3 py-2 text-sm">
                </div>
                <select class="w-60 border rounded-lg px-2 py-2 text-sm">
                    <option>All Categories</option>
                    <option>Farming</option>
                    <option>Fishing</option>
                    <option>Livestock</option>
                </select>
                        <button class="bg-btncolor w-20 text-white px-2 py-2 rounded-lg text-sm hover:bg-btnhover">FILTER</button>
            </div>
        </div>

        <!-- Report Sections -->
        <div class="flex-1 bg-mainbg min-h-screen">

            <!-- Membership -->
            <section id="membership" class="report-section block">
                <!-- Header with Export Options -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                    <div>
                        <h2 class="text-2xl font-bold text-[#2C6E49]">Membership Reports</h2>
                        <p class="text-gray-500 text-sm">Overview of members, registrations, and activity</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                            <i class="material-icons text-sm">file_download</i> Export CSV
                        </button>
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                            <i class="material-icons text-sm">file_download</i> Export Excel
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                            <i class="material-icons text-sm">picture_as_pdf</i> Export PDF
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
                        <h3 class="text-[#2C6E49] font-bold ">Total Members</h3>
                        <p class="text-3xl font-bold text-green-600 mt-2">1,540</p>
                        <p class="text-xs text-gray-400 mt-1">All registered members</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
                        <h3 class="text-[#2C6E49] font-bold ">New Members (This Month)</h3>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">35</p>
                        <p class="text-xs text-gray-400 mt-1">Compared to last month: +12%</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
                        <h3 class="text-[#2C6E49] font-bold ">Active Members</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-2">85%</p>
                        <p class="text-xs text-gray-400 mt-1">Based on logins and activity</p>
                    </div>
                </div>

                <!-- Members Table -->
                <div class="bg-white rounded-2xl shadow p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-[#2C6E49] ">Registered Members</h3>
                        <input type="text" placeholder="Search members..." class="w-[500px] p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div> 
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border-collapse">
                            <thead>
                                <tr class="bg-snbg text-[#2C6E49]">
                                    <th class="text-left p-5">Name</th>
                                    <th class="text-left p-5">Barangay</th>
                                    <th class="text-left p-5">Email</th>
                                    <th class="text-left p-5">Contact Number</th>
                                    <th class="text-left p-5">Type</th>
                                    <th class="text-left p-5">ID Number</th>
                                    <th class="text-left p-5">Registered Since</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-5">Juan Dela Cruz</td>
                                    <td class="p-5">Barangay 1</td>
                                    <td class="p-5">juan@email.com</td>
                                    <td class="p-5">09123456789</td>
                                    <td class="p-5">Farming</td>
                                    <td class="p-5">MEM-10234</td>
                                    <td class="p-5">2023-01-15</td>
                                </tr>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-5">Maria Santos</td>
                                    <td class="p-5">Barangay 2</td>
                                    <td class="p-5">maria@email.com</td>
                                    <td class="p-5">09129876543</td>
                                    <td class="p-5">Fishing</td>
                                    <td class="p-5">MEM-20452</td>
                                    <td class="p-5">2023-02-20</td>
                                </tr>
                                    <tr class="border-t hover:bg-gray-50">
                                    <td class="p-5">Maria Santos</td>
                                    <td class="p-5">Barangay 2</td>
                                    <td class="p-5">maria@email.com</td>
                                    <td class="p-5">09129876543</td>
                                    <td class="p-5">Fishing</td>
                                    <td class="p-5">MEM-20452</td>
                                    <td class="p-5">2023-02-20</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>


            <!-- Requests -->
            <section id="requests" class="report-section hidden">
                <!-- Header with Export Options -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                    <div>
                        <h2 class="text-2xl font-bold text-[#2C6E49]">Requests Reports</h2>
                        <p class="text-gray-500 text-sm">Track requests and their approval status</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                            <i class="material-icons text-sm">file_download</i> Export CSV
                        </button>
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                            <i class="material-icons text-sm">file_download</i> Export Excel
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                            <i class="material-icons text-sm">picture_as_pdf</i> Export PDF
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
                        <h3 class="text-[#2C6E49] font-bold ">Total Requests</h3>
                        <p class="text-3xl font-bold text-green-600 mt-2">785</p>
                        <p class="text-xs text-gray-400 mt-1">All submitted requests</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
                        <h3 class="text-[#2C6E49] font-bold ">Approved Requests</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-2">510</p>
                        <p class="text-xs text-gray-400 mt-1">66% approval rate</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
                        <h3 class="text-[#2C6E49] font-bold ">Pending Requests</h3>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">120</p>
                        <p class="text-xs text-gray-400 mt-1">Awaiting review</p>
                    </div>
                </div>

                <!-- Requests Table -->
                <div class="bg-white rounded-2xl shadow p-4">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                        <h3 class="text-lg font-semibold">Recent Requests</h3>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Search requests..." class="p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <select class="p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">Filter by Status</option>
                                <option value="approved">Approved</option>
                                <option value="pending">Pending</option>
                                <option value="denied">Denied</option>
                            </select>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border-collapse">
                            <thead>
                                <tr class="bg-snbg text-[#2C6E49]">
                                    <th class="text-left p-2">Request ID</th>
                                    <th class="text-left p-2">Item</th>
                                    <th class="text-left p-2">Requester</th>
                                    <th class="text-left p-2">Date</th>
                                    <th class="text-left p-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-2">REQ-1024</td>
                                    <td class="p-2">Farming Tools</td>
                                    <td class="p-2">Juan Dela Cruz</td>
                                    <td class="p-2">2024-08-15</td>
                                    <td class="p-2 text-green-600 font-semibold">Approved</td>
                                </tr>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-2">REQ-1045</td>
                                    <td class="p-2">Fishing Nets</td>
                                    <td class="p-2">Maria Santos</td>
                                    <td class="p-2">2024-08-20</td>
                                    <td class="p-2 text-yellow-600 font-semibold">Pending</td>
                                </tr>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-2">REQ-1050</td>
                                    <td class="p-2">Livestock Feeds</td>
                                    <td class="p-2">Pedro Ramirez</td>
                                    <td class="p-2">2024-08-21</td>
                                    <td class="p-2 text-red-600 font-semibold">Denied</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>


            <!-- Financial -->
            <section id="financial" class="report-section hidden">
                <!-- Header with Export Options -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                    <div>
                        <h2 class="text-2xl font-bold text-[#2C6E49]">Financial Reports</h2>
                        <p class="text-gray-500 text-sm">Monitor grants, disbursements, and budget utilization</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                            <i class="material-icons text-sm">file_download</i> Export CSV
                        </button>
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                            <i class="material-icons text-sm">file_download</i> Export Excel
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                            <i class="material-icons text-sm">picture_as_pdf</i> Export PDF
                        </button>
                    </div>
                </div>

                <!-- Key Metrics -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
                        <h3 class="text-[#2C6E49] font-bold ">Total Grants Released</h3>
                        <p class="text-3xl font-bold text-green-600 mt-2">₱ 1.2M</p>
                        <p class="text-xs text-gray-400 mt-1">Funds provided to members</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
                        <h3 class="text-[#2C6E49] font-bold ">Budget Utilization</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-2">92%</p>
                        <p class="text-xs text-gray-400 mt-1">Of annual budget spent</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
                        <h3 class="text-[#2C6E49] font-bold ">Pending Disbursements</h3>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">₱ 250K</p>
                        <p class="text-xs text-gray-400 mt-1">Scheduled for release</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-red-600">
                        <h3 class="text-[#2C6E49] font-bold ">Expenditures</h3>
                        <p class="text-3xl font-bold text-red-600 mt-2">₱ 980K</p>
                        <p class="text-xs text-gray-400 mt-1">Total operating costs</p>
                    </div>
                </div>

                <!-- Financial Table -->
                <div class="bg-white rounded-2xl shadow p-4 mb-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                        <h3 class="text-lg font-semibold text-[#2C6E49] ">Recent Financial Transactions</h3>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Search transactions..." 
                                class="p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <select class="p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">Filter by Type</option>
                                <option value="grant">Grant</option>
                                <option value="expense">Expense</option>
                                <option value="disbursement">Disbursement</option>
                            </select>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border-collapse">
                            <thead>
                                <tr class="bg-snbg text-[#2C6E49]">
                                    <th class="text-left p-2">Transaction ID</th>
                                    <th class="text-left p-2">Type</th>
                                    <th class="text-left p-2">Amount</th>
                                    <th class="text-left p-2">Date</th>
                                    <th class="text-left p-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-2">TXN-2024-001</td>
                                    <td class="p-2">Grant</td>
                                    <td class="p-2 text-green-600 font-semibold">₱ 150,000</td>
                                    <td class="p-2">2024-08-10</td>
                                    <td class="p-2 text-green-600 font-semibold">Released</td>
                                </tr>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-2">TXN-2024-002</td>
                                    <td class="p-2">Expense</td>
                                    <td class="p-2 text-red-600 font-semibold">₱ 75,000</td>
                                    <td class="p-2">2024-08-15</td>
                                    <td class="p-2 text-gray-600">Processed</td>
                                </tr>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-2">TXN-2024-003</td>
                                    <td class="p-2">Disbursement</td>
                                    <td class="p-2 text-yellow-600 font-semibold">₱ 50,000</td>
                                    <td class="p-2">2024-08-20</td>
                                    <td class="p-2 text-yellow-600 font-semibold">Pending</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Financial Chart Placeholder -->
                <div class="bg-white rounded-2xl shadow p-4">
                    <h3 class="text-lg font-semibold mb-4 text-[#2C6E49] ">Budget Allocation Overview</h3>
                    <div class="h-64 flex items-center justify-center text-gray-400">
                        <!-- Placeholder for chart (Chart.js / ApexCharts) -->
                        [Chart will be displayed here]
                    </div>
                </div>
            </section>


            <!-- Communication -->
            <section id="communication" class="report-section hidden">
                <h2 class="text-2xl font-bold text-[#2C6E49] mb-4">Communication Reports</h2>
                <div class="bg-white rounded-2xl shadow p-4">
                    <h3 class="text-gray-600">Messages Sent to Members</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">4,500</p>
                </div>
            </section>

            <!-- Engagement -->
            <section id="engagement" class="report-section hidden">
                <h2 class="text-2xl font-bold text-[#2C6E49] mb-4">Engagement Reports</h2>
                <div class="bg-white rounded-2xl shadow p-4">
                    <h3 class="text-gray-600">Average Event Attendance</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">85%</p>
                </div>
            </section>

            <!-- Geographic -->
            <section id="geographic" class="report-section hidden">
                <h2 class="text-2xl font-bold text-[#2C6E49] mb-4">Geographic Reports</h2>
                <div class="bg-white rounded-2xl shadow p-4">
                    <h3 class="text-gray-600">Members Distribution by Barangay</h3>
                    <p class="text-gray-600">[Placeholder for map or chart]</p>
                </div>
            </section>

            <!-- Performance -->
            <section id="performance" class="report-section hidden">
                <h2 class="text-2xl font-bold text-[#2C6E49] mb-4">Performance Reports</h2>
                <div class="bg-white rounded-2xl shadow p-4">
                    <h3 class="text-gray-600">Request Fulfillment Rate</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">87%</p>
                </div>
            </section>

            <!-- Custom -->
            <section id="custom" class="report-section hidden">
                <h2 class="text-2xl font-bold text-[#2C6E49] mb-4">Custom Reports</h2>
                <div class="bg-white rounded-2xl shadow p-4">
                    <p class="text-gray-600">Generate your own custom report by selecting filters and exporting the data.</p>
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mt-3">Generate Report</button>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Tab Switching Script -->
<script>
    function showSection(e, id) {
        const sections = document.querySelectorAll('.report-section');
        const tabs = document.querySelectorAll('.tab-btn');

        sections.forEach(section => section.classList.add('hidden'));
        document.getElementById(id).classList.remove('hidden');

        tabs.forEach(tab => tab.classList.remove('active-tab', 'bg-green-600', 'text-white'));
        e.target.classList.add('active-tab', 'bg-green-600', 'text-white');
    }
</script>

<style>
    .tab-btn {
        color: #4B5563; /* gray-600 */
    }
    .tab-btn.active-tab {
        background-color: #4C956C; /* green-600 */
        color: #fff;
    }
</style>
@endsection
