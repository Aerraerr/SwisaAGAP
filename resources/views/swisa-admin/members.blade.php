@extends('layouts.app')
@section('content')

<div class="pt-4">
    <div class="bg-mainbg px-4 min-h-screen">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <!-- Left side -->
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Registered Members</h2>
                <p class="text-sm text-gray-600">Manage, track, and update records of active and inactive SWISA members.</p>
            </div>
            
            <!-- Right side -->
            @include('components.UserTab')
        </div>

        <!-- Main Grid Layout -->
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 w-full">
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

@endsection
