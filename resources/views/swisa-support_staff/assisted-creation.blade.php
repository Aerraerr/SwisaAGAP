@extends('layouts.app')
@section('content')
<div class="p-4">
    <div class="bg-mainbg px-2">
    <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Assist Member</h2>
                <p class="text-sm text-gray-600">
                    Manage member information and initiate assistance for approved grant requests.
                </p>
            </div>
        </div>

    @include('components.breadcrumbs', ['breadcrumbName' => Route::currentRouteName()])
    
    <!-- Stats Cards for Initiatives & Events -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Initiatives -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
            <h3 class="text-[#2C6E49] font-bold ">Total User</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $members->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">Registered members in the system</p>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
            <h3 class="text-[#2C6E49] font-bold ">Total Grants</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $grants->where('end_at', '>=', now())->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">Grants in the system</p>
        </div>

        <!-- Completed Events -->
        <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
            <h3 class="text-[#2C6E49] font-bold ">Total Grant Request</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2"> {{ $application->where('application_type', 'Grant Application')->count() }}</p>
            <p class="text-xs text-gray-400 mt-1">in the system</p>
        </div>
    </div>
    
    <div class="bg-white p-5 rounded-xl shadow-xl">
        <div class="mt-4">

        @include('components.filters', ['targetTableId' => 'assist-main-table', 'modalId' => 'assistRegisterModal'])

        <!-- for table/list front -->
        <div class="tab-pane">
                <div class="overflow-auto-visible h-auto shadow-lg">
                    <table class="min-w-full bg-white border-spacing-y-1">
                    <thead class="bg-snbg border border-gray-100 px-8">
                        <tr class="text-customIT text-left ">
                            <th class="px-4 py-3 text-xs font-medium">ID</th>
                            <th class="px-4 py-3 text-xs font-medium">NAME</th>
                            <th class="px-4 py-3 text-xs font-medium">NUMBER</th>
                            <th class="px-4 py-3 text-xs font-medium">EMAIL</th>
                            <th class="px-4 py-3 text-xs font-medium">DATE CREATED</th>
                            <th class="px-4 py-3 text-xs font-medium">CREDITS</th>
                            <th class="px-4 py-3 text-xs font-medium">MEMBERSHIP STATUS</th>
                            <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="assist-main-table">
                        @forelse($members as $member)
                            <tr class="border border-gray-300 hover:bg-gray-100">
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->formatted_id}}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->first_name}} {{ $member->middle_name}} {{ $member->last_name}} {{ $member->suffix_name}}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->phone_no ?? '-'}}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->email}}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->created_at->format('F d Y')}}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $member->creditScore->score ?? '0'}}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">
                                    @php
                                        $membershipApps = $member->applications->where('application_type', 'Membership');
                                    @endphp

                                    @if($membershipApps->count() > 0)
                                        @if($membershipApps->where('status_id', 3)->isNotEmpty())
                                            <span class="inline-block text-xs font-medium text-white text-center bg-pending px-3 py-1 rounded-full">Pending</span>
                                        @elseif($membershipApps->where('status_id', 4)->isNotEmpty())
                                            <span class="inline-block text-xs font-medium text-white text-center bg-approved px-3 py-1 rounded-full">Approved</span>
                                        @elseif($membershipApps->where('status_id', 6)->isNotEmpty())
                                            <span class="inline-block text-xs font-medium text-white text-center bg-rejected px-3 py-1 rounded-full">Rejected</span>
                                        @endif
                                    @else
                                        <span class="text-gray-700 font-medium">Not Applied</span>
                                    @endif
                                </td>

                                <td class="pl-4 py-2 text-sm">
                                    <div class="relative" x-data="{ show: false }" @click.away="show = false">
                                        <button @click="show = !show"  class="border border-gray-300 rounded-sm pl-2">
                                            <img src="{{ asset('images/dot-menu.svg') }}"
                                            class="w-5 h-5 rounded-sm mr-2"/>
                                        </button>
                                        <!-- The Popover Menu, controlled by Alpine.js -->
                                        <div x-show="show" class="absolute top-full right-0 z-10 w-56 bg-white rounded-lg shadow-xl p-4 border border-gray-200 origin-top-right">
                                            <h3 class="text-md font-bold text-customIT mb-2">
                                                Choose an Action
                                            </h3>
                                            <p class="text-xs font-light text-bsctxt">Select an option to assist member</p>
                                            <div class="border-t border-gray-200 py-2">
                                                <ul class="space-y-2">
                                                    <li>
                                                        <div 
                                                            x-data="{
                                                                membership: {{ $member->applications->where('application_type', 'Membership')->first() ? json_encode($member->applications->where('application_type', 'Membership')->first()) : 'null' }},
                                                            }"
                                                        >
                                                            <button
                                                                onclick="openModal('assistGrantRequestModal-{{ $member->id}}')"
                                                                :disabled="!membership || membership.status_id !== 4"
                                                                :class="!membership || membership.status_id !== 4 
                                                                    ? 'px-4 py-2 rounded-md border border-btncolor text-customIT opacity-80 cursor-not-allowed' 
                                                                    : 'px-4 py-2 rounded-md border border-btncolor text-customIT hover:bg-btncolor hover:text-white'"
                                                                class="transition"
                                                            >
                                                                Assist Grant Application
                                                            </button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div>
                                                            @if($member->applications->where('application_type', 'Membership')->count() > 0)
                                                                <span class="block px-4 py-2 cursor-not-allowed rounded-md bg-approved text-white font-medium opacity-80">
                                                                    Membership Applied
                                                                </span>
                                                            @else
                                                                <button onclick="openModal('assistMembershipModal-{{ $member->id}}')" 
                                                                    class="block px-4 py-2 rounded-md border border-btncolor hover:bg-btncolor hover:text-white transition-colors duration-200 text-customIT font-medium">
                                                                    Assist Membership Application
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-8 text-gray-500 text-sm">
                                    No Users Found.
                                </td>
                            </tr>
                       @endforelse
                    </tbody>
                    </table>
                </div>
        </div>

        <x-pagination :paginator="$members" />
        </div>
    </div>
    @foreach($members as $member)
        @include('components.modals.assist-membership')
        @include('components.modals.assist-grant-request')
    @endforeach
    @include('components.modals.assist-register')
</div>
</div>
@endsection
