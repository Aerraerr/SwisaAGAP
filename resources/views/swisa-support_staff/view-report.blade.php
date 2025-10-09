@extends('layouts.app')
@section('content')
<div class="p-4">
    <div class="bg-mainbg px-2">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">View Report</h2>
            </div>
            @include('components.UserTab')
        </div>
    </div>

    <div class="grid grid-cols-12 gap-2">
        <!-- left part -->
        <div class="col-span-12 lg:col-span-8 space-y-2">
            <!-- Top left part -->
            <div class="bg-white shadow-lg rounded-md p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-2xl lg:text-3xl font-bold text-customIT">{{ $grantReport->application->grant->title ?? '-'}}</p>
                        <p class="text-sm text-bsctxt">ID:{{ $grantReport->application->id}}</p>
                    </div>
                    <div>
                        <button onclick="openModal('updateStatusModal')" class="border border-btncolor text-sm text-btncolor rounded-full py-1.5 px-3 hover:bg-btncolor hover:text-white transition-colors">Update</button>
                    </div>
                </div>
            </div>
            <!--  Buttom left part -->
            <div class="bg-white  shadow-lg rounded-md space-y-6 px-6 py-8">
                <div class="flex justify-between items-center">
                    <p class="text-lg font-semibold text-customIT">Latest Report:{{ $grantReport->updated_at->format('M d, Y') ?? '-'}}</p>
                    <div class="text-xs px-2 py-1 bg-tbr text-gray-700 border rounded-full">To be reviewed</div>
                </div>
                <div>
                    <p class="font-medium text-gray-700 mb-1">User Notes:</p>
                    <div class="border shadow rounded-md px-3 py-4">
                        <p class="text-sm text-bsctxt mt-1">
                            {{ $grantReport->notes ?? '-'}}
                        </p>
                    </div>
                </div>
                <div>
                    <p class="font-medium text-gray-700">Report Proof:</p>

                    {{-- Main preview image (first proof) --}}
                    @if($grantReport->documents && $grantReport->documents->count() > 0)
                        <div class="mt-2 bg-gray-200 h-72 rounded-md flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('storage/' . $grantReport->documents->first()->file_path) }}" 
                                alt="Proof Image" 
                                class="h-full w-full object-cover rounded-md">
                        </div>
                    @else
                        <div class="mt-2 bg-gray-200 h-72 rounded-md flex items-center justify-center text-gray-500">
                            No Image Available
                        </div>
                    @endif

                    {{-- Thumbnail images --}}
                    <div class="flex space-x-2 mt-2 text-xs">
                        @foreach($grantReport->documents as $proof)
                            <div class="bg-gray-200 h-16 w-16 flex items-center justify-center overflow-hidden rounded-md">
                                <img src="{{ asset('storage/' . $proof->file_path) }}" 
                                    alt="Proof Thumbnail" 
                                    class="h-full w-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- right part -->
        <div class="col-span-12 lg:col-span-4 space-y-2">
            <!-- Top right part -->
            <div class="flex flex-col items-center bg-white shadow-lg rounded-md py-6">
                <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                    class="w-30 h-30 md:w-28 md:h-28 lg:w-36 lg:h-36 xl:w-40 xl:h-40 rounded-full shadow-md mb-2" />   
                <p class="text-2xl font-bold text-customIT">{{ $grantReport->application->user->name ?? '-'}}</p>
                <p class="text-sm text-bsctxt">REGISTERED MEMBER</p>
                <div><p class="text-lg font-medium text-customIT py-4">ITEM INFORMATION</p></div>
                <div class="grid grid-cols-2 space-x-2">
                    <div class="col-start-1 text-sm space-y-1 text-gray-700">
                        <p class="text-md text-gray-600 font-semibold">Item Name :<span class="text-sm ml-4 font-extralight text-bsctxt">{{ $grantReport->application->grant->title ?? '-'}}</span></span>
                        <p class="text-md text-gray-600 font-semibold">Item Type :<span class="text-sm ml-4 font-extralight text-bsctxt">{{ $grantReport->application->grant->grant_type->grant_type ?? '-'}}</span></span>
                        <p class="text-md text-gray-600 font-semibold">Item ID :<span class="text-sm ml-4 font-extralight text-bsctxt">ITEM-{{ $grantReport->application->grant->id ?? '-'}}</span></span>
                    </div>
                    <div class="col-start-2 text-sm space-y-1 text-gray-700">
                        <p class="text-md text-gray-600 font-semibold">Applied at :<span class="text-sm ml-4 font-extralight text-bsctxt">{{ $grantReport->application->created_at->format('M d, Y') ?? '-'}}</span></span>
                        <p class="text-md text-gray-600 font-semibold">Return date :<span class="text-sm ml-4 font-extralight text-bsctxt">25 Sept 2025</span></span>
                        <p class="text-md text-gray-600 font-semibold">Next report :<span class="text-sm ml-4 font-extralight text-bsctxt">25 Oct 2025</span></span>
                    </div>
                </div>
            </div>
            <!-- buttom right part -->
            <div class="flex flex-col h-auto items-center bg-white shadow-lg rounded-md py-6 px-4">
                <p class="text-xl font-bold text-customIT w-full">Reports History</p>
                <div class="space-y-4 w-full overflow-y-auto">
                    <!-- Reports-->
                    @forelse($reportHistory as $history)
                        <div class="p-4 border-b">
                            <div class="flex justify-between items-center">
                                <p class="font-semibold text-md text-customIT">Report #1:{{ $history->created_at->format('M d, Y') ?? '-'}}</p>
                                <div class="text-xs px-3 py-1  px-3 py-1 bg-approved text-white rounded-full">Good</div>
                            </div>
                            <div class="mt-2">
                                <p class="font-medium text-sm text-gray-700">User Notes:</p>
                                <div class="items-right border border-gray-200 rounded-md shadow px-2 py-4 ">
                                    <p class="text-xs text-bsctxt mt-1">
                                        {{ $history->notes ?? '-'}}
                                    </p>
                                </div>
                                <button class="text-xs text-bsctxt mr-2 hover:text-customIT hover:underline">Report proof</button>
                                <button class="text-xs text-bsctxt hover:text-customIT hover:underline">Staff note</button>
                            </div>
                        </div>
                    @empty
                        No report history
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @include('components.modals.update-status')
</div>
@endsection