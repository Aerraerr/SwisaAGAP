<section id="requests" class="report-section hidden ">



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
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">Total Requests</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">785</p>
            <p class="text-xs text-gray-400 mt-1">All submitted requests</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-blue-600">
            <h3 class="text-[#2C6E49] font-bold ">Approved Requests</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">510</p>
            <p class="text-xs text-gray-400 mt-1">66% approval rate</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-yellow-500">
            <h3 class="text-[#2C6E49] font-bold ">Pending Requests</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">120</p>
            <p class="text-xs text-gray-400 mt-1">Awaiting review</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
            @include('charts.request-management')
    </div>
    <!-- Requests Table -->
    <div class="bg-white rounded-2xl shadow p-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3 p-4">
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
        <div class="overflow-x-auto p-4">
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
