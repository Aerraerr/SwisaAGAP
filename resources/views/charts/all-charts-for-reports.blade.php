<!-- MEMBERSHIP -->
<div class="mb-10">
    <div class="mb-3">
        <h2 class="text-2xl font-bold text-[#2C6E49]">Membership</h2>
        <p class="text-gray-500 text-sm">Detailed insights on members, registrations, and engagement trends</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-3">
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold">Total Members</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">1,540</p>
            <p class="text-xs text-gray-400 mt-1">All registered members</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-yellow-500">
            <h3 class="text-[#2C6E49] font-bold">New Members (This Month)</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">35</p>
            <p class="text-xs text-gray-400 mt-1">Compared to last month: +12%</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-blue-600">
            <h3 class="text-[#2C6E49] font-bold">Active Members</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">85%</p>
            <p class="text-xs text-gray-400 mt-1">Based on logins and activity</p>
        </div>
    </div>

    <!-- Two charts in one row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 w-full mb-5">
        
        <!-- ============= FOR MEMBERSHIP TAB ===============-->
        <div class="bg-white p-5 rounded-xl shadow">
            <h3 class="font-semibold mb-3 text-gray-700 flex items-center">
                <span class="material-icons mr-2 text-custom">bar_chart</span>
                Member Type Breakdown
            </h3>
            
            <!-- Membership chart -->
            <div class="relative h-64 md:h-72 lg:h-80">
                <canvas id="memberTypeChartMembership"></canvas>
            </div>

            <div class="text-right mt-2">
                <a href="#" class="text-xs text-custom">View &rarr;</a>
            </div>
        </div>

        <!-- ============= FOR DEMOGRAPHICS TAB ===============-->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold mb-3 text-gray-700 flex items-center">
                <span class="material-icons mr-2 text-custom">groups</span>
                Member Demographics
            </h3>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Section: Gender & Age -->
                <div class="space-y-6">
                    <!-- Gender -->
                    <div>
                        <p class="text-base font-semibold text-gray-600 mb-2">Gender</p>

                        <div class="flex items-center mb-3">
                            <span class="material-icons text-blue-600 w-6 h-6">male</span>
                            <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 78%"></div>
                            </div>
                            <span class="text-sm font-medium text-blue-600">78% Male</span>
                        </div>

                        <div class="flex items-center">
                            <span class="material-icons text-purple-600 w-6 h-6">female</span>
                            <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                                <div class="bg-purple-700 h-2 rounded-full" style="width: 22%"></div>
                            </div>
                            <span class="text-sm font-medium text-purple-700">22% Female</span>
                        </div>
                    </div>

                    <!-- Age -->
                    <div>
                        <p class="text-base font-semibold text-gray-600 mb-2">Age</p>
                        <div class="flex items-center mb-2">
                            <span class="text-sm w-14">18–25</span>
                            <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 70%"></div>
                            </div>
                            <span class="text-sm text-yellow-600 font-medium">70%</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-sm w-14">26–30</span>
                            <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 45%"></div>
                            </div>
                            <span class="text-sm text-yellow-600 font-medium">45%</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm w-14">30+</span>
                            <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-400 h-2 rounded-full" style="width: 30%"></div>
                            </div>
                            <span class="text-sm text-yellow-600 font-medium">30%</span>
                        </div>
                    </div>
                </div>

                <!-- Right Section: Gender Pie Chart -->
                <div class="flex items-center justify-center">
                    <canvas id="genderChartAll" class="w-48 h-48 sm:w-56 sm:h-56 md:w-64 md:h-64"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- REQUEST -->
<div class="request">
    <div class="mb-3">
        <h2 class="text-2xl font-bold text-[#2C6E49]">Request</h2>
        <p class="text-gray-500 text-sm">Detailed insights on members, registrations, and engagement trends</p>
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
        <div 
            x-data="requestCharAll()" 
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

    </div>
</div>

<script>
    //====================   FOR MEMBERSHIP TAB   ===================================
    // 1. MEMBER TYPE BREAKDOWN
    document.addEventListener("DOMContentLoaded", function () {
        const ctxMember = document.getElementById('memberTypeChartMembership');
        if (!ctxMember) return; // stop if canvas not found

        const chartCtx = ctxMember.getContext('2d');

        // Gradient
        const gradient = chartCtx.createLinearGradient(0, 0, chartCtx.canvas.width, 0);
        gradient.addColorStop(0, '#2C6E49');
        gradient.addColorStop(1, '#68b2abad');

        new Chart(chartCtx, {
            type: 'bar',
            data: {
                labels: ['Farmer', 'Fisher', 'Type 3', 'Type 4', 'Type 5'],
                datasets: [{
                    label: 'Members',
                    data: [95, 65, 45, 92, 15],
                    backgroundColor: gradient,
                    borderRadius: 4
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { beginAtZero: true, title: { display: true, text: 'COUNT' } },
                    y: { title: { display: true, text: 'MEMBER TYPE' } }
                }
            }
        });
    });

    // 2. MEMBER DEMOGRAPHICS
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('genderChartAll').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    data: [78, 22],
                    backgroundColor: ['#3b82f6', '#6b21a8'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 12 },
                            color: '#374151'
                        }
                    }
                }
            }
        });
    });
</script>

<script>
        //====================   FOR REQUEST TAB   ===================================
    function requestChartAll() {
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
        initChartAll() {
            const ctx = document.getElementById('requestChartAll').getContext('2d');
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