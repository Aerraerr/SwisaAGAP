<!-- Add this in your <head> if not already -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="lg:col-span-8 h-[400px] bg-white p-7 rounded-xl shadow flex flex-col">
    <p class="font-semibold mb-2 primary-color dashheader flex items-center">
        <span class="material-icons mr-2 text-custom">show_chart</span>
        Monthly Request Submissions
    </p>
    
    {{-- Chart Container --}}
    <div class="flex-1">
        <canvas id="monthlyRequestsChart"></canvas>
    </div>
    
    @if(Auth()->user()->role_id == 2)
        <div class="text-right">
            <a href="{{ route('grant-request') }}" class="text-sm text-[#2C6E49] hover:underline">View All Requests &gt;</a>
        </div>
    @elseif(Auth()->user()->role_id == 3)
        <div class="text-right">
            <a href="{{ route('admin-reports') }}" class="text-sm text-[#2C6E49] hover:underline">View Reports &gt;</a>
        </div>
    @endif
</div>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const primaryGreen = getComputedStyle(document.documentElement)
        .getPropertyValue('--primary-green').trim();
    const accentGreen = getComputedStyle(document.documentElement)
        .getPropertyValue('--icon-color').trim();

    const ctx = document.getElementById('monthlyRequestsChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                     'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Requests',
                data: @json($monthlyData),
                borderColor: primaryGreen,
                backgroundColor: accentGreen + '40',
                fill: true,
                tension: 0.2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    enabled: true,
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
</script>
@endpush
