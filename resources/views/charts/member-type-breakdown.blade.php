<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="lg:col-span-8 bg-white p-5 rounded-xl shadow">
    <p class="font-semibold mb-2 primary-color dashheader flex items-center">
        <span class="material-icons mr-2 text-custom pt-5">bar_chart</span>
        Member Type Breakdown
    </p>

    <div class="relative h-64 sm:h-70 md:h-70 lg:h-70">
        <canvas id="memberTypeChart"></canvas>
    </div>

    <div class="text-right">
        <a href="{{ route('admin-reports') }}" class="text-sm text-[#2C6E49] hover:underline">View All Requests &gt;</a>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    if (window.memberTypeChartInstance) {
        window.memberTypeChartInstance.destroy();
    }

    const ctxMember = document.getElementById('memberTypeChart').getContext('2d');

    const gradient = ctxMember.createLinearGradient(0, 0, ctxMember.canvas.width, 0);
    gradient.addColorStop(0, '#2C6E49');
    gradient.addColorStop(1, '#68b2abad');

    window.memberTypeChartInstance = new Chart(ctxMember, {
        type: 'bar',
        data: {
            labels: @json($sectorLabels),
            datasets: [{
                label: 'Members',
                data: @json($sectorCounts),
                backgroundColor: gradient,
                borderRadius: 4
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
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