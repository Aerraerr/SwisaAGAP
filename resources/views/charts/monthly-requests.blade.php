<div class="lg:col-span-3 h-[330px] bg-white p-7 rounded-xl shadow flex flex-col">
    <p class="font-semibold mb-2 primary-color dashheader">Monthly Request Submissions</p>
    
    {{-- Chart Container --}}
    <div class="flex-1">
        <canvas id="monthlyRequestsChart"></canvas>
    </div>
    
    <div class="text-right mt-2">
        <a href="#" class="text-xs text-custom">View &rarr;</a>
    </div>
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
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Requests',
                data: [12, 19, 15, 22, 30, 28, 35],
                borderColor: primaryGreen,
                backgroundColor: accentGreen + '40', // 33 = ~20% opacity
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
});
</script>
@endpush
