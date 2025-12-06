<!-- Add this in your <head> if not already -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="lg:col-span-2 bg-white p-7 rounded-xl shadow">
    <p class="font-semibold mb-4 primary-color dashheader flex items-center">
        <span class="material-icons mr-2 text-custom">pie_chart</span>
        Request Status Overview
    </p>
    
    <!-- Chart Container -->
    <div class="flex items-center justify-center" style="height: 220px;">
        <div class="flex items-center justify-center w-full" style="max-width: 300px; height: 100%;">
            <canvas id="requestStatusChart"></canvas>
        </div>
    </div>

    <div class="mt-4 text-center border-t pt-3">
        <a href="{{ route('grant-request') }}" class="text-sm text-[#2C6E49] hover:underline">View All Request &gt;</a>
    </div>
</div>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('requestStatusChart').getContext('2d');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pending', 'In Process', 'Approved', 'Rejected'],
            datasets: [{
                data: [
                    {{ $pendingRequests}},
                     {{ $inProcessRequests}}, 
                     {{ $approvedRequests}}, 
                     {{ $rejectedRequests}}],
                backgroundColor: [
                    '#2C6E49', // Approved
                    '#4C956C', // In Review
                    '#68B2AB', // Pending
                    '#FD8686'  // Rejected
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // allows full height use
            rotation: -90,
            circumference: 180,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 6,
                        font: { size: 10 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: (context) => `${context.label}: ${context.parsed}`
                    }
                },
                datalabels: {
                    color: '#fff',
                    font: { size: 15, weight: 'bold' },
                    formatter: (value)  => {
                        return value > 0 ? value : null;
                    },
                    anchor: 'center',
                    align: 'end',
                    offset: 5
                }
            },
            layout: {
                padding: { top: 10, bottom: 0 }
            }
        },
        plugins: [ChartDataLabels]
    });
});
</script>
@endpush
