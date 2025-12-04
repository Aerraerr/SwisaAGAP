@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')
    <div class="bg-mainbg px-2">
        <div class="text-customIT text-2xl flex flex-col md:flex-row justify-between md:items-center mb-4">
            <h1 class="font-bold">Available Grants & Equipments</h1>
        </div>
        @include('components.breadcrumbs', [
            'breadcrumbName' => 'view-grant',
            'params' => [$grant]  {{-- pass the grant instance --}}
        ])
        <div class="grid grid-cols-12 gap-2 py-2" x-data="{ selectedUser: null}">
            <div class="col-span-12">
                <div class="bg-white shadow-lg p-4 h-auto rounded-md">
                    <div class="lg:flex h-auto">
                        <div class="rounded-md h-full w-full  lg:h-[260px] lg:w-1/3 flex justify-center flex-shrink-0">
                            <img 
                                src= "{{ $grant->documents->first() ? asset('storage/' . $grant->documents->first()->file_path) : asset('image/placeholder.png') }} "
                                alt="Grant Image" 
                                class="object-cover w-full h-full"
                            >
                        </div>
                        <div class="lg:ml-4 sm:flex-1 p-2">
                            <div>
                                <p class="text-xs md:text-2xl font-semibold text-customIT">{{ $grant->title}}</p>
                                <p class="text-sm lg:text-md text-gray-500 mb-2">{{ $grant->grant_type->grant_type}}</p>
                            </div>
                            <div class="flex justify-between mb-4">
                                <div class="flex-1">
                                    <p class="font-semibold text-xs lg:text-lg text-customIT flex items-center mb-1">
                                        Stock Summary
                                    </p>
                                    <p class="ml-5 text-[10px] lg:text-sm">Available: <span class="font-medium ml-2 text-gray-600">{{ $grant->total_quantity ?? '-'}}</span></p>
                                    <p class="ml-5 text-[10px] lg:text-sm">Unit per Request: <span class="font-medium ml-2 text-gray-600">{{ $grant->unit_per_request ?? '-'}}</span></p>
                                    <p class="ml-5 text-[10px] lg:text-sm">Amount per Request: <span class="font-medium ml-2 text-gray-600">{{ $grant->amount_per_quantity ?? '-'}}</span></p>
                                    <p class="ml-5 text-[10px] lg:text-sm">Total Amount: <span class="font-medium ml-2 text-gray-600">{{ $totalAmount ?? '-'}}</span></p>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-xs lg:text-lg text-customIT flex items-center mb-1">
                                            Availability
                                    </h4>
                                    <p class="ml-5 text-[10px] lg:text-sm">Available Date: <span class="font-medium ml-2 text-gray-600">{{ $grant->available_at->format('F d Y') }}</span></p>
                                    <p class="ml-5 text-[10px] lg:text-sm">End Date: <span class="font-medium ml-2 text-gray-600">{{ $grant->end_at->format('F d Y') }}</span></p>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-xs lg:text-lg text-customIT flex items-center mb-1">Requirements</h4>
                                    @forelse($grant->requirements as $requirement)
                                        <p class="ml-5 text-[10px] lg:text-sm font-medium text-gray-600">-{{ $requirement->requirement_name }}</p>
                                    @empty
                                        <li class="text-gray-500">No requirements found.</li>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="xl:flex flex-col text-sm text-customIT font-medium m-14 gap-1">
                            {{--<button onclick="openModal('geneReportModal')" class="min-w-[220px] px-5 py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">Generate Report</button>--}}
                            <button onclick="openModal('addStockModal')" class="min-w-[220px] px-5 py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">Add New Stock</button>
                            <button onclick="openModal('editGrantModal')" class="min-w-[220px] px-5 py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">Edit Info</button>
                            <button onclick="openModal('deleteGrantModal')" class="min-w-[220px] px-5 py-2 rounded-lg border border-btncolor text-btncolor font-semibold 
                                    bg-white shadow-sm transition-all duration-200 hover:bg-btncolor hover:text-white hover:shadow-md">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table -->
            <div class="col-start-1 col-span-12 lg:col-span-8 bg-white shadow-lg px-4 rounded-md mt-2">
                <div class="text-customIT text-lg flex justify-between gap-2 my-4">
                    <h1 class="font-bold mr-40">Request Summary Table</h1>
                </div>
                <div class="overflow-auto h-[60vh] custom-scroll">
                    <table class="min-w-full overflow-auto border-spacing-y-1">
                    <thead class="bg-snbg border border-gray-100">
                        <tr class="text-customIT text-left ">
                            <th class="px-4 py-3 text-xs font-medium">ID</th>
                            <th class="px-4 py-3 text-xs font-medium">NAME</th>
                            <th class="px-4 py-3 text-xs font-medium">SECTOR</th>
                            <th class="px-4 py-3 text-xs font-medium">DATE SUBMITTED</th>
                            <th class="px-4 py-3 text-xs font-medium">STATUS</th>
                            <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($grant->applications as $app)
                            <tr class="border border-gray-300 hover:bg-gray-100 cursor-pointer"
                                @click="selectedUser = { 
                                    id: '{{ $app->formatted_id  ?? '-'}}',
                                    name: '{{ $app->user->name ?? '-'}}',  
                                    type: '{{ $app->user->user_info->sector->sector_name ?? '-'}}', 
                                    date: '{{ $app->created_at->format('F d Y') ?? '-'}}', 
                                    status: '{{ ucfirst($app->status->status_name) ?? '-'}}',
                                    phone: '{{ $app->user->user_info->contact_no ?? '-'}}',
                                    email: '{{ $app->user->email ?? '-'}}'
                                }">
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $app->formatted_id  ?? '-'}}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $app->user->name ?? '-'}}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $app->user->user_info->sector->sector_name ?? '-'}}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $app->created_at->format('F d Y') ?? '-'}}</td>
                                <td class="px-4 py-3">
                                    <div class="inline-block text-xs font-medium text-white text-center px-3 py-1 rounded-full
                                        {{ $app->status->status_name === 'approved' ? 'bg-approved text-white' : '' }}
                                        {{ $app->status->status_name === 'pending' ? 'bg-pending text-white' : '' }}
                                        {{ $app->status->status_name === 'rejected' ? 'bg-rejected text-white' : '' }}
                                        ">
                                        {{ ucfirst($app->status->status_name) ?? '-'}}
                                    </div>
                                </td>
                                <td class="pl-4 py-3 text-sm">
                                    <div class="relative" x-data="{ show: false }" @click.away="show = false">
                                        <button @click="show = !show"  class="border border-gray-300 rounded-sm pl-2">
                                            <img src="{{ asset('images/dot-menu.svg') }}"
                                            class="w-5 h-5 rounded-sm mr-2"/>
                                        </button>
                                        <!-- The Popover Menu, controlled by Alpine.js -->
                                        <div x-show="show" 
                                        class="absolute top-full right-0 z-10 w-56 bg-white rounded-lg shadow-xl p-4 border border-gray-200 origin-top-right">
                                            <h3 class="text-md font-bold text-customIT mb-2">
                                                Choose an Action
                                            </h3>
                                            <div class="border-t border-gray-200 py-2">
                                                <ul class="space-y-2">
                                                    <li>
                                                        <a href="{{ route('view-profile', $grant->id) }}"  class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('grant-request') }}" class="block cursor-pointer px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-[#4C956C] font-medium">View All Request</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">No Request found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
                @include('components.pagination')
            </div>
            <!-- right side pane -->
            <div class="col-span-12 lg:col-start-9 lg:col-span-4 ">
                <!-- thi is where the data of the clicked row should appear-->
                <div class="flex flex-col bg-white shadow-lg rounded-md mt-2 overflow-auto">
                    <!-- Show default message if no user selected -->
                    <template x-if="!selectedUser">
                        <div class="p-4">
                            <h2 class="text-lg xl:text-2xl text-customIT font-semibold">Program Description</h2>
                            <p class="text-left text-sm text-bsctxt p-6">{{ $grant->description }}</p>
                        </div>
                    </template>

                    <!-- Show selected user details -->
                    <template x-if="selectedUser">
                        <div class="p-10 h-auto text-center"> 
                            <div class="flex flex-col items-center ">
                                <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                                    class="w-36 h-36 rounded-full shadow-md object-cover mb-4" />
                                <p class="text-[30px] text-customIT font-bold" x-text="selectedUser.name"></p>
                                <p class="text-btncolor">Registered Member</p>
                            </div>
                            <div class="text-left mx-6 mt-6">
                                <p class="text-md text-gray-600 font-semibold">ID NO: <span x-text="selectedUser.id" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="text-md text-gray-600 font-semibold">SECTOR: <span x-text="selectedUser.type" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="ttext-md text-gray-600 font-semibold">DOB: <span x-text="selectedUser.date" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="ttext-md text-gray-600 font-semibold">CONTACT NO: <span x-text="selectedUser.phone" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="ttext-md text-gray-600 font-semibold">EMAIL: <span x-text="selectedUser.email" class="text-sm ml-4 font-extralight text-bsctxt"></span></p>
                                <p class="text-md text-gray-600 font-semibold">REQUEST STATUS:<span class="text-xs text-white px-3 py-1 rounded-full ml-4 font-semibold"
                                :class="{
                                    'bg-approved': selectedUser.status === 'Approved',
                                    'bg-pending': selectedUser.status === 'Pending',
                                    'bg-rejected': selectedUser.status === 'Rejected'
                                    }"
                                x-text="selectedUser.status" class="text-sm font-extralight text-approved"></span></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        @include('components.modals.edit-grant')
        @include('components.modals.add-grant-stock')
        @include('components.modals.delete-grant')
        @include('components.modals.generate-report')
    </div>
@endsection