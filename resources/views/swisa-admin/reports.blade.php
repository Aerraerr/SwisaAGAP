@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')

<div class="p-4">
    <div class="bg-mainbg px-4 min-h-screen">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Reports</h2>
                <p class="text-sm text-gray-600">Generate detailed insights and summaries of SWISA-AGAP activities.</p>
            </div>
        </div>

        <!-- Tabs + Filters in One Row -->
        <div class="rounded-xl mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <!-- Tabs Navigation -->
            <div class="bg-white rounded-xl shadow p-3">
                <nav class="flex flex-wrap gap-2 text-sm font-medium">
                    <button onclick="showSection('membership')" data-tab="membership" class="tab-btn px-3 py-2 rounded-lg">Membership</button>
                    <button onclick="showSection('requests')" data-tab="requests" class="tab-btn px-3 py-2 rounded-lg">Requests</button>
                    <button onclick="showSection('financial')" data-tab="financial" class="tab-btn px-3 py-2 rounded-lg">Financial</button>
                    {{--<button onclick="showSection('communication')" data-tab="communication" class="tab-btn px-3 py-2 rounded-lg">Communication</button>
                    <button onclick="showSection('engagement')" data-tab="engagement" class="tab-btn px-3 py-2 rounded-lg">Engagement</button>
                    <button onclick="showSection('feedback')" data-tab="feedback" class="tab-btn px-3 py-2 rounded-lg">Feedback</button>--}}
                    <button onclick="showSection('custom')" data-tab="custom" class="tab-btn px-3 py-2 rounded-lg">Custom</button>

                </nav>
            </div>


        </div>

        <!-- Report Sections -->
        <div class="flex-1 bg-mainbg min-h-screen">

            <!-- Membership -->
            <!-- resources/views/swisa-admin/reports.blade.php -->
            @include('swisa-admin.admin-reports.membership', [
                'totalMembers' => \App\Models\UserInfo::count(),
                'newMembers' => \App\Models\UserInfo::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
                'activeMembers' => 0, // your logic…

                'members' => \App\Models\UserInfo::orderBy('created_at', 'desc')->get(),


            ])



            <!-- Requests -->
            @include('swisa-admin.admin-reports.request')

            <!-- Financial -->
            @include('swisa-admin.admin-reports.financial')

            <!-- Communication -->
            @include('swisa-admin.admin-reports.communication')

            <!-- Engagement -->
            @include('swisa-admin.admin-reports.engagement')

            <!-- Feedback -->
            {{--@include('swisa-admin.admin-reports.feedback')--}}

            <!-- Custom -->
            @include('swisa-admin.admin-reports.custom')
        </div>
    </div>
</div>

<script>
    function showSection(id) {
        const sections = document.querySelectorAll('.report-section');
        const tabs = document.querySelectorAll('.tab-btn');

        // Hide all sections
        sections.forEach(section => section.classList.add('hidden'));
        // Show selected section
        document.getElementById(id).classList.remove('hidden');

        // Remove active class from all tabs
        tabs.forEach(tab => tab.classList.remove('active-tab', 'bg-btncolor', 'text-white'));

        // Add active class to the selected tab
        const activeTab = document.querySelector(`.tab-btn[data-tab="${id}"]`);
        if (activeTab) {
            activeTab.classList.add('active-tab', 'bg-btncolor', 'text-white');
        }

        // Save active tab in localStorage
        localStorage.setItem('activeTab', id);
    }

    // Restore last active tab on page load
    document.addEventListener('DOMContentLoaded', () => {
        const lastTab = localStorage.getItem('activeTab') || 'membership';
        showSection(lastTab);
    });
</script>




@endsection
