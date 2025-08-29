@extends('layouts.app')
@section('content')

<div class="p-4">
    <div class="bg-mainbg px-4 min-h-screen mr-0 w-full">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
        <div class="text-customIT flex flex-col">
            <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Registered Members</h2>
            <p class="text-sm text-gray-600">
                Manage, track, and update records of active and inactive SWISA members.
            </p>
        </div>
        @include('components.UserTab')
    </div>

    <!-- Dashboard Top Widgets + Member Demographics + Another Chart -->
    <div class="w-full grid grid-cols-1 lg:grid-cols-5 gap-2 mb-6">
        
    <!-- Column 1: Stats Widgets -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
        <!-- Total Members -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4">
            <!-- Icon -->
            <div class="p-2 bg-green-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#2C6E49" class="size-6">
                <path d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
                </svg>
            </div>
            <!-- Text -->
            <div>
                <h3 class="text-xl font-bold text-customIT">1,123</h3>
                <p class="text-gray-600 text-sm">Total Members</p>
            </div>
        </div>

        <!-- Pending Applications -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4">
            <!-- Icon -->
            <div class="p-2 bg-yellow-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#CA8A04" class="size-6">
                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                </svg>

            </div>
            <!-- Text -->
            <div>
                <h3 class="text-xl font-bold text-customIT">20</h3>
                <p class="text-gray-600 text-sm">Pending Applications</p>
            </div>
        </div>

        <!-- Rejected Applications -->
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-4">
            <!-- Icon -->
            <div class="p-2 bg-red-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="h-6 w-6 text-red-600" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <!-- Text -->
            <div>
                <h3 class="text-xl font-bold text-customIT">20</h3>
                <p class="text-gray-600 text-sm">Rejected Applications</p>
            </div>
        </div>
    </div>
    @include('charts.member-demographics')
    @include('charts.member-registrations')
    </div>
        @include('components.filters')


            <!-- Main Grid Layout -->
        <div class="grid gap-2 grid-cols-1 sm:grid-cols-1 lg:grid-cols-3 w-full">
            {{-- Active Members --}}
            <x-member-card
                status="active"
                name="Full Name"
                role="General Producer"
                memberId="123-456"
                registered="1/01/2023"
                meetings="Meetings: 10/10"
            />
            <x-member-card
                status="active"
                name="Full Name"
                role="General Producer"
                memberId="123-456"
                registered="1/01/2023"
                meetings="Meetings: 10/10"
            />
            <x-member-card
                status="active"
                name="Full Name"
                role="General Producer"
                memberId="123-456"
                registered="1/01/2023"
                meetings="Meetings: 10/10"
            />
            <x-member-card
                status="active"
                name="Full Name"
                role="General Producer"
                memberId="123-456"
                registered="1/01/2023"
                meetings="Meetings: 10/10"
            />
            <x-member-card
                status="active"
                name="Full Name"
                role="General Producer"
                memberId="123-456"
                registered="1/01/2023"
                meetings="Meetings: 10/10"
            />
            <x-member-card
                status="active"
                name="Full Name"
                role="General Producer"
                memberId="123-456"
                registered="1/01/2023"
                meetings="Meetings: 10/10"
            />

            {{-- Inactive Members --}}
            <x-member-card
                status="inactive"
                name="Full Name"
                role="General Producer"
                memberId="123-456"
                registered="1/01/2023"
                meetings="Meetings: 10/10"
            />
            <x-member-card
                status="inactive"
                name="Full Name"
                role="General Producer"
                memberId="123-456"
                registered="1/01/2023"
                meetings="Meetings: 10/10"
            />
            <x-member-card
                status="inactive"
                name="Full Name"
                role="General Producer"
                memberId="123-456"
                registered="1/01/2023"
                meetings="Meetings: 10/10"
            />
        </div>
    </div> 
</div>
</div>


@endsection
