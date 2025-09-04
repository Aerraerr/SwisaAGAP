<!-- Add this in your <head> if not already -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="lg:col-span-5 h-[400px] bg-white p-7 rounded-xl shadow flex flex-col">
    <p class="font-semibold mb-2 primary-color dashheader flex items-center">
        <span class="material-icons mr-2 text-custom">show_chart</span>
        Monthly Request Submissions
    </p>
    
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
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Requests',
                data: [12, 19, 15, 22, 30, 28, 35, 120, 110, 130, 95, 115],
                borderColor: primaryGreen,
                backgroundColor: accentGreen + '40', // 33 = ~20% opacity
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
                enabled: true, // make sure tooltips are active
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': ' + context.parsed.y;
                    }
                }
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
