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
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">Total Grants Released</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">₱ 1.2M</p>
            <p class="text-xs text-gray-400 mt-1">Funds provided to members</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-blue-600">
            <h3 class="text-[#2C6E49] font-bold ">Budget Utilization</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">92%</p>
            <p class="text-xs text-gray-400 mt-1">Of annual budget spent</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-yellow-500">
            <h3 class="text-[#2C6E49] font-bold ">Pending Disbursements</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">₱ 250K</p>
            <p class="text-xs text-gray-400 mt-1">Scheduled for release</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-red-600">
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