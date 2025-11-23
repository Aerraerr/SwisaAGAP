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
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">Total Members</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">1,540</p>
            <p class="text-xs text-gray-400 mt-1">All registered members</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-yellow-500">
            <h3 class="text-[#2C6E49] font-bold ">New Members (This Month)</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">35</p>
            <p class="text-xs text-gray-400 mt-1">Compared to last month: +12%</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-blue-600">
            <h3 class="text-[#2C6E49] font-bold ">Active Members</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">85%</p>
            <p class="text-xs text-gray-400 mt-1">Based on logins and activity</p>
        </div>
    </div>
    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
        @include('charts.member-type-breakdown')
        @include('charts.member-demographics')
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