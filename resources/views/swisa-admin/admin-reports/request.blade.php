@php
    $controller = app('App\Http\Controllers\ReportRequestController');
    $recentRequests = $controller->recentGrantRequests() ?? [];
@endphp
<section id="requests" class="report-section hidden ">

    <!-- Header with Export Options -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <div>
            <h2 class="text-2xl font-bold text-[#2C6E49]">Requests Reports</h2>
            <p class="text-gray-500 text-sm">Track requests and their approval status</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('requests.export.csv') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                <i class="material-icons text-sm">file_download</i> Export CSV
            </a>
            <a href="{{ route('requests.export.excel') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                <i class="material-icons text-sm">file_download</i> Export Excel
            </a>
            <a href="{{ route('requests.export.pdf') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                <i class="material-icons text-sm">picture_as_pdf</i> Export PDF
            </a>
        </div>

    </div>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-6">
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold">Completed Requests</h3>
            <p id="completedRequests" class="text-3xl font-bold text-green-600 mt-2">0</p>
            <p class="text-xs text-gray-400 mt-1">Total requests that have been completed</p>
        </div>

        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold">Total Requests</h3>
            <p id="totalRequests" class="text-3xl font-bold text-green-600 mt-2">0</p>
            <p class="text-xs text-gray-400 mt-1">All submitted requests</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-blue-600">
            <h3 class="text-[#2C6E49] font-bold">Approved Requests</h3>
            <p id="approvedRequests" class="text-3xl font-bold text-blue-600 mt-2">0</p>
            <p id="approvalRate" class="text-xs text-gray-400 mt-1">0% approval rate</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-yellow-500">
            <h3 class="text-[#2C6E49] font-bold">Pending Requests</h3>
            <p id="pendingRequests" class="text-3xl font-bold text-yellow-500 mt-2">0</p>
            <p class="text-xs text-gray-400 mt-1">Awaiting review</p>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
            @include('charts.request-management')
    </div>
    <!-- Requests Table -->
    <div class="bg-white rounded-2xl shadow p-4">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center  gap-3 p-4">
            <h3 class="text-lg font-semibold">Recent Requests</h3>
            <div class="flex gap-1">
                <input type="text" placeholder="Search requests..." class="p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                <select class="p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Filter by Status</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="denied">Denied</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto p-4">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-snbg text-[#2C6E49]">
                        <th class="text-left p-2">Request ID</th>
                        <th class="text-left p-2">Item</th>
                        <th class="text-left p-2">Requester</th>
                        <th class="text-left p-2">Date</th>
                        <th class="text-left p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentRequests as $r)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-2">{{ $r['request_id'] }}</td>
                            <td class="p-2">{{ $r['grant_title'] }}</td>
                            <td class="p-2">{{ $r['requester'] }}</td>
                            <td class="p-2">{{ $r['date'] }}</td>
                            <td class="p-2 font-semibold 
                                @if($r['status'] === 'Approved' || $r['status'] === 'Completed') text-green-600
                                @elseif($r['status'] === 'Pending' || $r['status'] === 'To be review') text-yellow-600
                                @elseif($r['status'] === 'Rejected' || $r['status'] === 'Denied') text-red-600
                                @else text-gray-600
                                @endif
                            ">
                                {{ $r['status'] }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4 text-gray-500">
                                No recent grant requests found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</section>



<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch("{{ route('requests.stats') }}")
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(data => {
            const totalEl = document.getElementById('totalRequests');
            const approvedEl = document.getElementById('approvedRequests');
            const approvalRateEl = document.getElementById('approvalRate');
            const pendingEl = document.getElementById('pendingRequests');
            const completedEl = document.getElementById('completedRequests');

            if (totalEl) totalEl.innerText = data.total ?? 0;
            if (approvedEl) approvedEl.innerText = data.approved ?? 0;
            if (approvalRateEl) approvalRateEl.innerText = (data.approvalRate ?? 0) + '% Approval Rate';
            if (pendingEl) pendingEl.innerText = data.pending ?? 0;
            if (completedEl) completedEl.innerText = data.completed ?? 0;
        })
        .catch(err => console.error('Error fetching request stats:', err));
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#requests input[type="text"]');
    const statusSelect = document.querySelector('#requests select');
    const table = document.querySelector('#requests table tbody');
    const rows = Array.from(table.querySelectorAll('tr'));

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilter = statusSelect.value.toLowerCase();

        rows.forEach(row => {
            const requestId = row.cells[0]?.innerText.toLowerCase() ?? '';
            const item = row.cells[1]?.innerText.toLowerCase() ?? '';
            const requester = row.cells[2]?.innerText.toLowerCase() ?? '';
            const date = row.cells[3]?.innerText.toLowerCase() ?? '';
            const status = row.cells[4]?.innerText.toLowerCase() ?? '';

            // Check search
            const matchesSearch = requestId.includes(searchTerm) || 
                                  item.includes(searchTerm) || 
                                  requester.includes(searchTerm) || 
                                  date.includes(searchTerm);

            // Check status filter
            let matchesStatus = true;
            if (statusFilter) {
                switch(statusFilter) {
                    case 'approved':
                        matchesStatus = status === 'approved' || status === 'completed';
                        break;
                    case 'pending':
                        matchesStatus = status === 'pending' || status === 'to be review';
                        break;
                    case 'denied':
                        matchesStatus = status === 'rejected' || status === 'denied';
                        break;
                    default:
                        matchesStatus = true;
                }
            }

            // Show or hide row
            row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    statusSelect.addEventListener('change', filterTable);
});
</script>


