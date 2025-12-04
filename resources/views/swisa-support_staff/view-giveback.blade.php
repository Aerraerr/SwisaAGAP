@extends('layouts.app')
@section('content')
<div class="p-4">
    <div class="bg-mainbg px-2">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">View Giveback</h2>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-2">
        <!-- left part -->
        <div class="col-span-12 lg:col-span-8 space-y-2">
            <!-- Top left part -->
            <div class="bg-white shadow-lg rounded-md p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-2xl lg:text-3xl font-bold text-customIT">{{  $giveback->application->grant->title ?? '-'}}</p>
                        <p class="text-sm text-bsctxt">ID: {{ $giveback->id}}</p>
                    </div>
                    @if($giveback->status->status_name === 'pending')
                        <div>
                            <button onclick="openModal('receivedModal')" class="border border-btncolor text-sm text-btncolor rounded-full py-1.5 px-3 hover:bg-btncolor hover:text-white transition-colors">Received?</button>
                        </div>
                    @else
                        <div>
                            <p class="text-sm rounded-full py-1.5 px-3 bg-btncolor text-white">Received</p>
                        </div>
                    @endif
                </div>
            </div>
            <!--  Buttom left part -->
            <div class="bg-white shadow-lg rounded-md space-y-6 px-6 py-8">
                <div class="">
                    <p class="text-xl font-bold text-customIT mb-2">Giveback Information</p>
                    <div class="ml-4 space-y-1 ">
                        <p class="text-sm text-gray-600 font-medium">Contribution Type:<span class="text-sm ml-4 font-extralight text-bsctxt">{{ $giveback->application->grant->grant_type->grant_type}}</span></span>
                        <p class="text-sm text-gray-600 font-medium">Contribution Quantity:<span class="text-sm ml-4 font-extralight text-bsctxt">{{ $giveback->quantity}}</span></p>
                        <p class="text-sm text-gray-600 font-medium">Contribution Source:<span class="text-sm ml-4 font-extralight text-bsctxt">{{ $giveback->application->application_type}}</span></p>
                        <p class="text-sm text-gray-600 font-medium">Contribution Date:<span class="text-sm ml-4 font-extralight text-bsctxt">{{ $giveback->created_at->format('M d, Y')}}</span></p>
                    </div>
                </div>
                <div>
                    <p class="font-medium text-gray-700 mb-1">User Notes:</p>
                    <div class="border shadow rounded-md px-3 py-4">
                        <p class="text-sm text-bsctxt mt-1">
                            {{ $giveback->notes}}
                        </p>
                    </div>
                </div>
               <div>
                    <p class="font-medium text-gray-700">Report Proof:</p>

                    {{-- Main preview image (first proof) --}}
                    @if($giveback->image_path)
                        <div class="mt-2 bg-gray-200 h-72 rounded-md flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('storage/' . $giveback->image_path) }}" 
                                alt="Proof Image" 
                                class="h-full w-full object-cover rounded-md">
                        </div>
                    @else
                        <div class="mt-2 bg-gray-200 h-72 rounded-md flex items-center justify-center text-gray-500">
                            No Image Available
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- right part -->
        <div class="col-span-12 lg:col-span-4 space-y-2">
            <!-- Top right part -->
            <div class="flex flex-col items-center bg-white shadow-lg rounded-md py-6 ">
                <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                    class="w-30 h-30 md:w-28 md:h-28 lg:w-36 lg:h-36 xl:w-40 xl:h-40 rounded-full shadow-md mb-2" />   
                <p class="text-2xl font-bold text-customIT">{{ $giveback->user->first_name ?? '-'}} {{ $giveback->user->middle_name ?? '-'}} {{ $giveback->user->last_name ?? '-'}}</p>
                <p class="text-sm text-bsctxt mb-4">REGISTERED MEMBER</p>
                <div class="grid grid-cols-4">
                    <div class="col-start-1 col-span-3">
                        <p class="text-md text-gray-600 font-semibold">ID NO :<span class="text-sm ml-4 font-extralight text-bsctxt">{{$giveback->user->formatted_id ?? '-'}}</span></span>
                        <p class="text-md text-gray-600 font-semibold">SECTOR :<span class="text-sm ml-4 font-extralight text-bsctxt">{{ $giveback->user->user_info->sector->sector_name ?? '-'}}</span></p>
                        <p class="text-md text-gray-600 font-semibold">DOB :<span class="text-sm ml-4 font-extralight text-bsctxt">{{ $giveback->user->user_info->birthdate ?? '-'}}</span></p>
                        <p class="text-md text-gray-600 font-semibold">PHONE :<span class="text-sm ml-4 font-extralight text-bsctxt">{{ $giveback->user->user_info->phone_no ?? '-'}}</span></p>
                        <p class="text-md text-gray-600 font-semibold">EMAIL :<span class="text-sm ml-4 font-extralight text-bsctxt">{{ $giveback->user->email ?? '-'}}</span></p>
                    </div>
                    
                </div>
            </div>
            <!-- buttom right part -->
            <div class="flex flex-col h-auto items-center bg-white shadow-lg rounded-md py-6 px-4">
                <p class="text-xl font-bold text-customIT w-full">Giveback History</p>
                <div class="space-y-4 w-full lg:overflow-y-auto">
                    <!-- Reports-->
                    @forelse($givebackHistory as $history)
                        <div class="p-4 border-b">
                            <div class="flex justify-between items-center">
                                <p class="font-semibold text-md text-customIT">{{ $history->application->grant->title ?? 'Untitled Grant' }} : {{ $history->created_at->format('M d, Y') }}</p>
                                <div class="text-xs px-3 py-1 {{ $history->status->status_name == 'received' ? 'bg-approved' : 'bg-pending' }} text-white rounded-full"> {{ $history->status->status_name ?? '-' }} </div>
                            </div>
                            <p class="font-medium text-sm text-gray-700">Contribution Quantity: {{ $history->quantity ?? '-' }}</p>
                            <div class="mt-2">
                                <p class="font-medium text-sm text-gray-700">User Notes:</p>
                                <div class="items-right border border-gray-200 rounded-md shadow px-2 py-4 ">
                                    <p class="text-xs text-bsctxt mt-1">
                                        {{ $history->notes ?? '-'}}
                                    </p>
                                </div>
                                <button class="text-xs text-bsctxt mr-2 hover:text-customIT hover:underline">Giveback proof</button>
                            </div>
                        </div>
                    @empty
                        No report history
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @include('components.modals.received-modal')
</div>
@endsection