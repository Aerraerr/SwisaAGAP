<div class="lg:col-span-2  bg-white rounded-lg shadow-md p-6">
    <h3 class="text-lg font-bold text-customIT mb-4">Member Demographics</h3>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Section: Gender & Age -->
        <div class="space-y-6">
            <!-- Gender -->
            <div>
                <p class="text-sm font-semibold text-gray-600 mb-2">Gender</p>
                <div class="flex items-center mb-3">
                    <span class="w-6 h-6 text-blue-600">👨</span>
                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 78%"></div>
                    </div>
                    <span class="text-xs font-medium text-blue-600">78% Male</span>
                </div>
                <div class="flex items-center">
                    <span class="w-6 h-6 text-purple-600">👩</span>
                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-700 h-2 rounded-full" style="width: 22%"></div>
                    </div>
                    <span class="text-xs font-medium text-purple-700">22% Female</span>
                </div>
            </div>

            <!-- Age -->
            <div>
                <p class="text-sm font-semibold text-gray-600 mb-2">Age</p>
                <div class="flex items-center mb-2">
                    <span class="text-xs w-12">18–25</span>
                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 70%"></div>
                    </div>
                    <span class="text-xs text-yellow-600 font-medium">70%</span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="text-xs w-12">26–30</span>
                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 70%"></div>
                    </div>
                    <span class="text-xs text-yellow-600 font-medium">70%</span>
                </div>
                <div class="flex items-center">
                    <span class="text-xs w-12">30+</span>
                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 70%"></div>
                    </div>
                    <span class="text-xs text-yellow-600 font-medium">70%</span>
                </div>
            </div>
        </div>

        <!-- Right Section: Gender Pie Chart -->
        <div class="flex items-center justify-center">
            <canvas id="genderChart" class="w-40 h-40"></canvas>
        </div>
    </div>
</div>
<!-- Chart.js Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('genderChart').getContext('2d');
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
