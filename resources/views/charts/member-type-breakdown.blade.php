<div class="lg:col-span-3 bg-white p-7 rounded-xl shadow">
    <p class="font-semibold mb-2 primary-color dashheader">Member Type Breakdown</p>
    
    <!-- Fixed height wrapper -->
    <div style="height: 250px;">
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
    gradient.addColorStop(0, '#2C6E49');  // Left (original green)
    gradient.addColorStop(1, '#68B2AB');  // Right (lighter green)

    window.memberTypeChartInstance = new Chart(ctxMember, {
        type: 'bar',
        data: {
            labels: ['Farmer', 'Fisher', 'Type 3', 'Type 4', 'Type 5'],
            datasets: [{
                label: 'Members',
                data: [95, 65, 45, 92, 15],
                backgroundColor: gradient,
                borderRadius: 2
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
                    title: { display: true, text: 'COUNT' }
                },
                y: {
                    title: { display: true, text: 'MEMBER TYPE' }
                }
            }
        }
    });
});
</script>

@endpush
