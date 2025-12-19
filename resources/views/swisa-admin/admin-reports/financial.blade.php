@php
    $controller = app('App\Http\Controllers\ReportFinancialController');

    $totalGrantsReleased = $controller->totalGrantsReleased() ?? 0;
    $combinedTotalValue = $controller->overAllBudget() ?? 0;
    $budgetUtilization = $controller->budgetUtilization() ?? 0;
    $pendingDisbursements = $controller->pendingDisbursements() ?? 0;

    // Get recent transactions
    $transactions = $controller->recentTransactions() ?? [];

    // Format numbers
    $totalGrantsReleasedFormatted = number_format($totalGrantsReleased, 2);
    $combinedTotal = number_format($combinedTotalValue, 2);
    $pendingDisbursementsFormatted = number_format($pendingDisbursements, 2);

        $chartData = [
        'overall' => (float) $combinedTotalValue,
        'released' => (float) $totalGrantsReleased,
        'utilization' => (float) $budgetUtilization, // percentage
        'pending' => (float) $pendingDisbursements
    ];
@endphp


<section id="financial" class="report-section hidden">
    <!-- Header with Export Options -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <div>
            <h2 class="text-2xl font-bold text-[#2C6E49]">Financial Reports</h2>
            <p class="text-gray-500 text-sm">Monitor grants, disbursements, and budget utilization</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('financial.export.csv') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                <i class="material-icons text-sm">file_download</i> Export CSV
            </a>

            <a href="{{ route('financial.export.excel') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                <i class="material-icons text-sm">file_download</i> Export Excel
            </a>

            <a href="{{ route('financial.export.pdf') }}" target="_blank"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                <i class="material-icons text-sm">picture_as_pdf</i> Export PDF
            </a>

        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-4 gap-2 mb-6">
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">Overall Budget</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">₱ {{ $combinedTotal }}</p>
            <p class="text-xs text-gray-400 mt-1">Funds allocated for all grants</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">Total Grants Released</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">₱ {{ $totalGrantsReleasedFormatted }}</p>
            <p class="text-xs text-gray-400 mt-1">Funds provided to members</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-blue-600">
            <h3 class="text-[#2C6E49] font-bold ">Budget Utilization</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $budgetUtilization }}%</p>
            <p class="text-xs text-gray-400 mt-1">Of annual budget spent</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-yellow-500">
            <h3 class="text-[#2C6E49] font-bold ">Pending Disbursements</h3>
            <p class="text-3xl font-bold text-yellow-500 mt-2">₱ {{ $pendingDisbursementsFormatted }}</p>
            <p class="text-xs text-gray-400 mt-1">Scheduled for release</p>
        </div>
    </div>



    <!-- Financial Table -->
    <div class="bg-white rounded-2xl shadow p-4 mb-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
            <h3 class="text-lg font-semibold text-[#2C6E49]">Recent Financial Transactions</h3>

            <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                <!-- Search Input -->
                <input 
                    id="searchInput" 
                    type="text" 
                    placeholder="Search transactions..."
                    class="w-full sm:w-64 p-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm placeholder-gray-400 transition-all duration-200"
                >

                <!-- Type Filter -->
                <select 
                    id="typeFilter"
                    class="w-full sm:w-48 p-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm transition-all duration-200"
                >
                    <option value="">Filter by Type</option>
                    <option value="Grant Request">Request</option>
                    <option value="Grant Allocation">Allocation</option>
                    <option value="Disbursement">Disbursement</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
                <table id="transactionsTable" class="w-full text-md border-collapse">

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
                    @php
                        $transactions = collect($transactions)->sortByDesc('date');
                    @endphp

                    @forelse ($transactions as $t)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-2">{{ $t['transaction_id'] }}</td>
                            <td class="p-2 type-column">{{ $t['type'] }}</td>
                            <td class="p-2 font-semibold 
                                @if($t['type'] === 'Grants') text-green-600
                                @elseif($t['type'] === 'Equipment') text-red-600
                                @else text-gray-600
                                @endif
                            ">
                                ₱ {{ number_format($t['amount'], 2) }}
                            </td>

                            <td class="p-2">{{ $t['date'] }}</td>

                            <td class="p-2 font-semibold
                                @if($t['status'] === 'Released') text-green-600
                                @elseif($t['status'] === 'Pending') text-yellow-400
                                @elseif($t['status'] === 'Approved') text-blue-600
                                @elseif($t['status'] === 'Rejected') text-red-600
                                @elseif($t['status'] === 'To be review') text-gray-600
                                @else text-gray-600
                                @endif
                            ">
                                {{ $t['status'] }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4 text-gray-500">
                                No recent transactions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>


            </table>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 mb-6" style="height: 450px;">
        <h3 class="text-lg font-semibold mb-4 text-[#2C6E49]">Budget Allocation Overview</h3>
        <canvas id="budgetOverviewChart"></canvas>
    </div>

</section>





<script>
document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchInput");
    const typeFilter = document.getElementById("typeFilter");
    const rows = document.querySelectorAll("#transactionsTable tbody tr");

    function filterTable() {
        const search = searchInput.value.toLowerCase();
        const type = typeFilter.value;

        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            const rowType = row.querySelector(".type-column")?.innerText.trim();

            const matchesSearch = rowText.includes(search);
            const matchesType = type === "" || rowType === type;

            row.style.display = (matchesSearch && matchesType) ? "" : "none";
        });
    }

    searchInput.addEventListener("keyup", filterTable);
    typeFilter.addEventListener("change", filterTable);
});
</script>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const chartData = @json($chartData);
    const ctx = document.getElementById('budgetOverviewChart').getContext('2d');

    if (window.budgetOverviewChartInstance) {
        window.budgetOverviewChartInstance.destroy();
    }

    const labels = [
        'Overall Budget',
        'Total Grants Released',
        'Budget Utilization (%)',
        'Pending Disbursements'
    ];
    const values = [
        chartData.overall,
        chartData.released,
        chartData.utilization,
        chartData.pending
    ];
    const colors = ['#2C6E49', '#4CAF50', '#1E88E5', '#FFC107'];

    window.budgetOverviewChartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,   // each bar has its own label
            datasets: [{
                label: 'Amount',
                data: values,
                backgroundColor: colors,
                borderRadius: 8,
                barThickness: 40,
                maxBarThickness: 50,
                hoverBackgroundColor: colors.map(c => c + 'cc') // slight transparency on hover
            }]
        },
        options: {
            indexAxis: 'y', // horizontal bars
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: { top: 20, bottom: 60, left: 10, right: 10 } },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 20,
                        padding: 15,
                        font: { size: 12, weight: '600' }
                    }
                },
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    offset: 10,
                    formatter: function(value, context) {
                        return context.chart.data.labels[context.dataIndex] === 'Budget Utilization (%)'
                            ? value.toFixed(2) + '%'
                            : '₱ ' + Number(value).toLocaleString();
                    },
                    font: { weight: 'bold', size: 12 },
                    color: '#2C6E49'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.chart.data.labels[context.dataIndex] === 'Budget Utilization (%)'
                                ? context.dataset.data[context.dataIndex].toFixed(2) + '%'
                                : '₱ ' + Number(context.dataset.data[context.dataIndex]).toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: { drawTicks: false, drawBorder: false, color: '#f0f0f0' },
                    ticks: { font: { size: 11 }, padding: 5 }
                },
                y: {
                    ticks: { font: { size: 12 } },
                    grid: { drawTicks: false, drawBorder: false, color: 'transparent' },
                    categoryPercentage: 0.5, // smaller = more gap between bars
                    barPercentage: 0.9      // bar thickness relative to category
                }
            }
        },
        plugins: [ChartDataLabels]
    });
});
</script>








