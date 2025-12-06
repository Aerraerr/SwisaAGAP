@extends('layouts.app')
@section('content')
@include('layouts.loading-overlay')
<div class="p-4 -mt-2">
    <div class="bg-mainbg px-4 min-h-screen">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <!-- Left side -->
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Member Application Management</h2>
                <p class="text-sm text-gray-600">Manage and monitor the member application of SWISA members.</p>
            </div>
        </div>

        @include('components.breadcrumbs', ['breadcrumbName' => Route::currentRouteName()])

        <!-- quick stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Initiatives -->
                <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-green-600">
                    <h3 class="text-[#2C6E49] font-bold ">Total Application</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $applications['all']->count() }}</p>
                    <p class="text-xs text-gray-400 mt-1">Overall membership application</p>
                </div>

                <!-- Upcoming Events -->
                <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-blue-600">
                    <h3 class="text-[#2C6E49] font-bold ">This Month</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $applications['all']->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count() }}</p>
                    <p class="text-xs text-gray-400 mt-1">Total membership application this month</p>
                </div>

                <!-- Completed Events -->
                <div class="bg-white rounded-2xl shadow p-4 border-t-4 border-yellow-500">
                    <h3 class="text-[#2C6E49] font-bold ">Today</h3>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $applications['all']->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])->count()}}</p>
                    <p class="text-xs text-gray-400 mt-1">No membership application today</p>
                </div>
        </div>

        <div class="grid grid-cols-12 gap-1 md:gap-2" x-data="{ selectedId: null, selectedUser: null, activeTab: 'All-Request' }" >

            <!-- tab -->
            <div class="col-span-12 col-start-1 h-auto bg-white rounded-md shadow">
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 text-center">
                        <!-- All Requests Tab -->
                        <div @click="activeTab = 'All-Request'" :class="activeTab === 'All-Request' 
                                ? 'p-4 bg-btncolor text-white rounded-lg cursor-pointer transition-colors duration-200' 
                                : 'p-4 bg-gray-200 text-gray-700 rounded-sm cursor-pointer transition-colors duration-200 hover:bg-btncolor hover:text-white hover:rounded-lg'">
                            <i class="fas fa-list-ul mb-2 text-2xl"></i>
                            <p class="text-xs font-light">All Requests</p>
                        </div>
                        <!-- Pending Tab -->
                        <div c @click="activeTab = 'Pending-Request'" :class="activeTab === 'Pending-Request' 
                                ? 'p-4 bg-btncolor text-white rounded-lg cursor-pointer transition-colors duration-200' 
                                : 'p-4 bg-gray-200 text-gray-700 rounded-sm cursor-pointer transition-colors duration-200 hover:bg-btncolor hover:text-white hover:rounded-lg'">
                            <i class="fas fa-hourglass-half mb-2 text-2xl"></i>
                            <p class="text-xs font-light">Pending</p>
                        </div>
                        <!-- Approved Tab -->
                        <div @click="activeTab = 'Approved-Request'" :class="activeTab === 'Approved-Request' 
                                ? 'p-4 bg-btncolor text-white rounded-lg cursor-pointer transition-colors duration-200' 
                                : 'p-4 bg-gray-200 text-gray-700 rounded-sm cursor-pointer transition-colors duration-200 hover:bg-btncolor hover:text-white hover:rounded-lg'">
                            <i class="fas fa-check-circle mb-2 text-2xl"></i>
                            <p class="text-xs font-light">Approved</p>
                        </div>
                        <!-- Denied Tab -->
                        <div @click="activeTab = 'Rejected-Request'" :class="activeTab === 'Rejected-Request' 
                                ? 'p-4 bg-btncolor text-white rounded-lg cursor-pointer transition-colors duration-200' 
                                : 'p-4 bg-gray-200 text-gray-700 rounded-sm cursor-pointer transition-colors duration-200 hover:bg-btncolor hover:text-white hover:rounded-lg'">
                            <p class="text-xs font-light">Rejected</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- All Request Tab-content -->
            <div x-show="activeTab === 'All-Request'" class="col-span-12 lg:col-span-8 col-start-1 h-full bg-white px-6 py-4 rounded-md shadow">
                <!-- Header -->
                <div class="flex items-center">
                    <img src="{{ asset('images/file-svg-green.svg') }}" class="w-12 h-12" />
                    <p class="text-customIT text-lg font-bold">Membership Application List</p>
                </div>

                <!-- Search -->
                <div class="flex justify-end mb-2">
                   <input type="text" placeholder="Search here"  id="searchAll" class="w-1/2 h-9 bg-white text-xs text-gray-700 px-4 border-1 rounded-l-[4px] border-gray-300 focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                    <button class="bg-btncolor text-white p-2 rounded-r-lg hover:bg-customIT transition duration-300 ease-in-out h-9 w-9">
                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                        </svg>
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-auto h-auto">
                    <table class="min-w-full border-collapse">
                        <thead class="bg-snbg sticky top-0 z-10">
                            <tr class="text-customIT text-left text-xs font-semibold">
                                <th class="px-4 py-3">APPLICATION ID</th>
                                <th class="px-4 py-3">NAME</th>
                                <th class="px-4 py-3">NUMBER</th>
                                <th class="px-4 py-3">EMAIL</th>
                                <th class="px-4 py-3">DATE SUBMITTED</th>
                                <th class="px-4 py-3">STATUS</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyAll">
                            @forelse($applications['all'] as $app)
                                <tr 
                                    class="border border-gray-200 hover:bg-[var(--hover-green)] cursor-pointer transition-colors"
                                    @click="
                                        selectedId = '{{ $app->id }}';
                                        selectedUser = { 
                                        id: '{{ $app->id ?? '-'}}', 
                                        name: '{{ $app->user->first_name ?? '-'}} {{ $app->user->middle_name ?? '-'}} {{ $app->user->last_name ?? '-'}}', 
                                        date: '{{ $app->created_at->format('F d, Y h:i A') ?? '-'}}',
                                        updated: '{{ $app->updated_at->format('F d, Y h:i A') ?? '-'}}', 
                                        status: '{{ ucfirst($app->status?->status_name ?? '-') }}',
                                        number: '{{ $app->user->user_info->phone_no ?? '-'}}',
                                        email: '{{ $app->user->email ?? '-'}}',
                                        reason: '{{ $app->rejection_reason ?? '-'}}',
                                        documents: @js($app->documents),
                                        form_img: '{{ $app->form_img ?? '-'}}'
                                    }"
                                    :class="selectedId === '{{ $app->id }}' ? 'bg-snbg' : ''"
                                    >
                                    <td class="px-4 py-3 text-xs text-gray-700">{{ $app->formatted_id ?? '-'}}</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->first_name ?? '-'}} {{ $app->user->middle_name ?? '-'}} {{ $app->user->last_name ?? '-'}}</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->user_info->phone_no ?? '-'}}</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->email ?? '-'}}</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">{{ $app->created_at->format('F d, Y') ?? '-'}}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-block text-xs font-medium text-white px-3 py-1 rounded-full 
                                        {{ $app->status->status_name === 'approved' ? 'bg-approved text-white' : '' }}
                                        {{ $app->status->status_name === 'pending' ? 'bg-pending text-white' : '' }}
                                        {{ $app->status->status_name === 'rejected' ? 'bg-rejected text-white' : '' }}
                                        {{ $app->status->status_name === 'completed' ? 'bg-approved text-white' : '' }}
                                        ">
                                            {{ ucfirst($app->status->status_name) ?? '-'}}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">No applications.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
               <x-pagination :paginator="$applications['all']" />
            </div>


            <div x-show="activeTab === 'All-Request'" class="col-span-12 lg:col-start-9 lg:col-span-4">
                    <div x-data="{ verified: false,  membershipRequirements: @js($membershipRequirements), selectedRequirement: null }" class="flex flex-col bg-white shadow-lg px-8 py-6 h-auto rounded-md text-center overflow-auto">
                        <!-- default display -->
                        <template x-if="!selectedUser">
                            <div class="flex flex-col items-center my-6">
                                <img src="{{ asset('images/file-svg.svg') }}" class="w-32 h-32 pt-4"/>
                                <div class="border-t border-gray-300">
                                    <p class="text-gray-300 font-medium text-md mt-2">Select an application to view details</p>
                                </div>
                            </div>
                        </template>

                        <!-- Show selected user details -->
                        <template x-if="selectedUser">
                            <div class="flex flex-col items-stretch text-left space-y-2">

                                <!-- Header -->
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-bold text-customIT">Application Details</h2>
                                    <span x-text="selectedUser.status" class="text-white text-xs px-3 py-1 rounded-full font-medium"
                                    :class="{
                                        'bg-approved': selectedUser.status === 'Approved',
                                        'bg-pending': selectedUser.status === 'Pending',
                                        'bg-rejected': selectedUser.status === 'Rejected'
                                        }">
                                    </span>
                                </div>

                                <!-- Member Application Info -->
                                <div class="flex gap-4">
                                    <!--image dgd -->
                                    <img src="{{ asset('images/profile-user.png') }}" alt="profile" class="w-10 h-10 rounded-full">
                                    <div>
                                        <h3 x-text="selectedUser.name" class="text-green-700 font-semibold"></h3>
                                        <p class="text-xs font-semibold text-gray-500">Application ID: <span x-text="selectedUser.id" class="font-medium ml-2"></span></p>
                                        <p class="text-xs font-semibold text-gray-500">Date Submitted: <span x-text="selectedUser.date" class="font-medium ml-2"></span></p>
                                    </div>
                                </div>


                                <!-- Requirements Approval -->
                                <h3 class="text-sm font-bold text-customIT">REQUIREMENTS APPROVAL</h3>

                                <!-- Requirements List -->
                                <div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT">Uploaded Requirements</p>
                                        <span class="text-customIT text-sm font-semibold">Status</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                         <template x-for="req in membershipRequirements" :key="req.membership_requirement_id">
                                            <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                                <span class="flex items-center">
                                                    <span x-text="req.requirement_name"></span>
                                                    <span 
                                                        @click="selectedRequirement = {
                                                            name: req.requirement_name,
                                                            document: selectedUser.documents.find(d => d.membership_requirement_id === req.membership_requirement_id)
                                                        }; openModal('requirementModal');"
                                                        class="flex"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                        <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                        </svg>
                                                    </span>
                                                </span>
                                                
                                               <!-- display 'Passed or Needs Checking' depending on the result of the documentChecker -->
                                                <span 
                                                    x-text="selectedUser.documents.find(d => d.membership_requirement_id === req.membership_requirement_id)?.check_result || 'Uploaded'"
                                                    :class="{
                                                        'text-green-500 font-semibold': $el.textContent === 'Passed',
                                                        'text-red-500 italic': $el.textContent === 'Needs Checking'
                                                    }"
                                                    class="text-xs"
                                                ></span>
                                            </li>
                                        </template>
                                    </ul>
                                    <div class="mt-3 border-t pt-2">
                                        <span class="font-medium text-xs text-gray-600 pl-4">Membership Application Form</span>
                                        <template x-if="selectedUser.form_img && selectedUser.form_img !== '-'">
                                            <a :href="'/storage/' + selectedUser.form_img"
                                            target="_blank"
                                            class="text-blue-600 underline italic text-xs hover:text-blue-800">
                                            view form
                                            </a>
                                        </template>
                                        <template x-if="!selectedUser.form_img || selectedUser.form_img === '-'">
                                            <span class="text-xs text-gray-500 italic">Not yet generated.</span>
                                        </template>
                                    </div>

                                    @include('components.modals.requirement-view')
                                    
                                </div>

                                <!-- Approved text -->
                                <template x-if="selectedUser.status === 'Approved'">
                                    <div class="text-xs text-approved font-medium">
                                        <p class="text-gray-500 italic">*Approved by the Admin on <span class="font-medium text-customIT" x-text="selectedUser.updated"></span></p>
                                    </div>
                                </template>

                                <!-- Rejected text-->
                                <template x-if="selectedUser.status === 'Rejected'">
                                    <div class="text-xs font-medium">
                                        <p class="text-gray-500 italic">*Rejected at <span class="font-medium text-rejected" x-text="selectedUser.updated"></span>.</p>
                                        <p class="text-gray-500 italic">Reason: <span x-text="selectedUser.reason" class="text-rejected"></span></p>
                                    </div>
                                </template>

                                <!-- Verification Note -->
                                <template x-if="selectedUser.status === 'Pending'">
                                    <div class="flex items-center">
                                        <input type="checkbox" x-model="verified" class="peer h-5 w-5 appearance-none rounded-md border border-gray-300 bg-white transition-colors duration-200 checked:bg-btncolor focus:ring-btncolor checked:border-btncolor">
                                        <p class="text-xs text-bsctxt ml-2">All requirements have been reviewed and verified.</p>
                                    </div>
                                </template>

                                <!-- Approve Button -->
                                <template x-if="selectedUser.status === 'Pending'">
                                    <div class="grid grid-cols-2 pt-4">
                                        <button onclick="openModal('approvedModalAll')" class="col-start-2 bg-btncolor text-white font-medium py-2 px-4 rounded-md"
                                            :class="verified ? 'bg-opacity-100 hover:bg-opacity-80' : 'bg-opacity-50'"
                                            :disabled="!verified">
                                            Approve
                                        </button>
                                    </div>
                                </template>
                                @include('components.modals.approved-membership-modal', ['modalId' => 'approvedModalAll'])
                            </div>
                        </template>
                    </div>
            </div>

            <!-- Pending Tab-content -->
            <div x-show="activeTab === 'Pending-Request'" class="col-span-12 lg:col-span-8 col-start-1 h-full bg-white px-6 py-4 rounded-md shadow">
                    <div class="flex items-center">
                        <img src="{{ asset('images/file-svg-green.svg') }}"
                            class="w-12 h-12" />
                        <p class="text-customIT text-lg font-bold">Pending Membership List</p>
                    </div>
                    <div class="flex justify-end mb-2">
                        <input type="text" placeholder="Search here"  id="searchPending" class="w-1/2 h-9 bg-white text-xs text-gray-700 px-4 border-1 rounded-l-[4px] border-gray-300 focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                        <button class="bg-btncolor text-white p-2 rounded-r-lg hover:bg-customIT transition duration-300 ease-in-out h-9 w-9">
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                            </svg>
                        </button>
                    </div>
                    <div class="overflow-auto h-auto">
                        <table class="min-w-full border-collapse">
                            <thead class="bg-snbg sticky top-0 z-10">
                                <tr class="text-customIT text-left text-xs font-semibold ">
                                    <th class="px-4 py-3 rounded-tl-md">APPLICATION ID</th>
                                    <th class="px-4 py-3">NAME</th>
                                    <th class="px-4 py-3">NUMBER</th>
                                    <th class="px-4 py-3">EMAIL</th>
                                    <th class="px-4 py-3">DATE SUBMITTED</th>
                                    <th class="px-4 py-3 rounded-tr-md">STATUS</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyPending">
                                @forelse($applications['pending'] as $app)
                                    <tr 
                                        class="border border-gray-200 hover:bg-[var(--hover-green)] cursor-pointer transition-colors"
                                        @click="
                                            selectedId = '{{ $app->id }}';
                                            selectedUser = { 
                                            id: '{{ $app->id ?? '-'}}', 
                                            name: '{{ $app->user->first_name ?? '-'}} {{ $app->user->middle_name ?? '-'}} {{ $app->user->last_name ?? '-'}}', 
                                            date: '{{ $app->created_at->format('F d Y') ?? '-'}}', 
                                            status: '{{ ucfirst($app->status?->status_name ?? '-') }}',
                                            number: '{{ $app->user->user_info->phone_no ?? '-'}}',
                                            email: '{{ $app->user->email ?? '-'}}', 
                                            documents: @js($app->documents),
                                            form_img: '{{ $app->form_img ?? '-'}}' 
                                        }"
                                        :class="selectedId === '{{ $app->id }}' ? 'bg-snbg' : ''"
                                        >
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->formatted_id ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->first_name ?? '-'}} {{ $app->user->middle_name ?? '-'}} {{ $app->user->last_name ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->user_info->phone_no ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->email ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->created_at->format('F d Y') ?? '-'}}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-block text-xs font-medium text-white px-3 py-1 rounded-full 
                                            {{ $app->status->status_name === 'approved' ? 'bg-approved text-white' : '' }}
                                            {{ $app->status->status_name === 'pending' ? 'bg-pending text-white' : '' }}
                                            {{ $app->status->status_name === 'rejected' ? 'bg-rejected text-white' : '' }}
                                            ">
                                                {{ ucfirst($app->status->status_name) ?? '-'}}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-gray-500">No pending applications.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <x-pagination :paginator="$applications['pending']" />
            </div>

            <div x-show="activeTab === 'Pending-Request'" class="col-span-12 lg:col-start-9 lg:col-span-4">
                    <div x-data="{ verified: false,  membershipRequirements: @js($membershipRequirements), selectedRequirement: null }" class="flex flex-col bg-white shadow-lg px-8 py-6 h-auto rounded-md text-center overflow-auto">
                        <!-- default display -->
                        <template x-if="!selectedUser">
                            <div class="flex flex-col items-center my-6">
                                <img src="{{ asset('images/file-svg.svg') }}" class="w-32 h-32 pt-4"/>
                                <div class="border-t border-gray-300">
                                    <p class="text-gray-300 font-medium text-md mt-2">Select an application to view details</p>
                                </div>
                            </div>
                        </template>

                        <!-- Show selected user details -->
                        <template x-if="selectedUser">
                            <div class="flex flex-col items-stretch text-left space-y-2">

                                <!-- Header -->
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-bold text-customIT">Application Details</h2>
                                    <span x-text="selectedUser.status" class="text-white text-xs px-3 py-1 rounded-full font-medium"
                                    :class="{
                                        'bg-approved': selectedUser.status === 'Approved',
                                        'bg-pending': selectedUser.status === 'Pending',
                                        'bg-rejected': selectedUser.status === 'Rejected'
                                        }">
                                    </span>
                                </div>

                                <!-- Member Application Info -->
                                <div class="flex gap-4">
                                    <!--image dgd -->
                                    <img src="{{ asset('images/profile-user.png') }}" alt="profile" class="w-10 h-10 rounded-full">
                                    <div>
                                        <h3 x-text="selectedUser.name" class="text-green-700 font-semibold"></h3>
                                        <p class="text-xs font-semibold text-gray-500">Application ID: <span x-text="selectedUser.id" class="font-medium ml-2"></span></p>
                                        <p class="text-xs font-semibold text-gray-500">Date Submitted: <span x-text="selectedUser.date" class="font-medium ml-2"></span></p>
                                    </div>
                                </div>

                                <!-- Requirements Approval -->
                                <h3 class="text-sm font-bold text-customIT">REQUIREMENTS APPROVAL</h3>

                                <!-- Basic Requirements -->
                                <div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT">Uploaded Requirements</p>
                                        <span class="text-customIT text-sm font-semibold">Status</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                         <template x-for="req in membershipRequirements" :key="req.membership_requirement_id">
                                            <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                                <span class="flex items-center">
                                                    <span x-text="req.requirement_name"></span>
                                                    <span 
                                                        @click="selectedRequirement = {
                                                            name: req.requirement_name,
                                                            document: selectedUser.documents.find(d => d.membership_requirement_id === req.membership_requirement_id)
                                                        }; openModal('requirementModal');"
                                                        class="flex"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                        <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                        </svg>
                                                    </span>
                                                </span>

                                                <!-- display 'Passed or Needs Checking' depending on the result of the documentChecker -->
                                                <span x-text="selectedUser.documents.find(d => d.membership_requirement_id === req.membership_requirement_id)?.check_result "class="text-xs"></span>
                                            </li>
                                        </template>
                                    </ul>
                                    <div class="mt-3 border-t pt-2">
                                        <span class="font-medium text-xs text-gray-600 pl-4">Membership Application Form</span>
                                        <template x-if="selectedUser.form_img && selectedUser.form_img !== '-'">
                                            <a :href="'/storage/' + selectedUser.form_img"
                                            target="_blank"
                                            class="text-blue-600 underline italic text-xs hover:text-blue-800">
                                            view form
                                            </a>
                                        </template>
                                        <template x-if="!selectedUser.form_img || selectedUser.form_img === '-'">
                                            <span class="text-xs text-gray-500 italic">Not yet generated.</span>
                                        </template>
                                    </div>
                                    @include('components.modals.requirement-view')
                                </div>

                                <!-- Verification Note -->
                                <div class="flex items-center">
                                    <input type="checkbox" x-model="verified" class="peer h-5 w-5 appearance-none rounded-md border border-gray-300 bg-white transition-colors duration-200 checked:bg-btncolor focus:ring-btncolor checked:border-btncolor">
                                    <p class="text-xs text-bsctxt ml-2">All requirements have been reviewed and verified.</p>
                                </div>

                                <!-- Approve Button -->
                                <div class="grid grid-cols-2 pt-4">
                                    <button onclick="openModal('approvedModalPending')" class="col-start-2 bg-btncolor text-white font-medium py-2 px-4 rounded-md"
                                        :class="verified ? 'bg-opacity-100 hover:bg-opacity-80' : 'bg-opacity-50'"
                                        :disabled="!verified">
                                        Approve
                                    </button>
                                </div>
                                @include('components.modals.approved-membership-modal', ['modalId' => 'approvedModalPending'])
                            </div>
                        </template>
                    </div>
            </div>

            <!-- Approved Tab-content -->
            <div x-show="activeTab === 'Approved-Request'" class="col-span-12 lg:col-span-8 col-start-1 h-full bg-white px-6 py-4 rounded-md shadow">
                    <div class="flex items-center">
                        <img src="{{ asset('images/file-svg-green.svg') }}"
                            class="w-12 h-12" />
                        <p class="text-customIT text-lg font-bold">Approved Membership List</p>
                    </div>
                    <div class="flex justify-end mb-2">
                        <input type="text" placeholder="Search here"  id="searchApproved" class="w-1/2 h-9 bg-white text-xs text-gray-700 px-4 border-1 rounded-l-[4px] border-gray-300 focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                        <button class="bg-btncolor text-white p-2 rounded-r-lg hover:bg-customIT transition duration-300 ease-in-out h-9 w-9">
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                            </svg>
                        </button>
                    </div>
                    <div class="overflow-auto h-auto">
                        <table class="table table-hover min-w-full border-spacing-y-1">
                            <thead class="bg-snbg border-gray-300">
                                <tr class="text-customIT text-left text-xs font-semibold ">
                                    <th class="px-4 py-3 rounded-tl-md">APPLICATION ID</th>
                                    <th class="px-4 py-3">NAME</th>
                                    <th class="px-4 py-3">NUMBER</th>
                                    <th class="px-4 py-3">EMAIL</th>
                                    <th class="px-4 py-3">DATE SUBMITTED</th>
                                    <th class="px-4 py-3 rounded-tr-md">STATUS</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyApproved">
                                @forelse($applications['approved'] as $app)
                                    <tr 
                                        class="border border-gray-200 hover:bg-[var(--hover-green)] cursor-pointer transition-colors"
                                        @click="
                                            selectedId = '{{ $app->id }}';
                                            selectedUser = { 
                                            id: '{{ $app->id ?? '-'}}', 
                                            name: '{{ $app->user->first_name ?? '-'}} {{ $app->user->middle_name ?? '-'}} {{ $app->user->last_name ?? '-'}}', 
                                            date: '{{ $app->created_at->format('F d, Y h:i A') ?? '-'}}',
                                            updated: '{{ $app->updated_at->format('F d, Y h:i A') ?? '-'}}', 
                                            status: '{{ ucfirst($app->status?->status_name ?? '-') }}',
                                            number: '{{ $app->user->user_info->phone_no ?? '-'}}',
                                            email: '{{ $app->user->email ?? '-'}}',
                                            documents: @js($app->documents),
                                            form_img: '{{ $app->form_img ?? '-'}}'  
                                        }"
                                        :class="selectedId === '{{ $app->id }}' ? 'bg-snbg' : ''"
                                        >
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->formatted_id ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->first_name ?? '-'}} {{ $app->user->middle_name ?? '-'}} {{ $app->user->last_name ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->user_info->phone_no ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->email ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->created_at->format('F d Y') ?? '-'}}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-block text-xs font-medium bg-approved text-white px-3 py-1 rounded-full">
                                                {{ ucfirst($app->status->status_name) ?? '-'}}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-gray-500">No approved applications.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <x-pagination :paginator="$applications['approved']" />
            </div>

            <div x-show="activeTab === 'Approved-Request'" class="col-span-12 lg:col-start-9 lg:col-span-4">
                    <div x-data="{ verified: false,  membershipRequirements: @js($membershipRequirements), selectedRequirement: null }" class="flex flex-col bg-white shadow-lg px-8 py-6 h-auto rounded-md text-center overflow-auto">
                        <!-- default display -->
                        <template x-if="!selectedUser">
                            <div class="flex flex-col items-center my-6">
                                <img src="{{ asset('images/file-svg.svg') }}" class="w-32 h-32 pt-4"/>
                                <div class="border-t border-gray-300">
                                    <p class="text-gray-300 font-medium text-md mt-2">Select an application to view details</p>
                                </div>
                            </div>
                        </template>

                        <!-- Show selected user details -->
                        <template x-if="selectedUser">
                            <div class="flex flex-col items-stretch text-left space-y-2">

                                <!-- Header -->
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-bold text-customIT">Application Details</h2>
                                    <span x-text="selectedUser.status" class="text-white text-xs px-3 py-1 rounded-full font-medium"
                                    :class="{
                                        'bg-approved': selectedUser.status === 'Approved',
                                        'bg-pending': selectedUser.status === 'Pending',
                                        'bg-rejected': selectedUser.status === 'Rejected'
                                        }">
                                    </span>
                                </div>

                                <!-- Member Application Info -->
                                <div class="flex gap-4">
                                    <!--image dgd -->
                                    <img src="{{ asset('images/profile-user.png') }}" alt="profile" class="w-10 h-10 rounded-full">
                                    <div>
                                        <h3 x-text="selectedUser.name" class="text-green-700 font-semibold"></h3>
                                        <p class="text-xs font-semibold text-gray-500">Application ID: <span x-text="selectedUser.id" class="font-medium ml-2"></span></p>
                                        <p class="text-xs font-semibold text-gray-500">Date Submitted: <span x-text="selectedUser.date" class="font-medium ml-2"></span></p>
                                    </div>
                                </div>

                                <!-- Requirements Approval -->
                                <h3 class="text-sm font-bold text-customIT">REQUIREMENTS APPROVAL</h3>

                                <!-- Basic Requirements -->
                                <div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT">Uploaded Requirements</p>
                                        <span class="text-customIT text-sm font-semibold">Status</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                        <template x-for="req in membershipRequirements" :key="req.membership_requirement_id">
                                            <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                                <span class="flex items-center">
                                                    <span x-text="req.requirement_name"></span>
                                                    <span 
                                                        @click="selectedRequirement = {
                                                            name: req.requirement_name,
                                                            document: selectedUser.documents.find(d => d.membership_requirement_id === req.membership_requirement_id)
                                                        }; openModal('requirementModal');"
                                                        class="flex"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                        <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                        </svg>
                                                    </span>
                                                </span>

                                                <!-- display 'Passed or Needs Checking' depending on the result of the documentChecker -->
                                                <span x-text="selectedUser.documents.find(d => d.membership_requirement_id === req.membership_requirement_id)?.check_result "class="text-xs"></span>
                                            </li>
                                        </template>
                                    </ul>
                                    <div class="mt-3 border-t pt-2">
                                        <span class="font-medium text-xs text-gray-600 pl-4">Membership Application Form</span>
                                        <template x-if="selectedUser.form_img && selectedUser.form_img !== '-'">
                                            <a :href="'/storage/' + selectedUser.form_img"
                                            target="_blank"
                                            class="text-blue-600 underline italic text-xs hover:text-blue-800">
                                            view form
                                            </a>
                                        </template>
                                        <template x-if="!selectedUser.form_img || selectedUser.form_img === '-'">
                                            <span class="text-xs text-gray-500 italic">Not yet generated.</span>
                                        </template>
                                    </div>
                                    @include('components.modals.requirement-view')
                                </div>
                                <!-- Approved text -->
                                <div class="text-xs text-approved font-medium">
                                    <p class="text-gray-500 italic">*Approved by the Admin on <span class="font-medium text-customIT" x-text="selectedUser.updated"></span></p>
                                </div>
                            </div>
                        </template>
                    </div>
            </div>

            <!-- Rejected Tab-content -->
            <div x-show="activeTab === 'Rejected-Request'" class="col-span-12 lg:col-span-8 col-start-1 h-full bg-white px-6 py-4 rounded-md shadow">
                    <div class="flex items-center">
                        <img src="{{ asset('images/file-svg-green.svg') }}"
                            class="w-12 h-12" />
                        <p class="text-customIT text-lg font-bold">Rejected Membership List</p>
                    </div>
                    <div class="flex justify-end mb-2">
                        <input type="text" placeholder="Search here"  id="searchRejected" class="w-1/2 h-9 bg-white text-xs text-gray-700 px-4 border-1 rounded-l-[4px] border-gray-300 focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                        <button class="bg-btncolor text-white p-2 rounded-r-lg hover:bg-customIT transition duration-300 ease-in-out h-9 w-9">
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                            </svg>
                        </button>
                    </div>
                    <div class="overflow-auto h-auto">
                        <table class="table table-hover min-w-full border-spacing-y-1">
                            <thead class="bg-snbg border-gray-300">
                                <tr class="text-customIT text-left text-xs font-semibold ">
                                    <th class="px-4 py-3 rounded-tl-md">APPLICATION ID</th>
                                    <th class="px-4 py-3">NAME</th>
                                    <th class="px-4 py-3">NUMBER</th>
                                    <th class="px-4 py-3">EMAIL</th>
                                    <th class="px-4 py-3">DATE SUBMITTED</th>
                                    <th class="px-4 py-3 rounded-tr-md">STATUS</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyRejected">
                                @forelse($applications['rejected'] as $app)
                                    <tr 
                                        class="border border-gray-200 hover:bg-[var(--hover-green)] cursor-pointer transition-colors"
                                        @click="
                                            selectedId = '{{ $app->id }}';
                                            selectedUser = { 
                                            id: '{{ $app->id ?? '-'}}', 
                                            name: '{{ $app->user->first_name ?? '-'}} {{ $app->user->middle_name ?? '-'}} {{ $app->user->last_name ?? '-'}}', 
                                            date: '{{ $app->created_at->format('F d, Y h:i A') ?? '-'}}', 
                                            updated: '{{ $app->updated_at->format('F d, Y h:i A') ?? '-'}}',  
                                            status: '{{ ucfirst($app->status?->status_name ?? '-') }}',
                                            number: '{{ $app->user->user_info->phone_no ?? '-'}}',
                                            email: '{{ $app->user->email ?? '-'}}',
                                            reason: '{{ $app->rejection_reason ?? '-'}}',
                                            documents: @js($app->documents),
                                            form_img: '{{ $app->form_img ?? '-'}}'  
                                        }"
                                        :class="selectedId === '{{ $app->id }}' ? 'bg-snbg' : ''"
                                        >
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->formatted_id ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->first_name ?? '-'}} {{ $app->user->middle_name ?? '-'}} {{ $app->user->last_name ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->user_info->phone_no ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->user->email ?? '-'}}</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">{{ $app->created_at->format('F d, Y') ?? '-'}}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-block text-xs font-medium bg-rejected text-white px-3 py-1 rounded-full">
                                                {{ ucfirst($app->status->status_name) ?? '-'}}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-gray-500">No rejected applications.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <x-pagination :paginator="$applications['rejected']" />
            </div>

            <div x-show="activeTab === 'Rejected-Request'" class="col-span-12 lg:col-start-9 lg:col-span-4">
                    <div x-data="{ verified: false,  membershipRequirements: @js($membershipRequirements), selectedRequirement: null }" class="flex flex-col bg-white shadow-lg px-8 py-6 h-auto rounded-md text-center overflow-auto">
                        <!-- default display -->
                        <template x-if="!selectedUser">
                            <div class="flex flex-col items-center my-6">
                                <img src="{{ asset('images/file-svg.svg') }}" class="w-32 h-32 pt-4"/>
                                <div class="border-t border-gray-300">
                                    <p class="text-gray-300 font-medium text-md mt-2">Select an application to view details</p>
                                </div>
                            </div>
                        </template>

                        <!-- Show selected user details -->
                        <template x-if="selectedUser">
                            <div class="flex flex-col items-stretch text-left space-y-2">

                                <!-- Header -->
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-bold text-customIT">Application Details</h2>
                                    <span x-text="selectedUser.status" class="text-white text-xs px-3 py-1 rounded-full font-medium"
                                    :class="{
                                        'bg-approved': selectedUser.status === 'Approved',
                                        'bg-pending': selectedUser.status === 'Pending',
                                        'bg-rejected': selectedUser.status === 'Rejected'
                                        }">
                                    </span>
                                </div>

                                <!-- Item Info -->
                                <div class="flex gap-4">
                                    <!--image dgd -->
                                    <img src="{{ asset('images/profile-user.png') }}" alt="profile" class="w-10 h-10 rounded-full">
                                    <div>
                                        <h3 x-text="selectedUser.name" class="text-green-700 font-semibold"></h3>
                                        <p class="text-xs font-semibold text-gray-500">Application ID: <span x-text="selectedUser.id" class="font-medium ml-2"></span></p>
                                        <p class="text-xs font-semibold text-gray-500">Date Submitted: <span x-text="selectedUser.date" class="font-medium ml-2"></span></p>
                                    </div>
                                </div>

                                <!-- Requirements Approval -->
                                <h3 class="text-sm font-bold text-customIT">REQUIREMENTS APPROVAL</h3>

                                <!-- Basic Requirements -->
                                <div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT">Uploaded Requirements</p>
                                        <span class="text-customIT text-sm font-semibold">Status</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                        <template x-for="req in membershipRequirements" :key="req.membership_requirement_id">
                                            <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                                <span class="flex items-center">
                                                    <span x-text="req.requirement_name"></span>
                                                    <span 
                                                        @click="selectedRequirement = {
                                                            name: req.requirement_name,
                                                            document: selectedUser.documents.find(d => d.membership_requirement_id === req.membership_requirement_id)
                                                        }; openModal('requirementModal');"
                                                        class="flex"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                        <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                        </svg>
                                                    </span>
                                                </span>

                                                <!-- display 'Passed or Needs Checking' depending on the result of the documentChecker -->
                                                <span x-text="selectedUser.documents.find(d => d.membership_requirement_id === req.membership_requirement_id)?.check_result "class="text-xs"></span>
                                            </li>
                                        </template>
                                    </ul>
                                    <div class="mt-3 border-t pt-2">
                                        <span class="font-medium text-xs text-gray-600 pl-4">Membership Application Form</span>
                                        <template x-if="selectedUser.form_img && selectedUser.form_img !== '-'">
                                            <a :href="'/storage/' + selectedUser.form_img"
                                            target="_blank"
                                            class="text-blue-600 underline italic text-xs hover:text-blue-800">
                                            view form
                                            </a>
                                        </template>
                                        <template x-if="!selectedUser.form_img || selectedUser.form_img === '-'">
                                            <span class="text-xs text-gray-500 italic">Not yet generated.</span>
                                        </template>
                                    </div>
                                    @include('components.modals.requirement-view')
                                </div>
                                <!-- Rejected text-->
                                <div class="text-xs font-medium">
                                    <p class="text-gray-500 italic">*Rejected at <span class="font-medium text-rejected" x-text="selectedUser.updated"></span>.</p>
                                    <p class="text-gray-500 italic">Reason: <span x-text="selectedUser.reason" class="text-rejected"></span></p>
                                </div>
                            </div>
                        </template>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Define the IDs for all tabs' search input and table bodies
        const tabConfigs = [
            { searchId: 'searchAll', tbodyId: 'tbodyAll' },
            { searchId: 'searchPending', tbodyId: 'tbodyPending' },
            { searchId: 'searchApproved', tbodyId: 'tbodyApproved' },
            { searchId: 'searchRejected', tbodyId: 'tbodyRejected' },
        ];

        // Function to perform the filtering on a specific table
        const filterTable = (searchInputId, tbodyId) => {
            const searchInput = document.getElementById(searchInputId);
            const tbody = document.getElementById(tbodyId);

            if (!searchInput || !tbody) {
                // console.warn(`Missing element for configuration: Input ID: ${searchInputId}, TBody ID: ${tbodyId}`);
                return; // Exit if elements aren't found (e.g., if a tab isn't active on load)
            }
            
            // Get all rows once
            const tableRows = tbody.querySelectorAll("tr");

            searchInput.addEventListener("input", () => {
                const term = searchInput.value.toLowerCase().trim();

                tableRows.forEach(row => {
                    // Check if the row is the 'No applications.' message row (to exclude it from filtering)
                    if (row.querySelector('td[colspan="6"]')) {
                        return;
                    }

                    const rowText = row.textContent.toLowerCase();
                    
                    // Show or hide the row based on the search term
                    row.style.display = rowText.includes(term) ? "" : "none";
                });
            });
        };

        // Initialize filtering for all tabs
        tabConfigs.forEach(config => {
            // Use a short delay (setTimeout) to ensure all tabs' contents are rendered in the DOM, 
            // even if they are initially hidden by x-show.
            setTimeout(() => filterTable(config.searchId, config.tbodyId), 50);
        });
    });
</script>
@endsection
