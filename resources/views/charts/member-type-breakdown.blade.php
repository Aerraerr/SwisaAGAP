<!-- Add this in your <head> if not already -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="lg:col-span-3 bg-white p-5 rounded-xl shadow">
    <p class="font-semibold mb-2 primary-color dashheader flex items-center">
        <span class="material-icons mr-2 text-custom">bar_chart</span>
        Member Type Breakdown
    </p>
    
    <!-- Responsive chart wrapper -->
    <div class="relative h-64 sm:h-70 md:h-70 lg:h-70">
        <canvas id="memberTypeChart"></canvas>
    </div>

    <div class="text-right mt-2">
        <a href="#" class="text-xs text-custom">View &rarr;</a>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    if (window.memberTypeChartInstance) {
        window.memberTypeChartInstance.destroy();
    }

    const ctxMember = document.getElementById('memberTypeChart').getContext('2d');

    // Create a horizontal gradient (left → right)
    const gradient = ctxMember.createLinearGradient(0, 0, ctxMember.canvas.width, 0);
    gradient.addColorStop(0, '#2C6E49');
    gradient.addColorStop(1, '#68b2abad');

    window.memberTypeChartInstance = new Chart(ctxMember, {
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
                x: {
                    beginAtZero: true,
                    title: { display: true, text: 'COUNT' },
                    ticks: { font: { size: 10 } }
                },
                y: {
                    title: { display: true, text: 'MEMBER TYPE' },
                    ticks: { font: { size: 10 } }
                }
            }
        }
    });
});
</script>
@endpush
