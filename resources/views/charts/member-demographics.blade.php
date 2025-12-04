@php
$demographics = app('App\Http\Controllers\ReportMembershipController')->memberDemographic();
@endphp

<div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
    <p class="font-semibold mb-2 primary-color dashheader flex items-center">
        <span class="material-icons mr-2 text-custom">groups</span>
        Member Demographics
    </p>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Section: Gender & Age -->
        <div class="space-y-6">
            <!-- Gender -->
            <div>
                <p class="text-base font-semibold text-gray-600 mb-2">Gender</p>

                <div class="flex items-center mb-3">
                    <span class="material-icons text-blue-600 w-6 h-6">male</span>
                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $demographics['malePercent'] }}%"></div>
                    </div>
                    <span class="text-sm font-medium text-blue-600">{{ $demographics['malePercent'] }}% Male</span>
                </div>

                <div class="flex items-center">
                    <span class="material-icons text-purple-600 w-6 h-6">female</span>
                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-700 h-2 rounded-full" style="width: {{ $demographics['femalePercent'] }}%"></div>
                    </div>
                    <span class="text-sm font-medium text-purple-700">{{ $demographics['femalePercent'] }}% Female</span>
                </div>
            </div>

            <!-- Age -->
            <div>
                <p class="text-base font-semibold text-gray-600 mb-2">Age</p>

                <div class="flex items-center mb-2">
                    <span class="text-sm w-14">18–25</span>
                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $demographics['age18_25'] }}px"></div>
                    </div>
                    <span class="text-sm text-yellow-600 font-medium">{{ $demographics['age18_25'] }}</span>
                </div>

                <div class="flex items-center mb-2">
                    <span class="text-sm w-14">26–30</span>
                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $demographics['age26_30'] }}px"></div>
                    </div>
                    <span class="text-sm text-yellow-600 font-medium">{{ $demographics['age26_30'] }}</span>
                </div>

                <div class="flex items-center">
                    <span class="text-sm w-14">30+</span>
                    <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $demographics['age30plus'] }}px"></div>
                    </div>
                    <span class="text-sm text-yellow-600 font-medium">{{ $demographics['age30plus'] }}</span>
                </div>
            </div>
        </div>

        <!-- Right Section: Gender Pie Chart -->
        <div class="flex items-center justify-center">
            <canvas id="genderChart" class="w-48 h-48 sm:w-56 sm:h-56 md:w-64 md:h-64"></canvas>
        </div>
    </div>
</div>
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('genderChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [{{ $demographics['malePercent'] }}, {{ $demographics['femalePercent'] }}],
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
@endpush
