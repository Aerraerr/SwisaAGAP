<div 
    x-data="requestChart()" 
    x-init="initChart()" 
    class="col-span-12 lg:col-span-9 bg-white rounded-xl shadow p-2 pt-1"
>
    <!-- Header -->
    <div class="flex justify-between items-center mb-2 p-5">
        <h2 class="text-lg font-bold text-[#2C6E49]">Request Over Time</h2>
        <div class="flex items-center gap-3">
            <span class="flex items-center gap-1 text-sm">
                <span class="w-3 h-1.5 bg-green-600 inline-block rounded"></span>
                Approved
            </span>
            <span class="flex items-center gap-1 text-sm">
                <span class="w-3 h-1.5 bg-red-500 inline-block rounded"></span>
                Denied
            </span>
            <select 
                x-model="view" 
                @change="updateChart()" 
                class="ml-2 border rounded-md text-sm px-2 py-1"
            >
                <option value="monthly">Monthly View</option>
                <option value="quarterly">Quarterly View</option>
                <option value="yearly">Yearly View</option>
            </select>
        </div>
    </div>

    <!-- Chart -->
    <div class="h-64 p-3">
        <canvas id="requestChart"></canvas>
    </div>
</div>

<!-- Alpine + Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
function requestChart() {
    return {
        chart: null,
        view: 'monthly',
        datasets: {
            monthly: [
                { month: "Jan", approved: 40, denied: 90 },
                { month: "Feb", approved: 70, denied: 50 },
                { month: "Mar", approved: 130, denied: 40 },
                { month: "Apr", approved: 90, denied: 120 },
                { month: "May", approved: 75, denied: 110 },
                { month: "Jun", approved: 110, denied: 150 },
                { month: "Jul", approved: 150, denied: 100 },
                { month: "Aug", approved: 160, denied: 70 },
                { month: "Sept", approved: 310, denied: 180 },
                { month: "Oct", approved: 250, denied: 160 },
                { month: "Nov", approved: 280, denied: 140 },
                { month: "Dec", approved: 220, denied: 400 },
            ],
            quarterly: [
                { month: "Q1", approved: 240, denied: 180 },
                { month: "Q2", approved: 280, denied: 210 },
                { month: "Q3", approved: 400, denied: 250 },
                { month: "Q4", approved: 360, denied: 500 },
            ],
            yearly: [
                { month: "2022", approved: 1200, denied: 800 },
                { month: "2023", approved: 1500, denied: 950 },
                { month: "2024", approved: 1800, denied: 1300 },
            ],
        },
        initChart() {
            const ctx = document.getElementById('requestChart').getContext('2d');
            this.chart = new Chart(ctx, {
                type: 'line',
                data: this.formatData(this.datasets[this.view]),
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    tension: 0.4,
                    interaction: {
                        mode: 'index',   // Show all dataset values at the hovered index
                        intersect: false // Don’t require direct hover on the line
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.formattedValue}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: { grid: { color: '#f3f4f6' } },
                        y: { grid: { color: '#f3f4f6' } }
                    }
                }

            });
        },
        formatData(data) {
            return {
                labels: data.map(d => d.month),
                datasets: [
                    {
                        label: 'Approved',
                        data: data.map(d => d.approved),
                        borderColor: '#16a34a',
                        backgroundColor: 'rgba(22,163,74,0.2)',
                        fill: true,
                        borderWidth: 3,
                    },
                    {
                        label: 'Denied',
                        data: data.map(d => d.denied),
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239,68,68,0.1)',
                        fill: false,
                        borderWidth: 2,
                    }
                ]
            };
        },
        updateChart() {
            this.chart.data = this.formatData(this.datasets[this.view]);
            this.chart.update();
        }
    };
}
</script>
