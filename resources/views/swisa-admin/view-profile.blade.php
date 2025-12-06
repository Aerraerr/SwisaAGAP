@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')
<div class="p-4">
    <div class="bg-mainbg px-2">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">View Profile</h2>
                <p class="text-sm text-gray-600">See detailed information about the selected member’s profile.</p>

            </div>
        </div>
    </div>
    @include('components.breadcrumbs', [
        'params' => isset($grant) ? [$grant, $member] : [$member]
    ])
        <div class="grid grid-cols-1 md:grid-cols-8 xl:grid-cols-12 gap-2 xl:gap-3">
            <!-- left part-->
            <div class="col-span-12 md:col-span-3">
                <div class="bg-white shadow-lg flex justify-center pt-3 rounded-md">
                    <div class="flex flex-col items-center m-2">
                        <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                        class="w-30 h-30 md:w-28 md:h-28 lg:w-36 lg:h-36 xl:w-40 xl:h-40 rounded-full shadow-md object-cover mb-2" />
                        <h3 class="text-lg xl:text-xl font-semibold text-customIT">{{ ucfirst($member->first_name) }} {{ ucfirst($member->middle_name) }} {{ ucfirst($member->last_name) }}</h3>
                        <p class="text-sm text-gray-700 font-medium">{{ $member->user_info->sector->sector_name ?? '-'}}</p>
                        <div class="flex">
                            <p class="text-xs text-gray-500 mt-2">{{ $member->formatted_id}} </p>
                            <button><img src="{{ asset('images/copy-svg.svg') }}" alt="copy" class="w-8 h-8" /></button>
                        </div>
                    </div>
                </div>
                <div class="bg-white shadow-lg  mt-3 p-3 rounded-md">
                    <div class="flex flex-col text-customIT font-medium items-center gap-2">
                        <button class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">Send message </button>
                        <button onclick="openModal('viewApplicationModal')" class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">View All Application </button>
                        <button onclick="openModal('activityLogsModal')" class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">View Logs </button>
                        <!--<button class="w-full py-2 px-3 border-[3px] border-btncolor rounded-md items-center shadow hover:bg-btncolor hover:text-white">Edit Profile </button>-->
                    </div>
                </div>
            </div>
            <!--tab content middle part -->
            <div class="col-span-12 md:col-span-5 xl:col-span-6">
                <!--tab content upper middle part -->
                <div x-data="{ showDetails: false }" class="md:col-span-5 bg-white shadow-lg w-full md:h-auto lg:h-auto xl:h-auto mb-3 py-4 px-6 rounded-md">
                    <div class="text-customIT text-sm md:text-lg flex justify-between items-center mb-3">
                        <h1 class="font-bold">Basic Information</h1>
                    </div>
                    <div class="grid grid-cols-4 md:grid-cols-2 lg:grid-cols-4 items-center mb-3 text-xs md:text-sm lg:text-md">
                        <div class="col-start-1">
                            <p class="text-customIT font-semibold ">Full Name</p>
                            <p class="text-gray-700 font-medium">{{ ucfirst($member->first_name) }} {{ ucfirst($member->middle_name) }} {{ ucfirst($member->last_name) }}</p>
                        </div>
                        <div class="col-start-2">
                            <p class="text-customIT font-semibold">Member Type</p>
                            <p class="text-gray-700 font-medium">{{ $member->user_info->sector->sector_name ?? '-'}}</p>
                        </div>
                        <div class="col-start-3 md:col-start-1 lg:col-start-3">
                            <p class="text-customIT font-semibold">Joined Since</p>
                            <p class="text-gray-700 font-medium">{{ $member->created_at->format('F d Y')}}</p>
                        </div>
                        <div class="justify-center col-start-4 md:col-start-2 lg:col-start-4">
                            <p class="text-customIT font-semibold">Membership Status</p>
                            <p class="inline-block text-xs font-medium bg-approved text-white px-4 py-1 rounded-full">
                                Active
                            </p>
                        </div>
                    </div>
                    <div class="text-customIT flex grid grid-cols-4 md:grid-cols-2 lg:grid-cols-4 items-center text-xs md:text-xs lg:text-md mb-3">
                        <div class="col-start-1">
                            <p class="text-customIT font-semibold">Gender</p>
                            <p class="text-gray-700 font-medium">{{ $member->user_info->gender ?? '-'}}</p>
                        </div>
                        <div class="col-start-2 lg:col-start-2">
                            <p class="text-customIT font-semibold">Birthday</p>
                            <p class="text-gray-700">{{ $member->user_info->birthdate ?? '-'}}</p>
                        </div>
                        <div class="col-start-1 lg:col-start-3">
                            <p class="text-customIT font-semibold">Civil Stats</p>
                            <p class="text-gray-700 font-medium">{{ $member->user_info->civil_status ?? '-'}}</p>
                        </div>
                    </div>
                    <div class="text-customIT grid grid-cols-4 md:grid-cols-2 lg:grid-cols-4 items-center text-xs md:text-xs lg:text-md  mb-3">
                        <div class="col-start-1 col-span-2">
                            <p class="text-customIT font-semibold">Address</p>
                            <p class="text-gray-700 font-medium">
                                {{ ucfirst($member->user_info->house_no) ?? ''}} 
                                {{ ucfirst($member->user_info->zone) ?? ''}}, 
                                {{ ucfirst($member->user_info->barangay) ?? ''}}, 
                                {{ ucfirst($member->user_info->city) ?? ''}}, 
                                {{ ucfirst($member->user_info->province) ?? ''}}
                            </p>
                        </div>
                        <div class="col-start-1 lg:col-start-3">
                            <p class="text-customIT font-semibold">Contact Number</p>
                            <p class="text-gray-700 font-medium">
                                <span>{{ $member->user_info->phone_no ?? '-'}}</span>
                            </p>
                        </div>
                        <div class="col-start-2 lg:col-start-4">
                            <p class="text-customIT font-semibold">Email</p>
                            <p class="text-gray-700 font-medium">
                                <span>{{ $member->email}}</span>
                            </p>
                        </div>
                    </div>
                    <div class="text-customIT text-sm md:text-lg mb-3">
                        <h1 class="font-bold">Second Contact Information</h1>
                    </div>
                    <div class="text-customIT grid grid-cols-4 items-center text-xs md:text-xs lg:text-md mb-3">
                        <div class="col-start-1">
                            <p class="text-customIT font-semibold">Second Contact</p>
                            <p class="text-gray-700 font-medium">
                                {{ ucfirst($member->user_info->sc_fname) ?? '-'}}
                                {{ ucfirst($member->user_info->sc_mname) ?? ' '}}
                                {{ ucfirst($member->user_info->sc_lname) ?? '-'}}
                                {{ ucfirst($member->user_info->suffix) ?? ' '}}
                            </p>
                        </div>
                        <div class="col-start-2">
                            <p class="text-customIT font-semibold">Contact Number</p>
                            <p class="text-gray-700 font-medium">
                                <span>{{ $member->user_info->sc_phone_no ?? '-'}}</span>
                            </p>
                        </div>
                        <div class="col-start-1 lg:col-start-3">
                            <p class="text-customIT font-semibold">Email</p>
                            <p class="text-gray-700 font-medium">
                                <span>{{ $member->user_info->sc_email ?? '-'}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <!--tab content lower middle part -->
                <div class="md:col-span-12 bg-white shadow-lg xl:h-[50vh] overflow-auto p-4 rounded-md">
                    <div class="text-customIT text-lg flex justify-between mb-2">
                        <h1 class="font-bold">Grant and Equipment History</h1>
                    </div>
                    <div class="overflow-auto">
                        <table class="min-w-full border-spacing-y-1">
                        <thead class="bg-snbg">
                            <tr class="text-customIT text-left text-sm font-semibold">
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">ITEM</th>
                                <th class="px-4 py-2">TYPE</th>
                                <th class="px-4 py-2">REASON</th>
                                <th class="px-4 py-2">SUBMITTED AT</th>
                                <th class="px-4 py-2">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(optional($member->applications)->where('application_type', 'Grant Application') as $application)
                                <tr class="border border-gray-300">
                                    <td class="px-4 py-2 text-xs text-gray-700">{{ $application->formatted_id }}</td>
                                    <td class="px-4 py-2 text-xs text-gray-700">{{ $application->grant->title ?? '-'}}</td>
                                    <td class="px-4 py-2 text-xs text-gray-700">{{ $application->grant->grant_type->grant_type ?? '-'}}</td>
                                    <td class="px-4 py-2 text-xs text-gray-700 font-medium">{{ $application->purpose ?? '-' }}</td>
                                    <td class="px-4 py-2 text-xs text-gray-700">{{ $application->created_at->format('F d Y') }}</td>
                                    <td class="px-4 py-3 ">
                                        <div class="inline-block text-xs font-medium text-center px-3 py-1 rounded-full
                                            {{ $application->status->status_name === 'approved' ? 'bg-approved text-white' : '' }}
                                            {{ $application->status->status_name === 'pending' ? 'bg-pending text-white' : '' }}
                                            {{ $application->status->status_name === 'rejected' ? 'bg-rejected text-white' : '' }}
                                            {{ $application->status->status_name === 'completed' ? 'bg-approved text-white' : '' }}
                                            {{ $application->status->status_name === 'processing_application' ? 'bg-pending text-white' : '' }}
                                        ">
                                            {{ ucfirst($application->status->status_name) ?? '-' }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-3 text-md text-gray-500 text-center">No Grant Applications</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--tab contents right part -->
            <div class="col-span-12 md:col-start-4 md:col-span-5 xl:col-span-3">
                <!--tab contents upper right part -->
                <div class="bg-white p-4 h-auto mb-3 rounded-md shadow-lg">
                        <h2 class="text-md font-semibold text-customIT">Program Participation Summary</h2>
                        <div class="grid grid-cols-2 p-4 md:py-8 lg:py-12">
                            <div class="col-start-1 gap-2 text-md md:text-xs mt-6 md:p-8 lg:p-1">
                                <div class="flex text-btncolor gap-2 mb-2 md:gap-1">
                                    <p class="w-6 h-6 md:w-3 md:h-3 rounded-full bg-btncolor"></p> 
                                    <p>Programs Joined</p>
                                </div>
                                <div class="flex text-iconsClr gap-2 md:gap-1">
                                    <p class="w-6 h-6 md:w-3 md:h-3 rounded-full bg-iconsClr"></p>
                                    <p>Completion</p>
                                </div>
                            </div>
                            <div class="col-start-2 xl:col-start-2">
                                <canvas id="programChart" class="w-[150px] h-[150px] md:w-[150px] md:h-[150px] lg:w-[160px] lg:h-[160px]"></canvas>
                            </div>
                        </div>
                </div>
                <!--tab contents lower right part -->
                <div class="bg-white px-4 py-4 overflow-auto xl:h-[50vh] rounded-md shadow-lg flex flex-col">
                        <h2 class="text-ms md:text-lg font-semibold text-customIT mb-4 border-b pb-2 shrink-0">Attached Documents</h2>
                        <div class="overflow-auto flex-1 pr-2">
                            <ul class="space-y-1 text-sm">
                            @foreach($member->applications  as $application)
                                @foreach($application->documents as $document)
                                    <li class="flex justify-between items-center">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-700 font-medium block w-62 truncate" title="{{ $document->file_name ?? 'Document' }}">{{ $document->file_name ?? 'Document'}}</p>
                                            <p class="text-xs text-gray-500">date uploaded:{{ $document->created_at->format(' F d Y')}}</p>
                                        </div>
                                        <div class="flex gap-4 text-xs text-customIT font-medium">
                                            <a href="{{ asset('storage/'.$document->file_path) }}" download><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            @endforeach
                            </ul>
                        </div>
                </div>
            </div>
        </div>
        @include('components.modals.grant-overview')
        @include('components.modals.view-applications')
        @include('components.modals.view-logs')
        @include('components.modals.view-reason')
       
    </div>
</div>
   <script>
        const programJoined = @json($programsJoined);
        const completion = @json($completion);

        const ctx = document.getElementById('programChart');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Programs Joined', 'Completion'],
                datasets: [{
                    data: [programJoined, completion],
                    backgroundColor: ['#4C956C', '#68B2AB']
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false } 
                }
            }
        });
    </script>
@endsection