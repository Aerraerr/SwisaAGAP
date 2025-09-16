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
            @include('components.UserTab')
        </div>

        <!-- Tabs + Filters in One Row -->
        <div class="rounded-xl mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <!-- Tabs Navigation -->
            <div class="bg-white rounded-xl shadow p-3">
                <nav class="flex flex-wrap gap-2 text-sm font-medium">
                    <button onclick="showSection(event, 'membership')" class="tab-btn active-tab px-3 py-2 rounded-lg">Membership</button>
                    <button onclick="showSection(event, 'requests')" class="tab-btn px-3 py-2 rounded-lg">Requests</button>
                    <button onclick="showSection(event, 'financial')" class="tab-btn px-3 py-2 rounded-lg">Financial</button>
                    <button onclick="showSection(event, 'communication')" class="tab-btn px-3 py-2 rounded-lg">Communication</button>
                    <button onclick="showSection(event, 'engagement')" class="tab-btn px-3 py-2 rounded-lg">Engagement</button>
                    <button onclick="showSection(event, 'performance')" class="tab-btn px-3 py-2 rounded-lg">Performance</button>
                    <button onclick="showSection(event, 'custom')" class="tab-btn px-3 py-2 rounded-lg">Custom</button>
                </nav>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-xl shadow p-3 flex flex-wrap gap-1 items-center">
                <div class="flex gap-1">
                    <input type="date" class="border rounded-lg px-3 py-2 text-sm">
                    <input type="date" class="border rounded-lg px-3 py-2 text-sm">
                </div>
                <select class="w-60 border rounded-lg px-2 py-2 text-sm">
                    <option>All Categories</option>
                    <option>Farming</option>
                    <option>Fishing</option>
                    <option>Livestock</option>
                </select>
                        <button class="bg-btncolor w-20 text-white px-2 py-2 rounded-lg text-sm hover:bg-btnhover">FILTER</button>
            </div>
        </div>

        <!-- Report Sections -->
        <div class="flex-1 bg-mainbg min-h-screen">

            <!-- Membership -->
            @include('swisa-admin.admin-reports.membership')

            <!-- Requests -->
            @include('swisa-admin.admin-reports.request')

            <!-- Financial -->
            @include('swisa-admin.admin-reports.financial')

            <!-- Communication -->
            @include('swisa-admin.admin-reports.communication')

            <!-- Engagement -->
            @include('swisa-admin.admin-reports.engagement')

            <!-- Performance -->
            @include('swisa-admin.admin-reports.performance')

            <!-- Custom -->
            @include('swisa-admin.admin-reports.custom')
        </div>
    </div>
</div>

<!-- Tab Switching Script -->
<script>
    function showSection(e, id) {
        const sections = document.querySelectorAll('.report-section');
        const tabs = document.querySelectorAll('.tab-btn');

        sections.forEach(section => section.classList.add('hidden'));
        document.getElementById(id).classList.remove('hidden');

        tabs.forEach(tab => tab.classList.remove('active-tab', 'bg-green-600', 'text-white'));
        e.target.classList.add('active-tab', 'bg-green-600', 'text-white');
    }
</script>

<style>
    .tab-btn {
        color: #4B5563; /* gray-600 */
    }
    .tab-btn.active-tab {
        background-color: #4C956C; /* green-600 */
        color: #fff;
    }
</style>
@endsection
