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
                <span class="w-3 h-1.5 bg-green-600 inline-block rounded"></span>Completed
            </span>
            <span class="flex items-center gap-1 text-sm">
                <span class="w-3 h-1.5 bg-red-500 inline-block rounded"></span>Rejected
            </span>

            <select x-model="view" @change="updateChart()" 
                class="ml-2 border rounded-md text-sm px-3 py-1 w-28">
                <template x-for="year in years" :key="year">
                    <option :value="year" x-text="year"></option>
                </template>
            </select>
        </div>
    </div>

    <!-- If empty -->
    <div x-show="noData" class="h-64 flex items-center justify-center text-gray-500 text-sm">
        No data available for this year.
    </div>

    <!-- Chart -->
    <div x-show="!noData" class="h-64 p-3">
        <canvas id="requestChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
function requestChart() {
    return {
        chart: null,
        view: new Date().getFullYear(),
        years: [],
        noData: false,

        initChart() {
            this.generateYears();
            this.loadChartData();
        },

        generateYears() {
            const current = new Date().getFullYear();
            for (let y = current; y >= 2020; y--) {
                this.years.push(y);
            }
        },

        loadChartData() {
            fetch(`/reports/request/chart?year=${this.view}`)
                .then(res => res.json())
                .then(data => {
                    const hasData = data.some(d => d.completed > 0 || d.rejected > 0);
                    this.noData = !hasData;

                    if (this.noData) {
                        if (this.chart) {
                            this.chart.destroy();
                            this.chart = null;
                        }
                        return;
                    }

                    if (!this.chart) {
                        this.createChart(data);
                    } else {
                        this.updateExistingChart(data);
                    }
                })
                .catch(err => console.error("Chart Load Error:", err));
        },

        createChart(data) {
            const ctx = document.getElementById('requestChart').getContext('2d');

            this.chart = new Chart(ctx, {
                type: 'line',
                data: this.formatData(data),
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    tension: 1, // smoother curves
                    animation: {
                        duration: 1500,
                        easing: 'easeInOutCubic'
                    },
                    animations: {
                        x: {
                            type: 'number',
                            easing: 'easeInOutCubic',
                            from: NaN,
                            delay(ctx) {
                                return ctx.dataIndex * 150; // stagger points
                            }
                        },
                        y: {
                            type: 'number',
                            easing: 'easeInOutCubic',
                            delay(ctx) {
                                return ctx.dataIndex * 150; // stagger points
                            }
                        }
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grace: '10%'
                        }
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    }
                }
            });
        },

        updateExistingChart(data) {
            this.chart.destroy();
            this.createChart(data);
        },

        formatData(data) {
            return {
                labels: data.map(d => d.month),
                datasets: [
                    {
                        label: 'Completed',
                        data: data.map(d => d.completed),
                        borderColor: '#16a34a',
                        backgroundColor: 'rgba(22,163,74,0.2)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.5,
                    },
                    {
                        label: 'Rejected',
                        data: data.map(d => d.rejected),
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239,68,68,0.1)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.5,
                    }
                ]
            };
        },

        updateChart() {
            this.loadChartData();
        }
    };
}
</script>
