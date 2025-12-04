<!-- resources/views/swisa-admin/admin-reports/membership.blade.php -->

@php
    $totalMembers = $totalMembers ?? 0;
    $newMembers = $newMembers ?? 0;
    $activeMembers = $activeMembers ?? 0;
    $members = $members ?? collect();

        $malePercent = $malePercent ?? 0;
    $femalePercent = $femalePercent ?? 0;
    $age18_25_percent = $age18_25_percent ?? 0;
    $age26_30_percent = $age26_30_percent ?? 0;
    $age30plus_percent = $age30plus_percent ?? 0;
@endphp

<section id="membership" class="report-section block">
    <!-- Header with Export Options -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <div>
            <h2 class="text-2xl font-bold text-[#2C6E49]">Membership Reports</h2>
            <p class="text-gray-500 text-sm">Overview of registered members, and demographics</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('membership.export.csv') }}" 
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
            <i class="material-icons text-sm">file_download</i> Export CSV
            </a>

            <a href="{{ route('membership.export.excel') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                <i class="material-icons text-sm">file_download</i> Export Excel
            </a>

            <a href="{{ route('membership.export.pdf') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm shadow flex items-center gap-1">
                <i class="material-icons text-sm">picture_as_pdf</i> Export PDF
            </a>

        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">Total Members</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalMembers }}</p>
            <p class="text-xs text-gray-400 mt-1">All registered members</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">New Members (This Month)</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $newMembers }}</p>
            <p class="text-xs text-gray-400 mt-1">
                As of {{ \Carbon\Carbon::now()->format('F Y') }}
            </p>
        </div>
        @php
        $activeData = app('App\Http\Controllers\ReportMembershipController')->activeMembers();
        @endphp

        <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">Active Members</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $activeData['activeMembersPercent'] }}%</p>
            <p class="text-xs text-gray-400 mt-1">Based on logins and activity</p>
        </div>

    </div>

    <!-- Charts Row (optional) -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
        @includeIf('charts.member-type-breakdown2')
        @includeIf('charts.member-demographics')
    
    </div>

    <!-- Members Table -->
    <div class="bg-white rounded-2xl shadow p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-[#2C6E49] ">Registered Members</h3>
            <input type="text" placeholder="Search members..." class="w-[500px] p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
        </div> 
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-snbg text-[#2C6E49]">
                        <th class="text-left p-5">ID Number</th>
                        <th class="text-left p-5">Name</th>
                        <th class="text-left p-5">Address</th>
                        <th class="text-left p-5">Email</th>
                        <th class="text-left p-5">Contact Number</th>
                        <th class="text-left p-5">Type</th>
                        <th class="text-left p-5">Registered Since</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $member)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-5">{{ $member->user->formatted_id ?? '-' }}</td>
                                <td class="p-5">{{ $member->name ?? trim($member->fname . ' ' . $member->mname . ' ' . $member->lname) ?: '-' }}</td>
                                <td class="p-5">
                                    {{ $member->barangay ?? '-' }}
                                    {{ $member->city ? ', ' . $member->city : '' }}
                                    {{ $member->zone ? ', Zone ' . $member->zone : '' }}
                                    {{ $member->house_no ? ', #' . $member->house_no : '' }}
                                </td>

                                <td class="p-5">{{ $member->email ?? '-' }}</td>
                                <td class="p-5">{{ $member->phone_no?? '-' }}</td>
                                <td class="p-5">{{ $member->farmer_type ?? '-' }}</td>

                                <td class="p-5">{{ optional($member->created_at)->format('F d, Y') ?? '-' }}</td>
                            </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-5 text-center text-gray-500">No members found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

