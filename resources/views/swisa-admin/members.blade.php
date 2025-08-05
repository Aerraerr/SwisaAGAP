@extends('layouts.sidebar')
@section('content')
    <div>
        Registered Members
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Members') }}
        </h2>
    </x-slot>

        <div class="p-4 sm:p-6 lg:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- For demonstration, hardcoded cards are used --}}
                
                {{-- Active Members --}}
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="Registered: 1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="Registered: 1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="Registered: 1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="Registered: 1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="Registered: 1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="Registered: 1/01/2023"
                    meetings="Meetings: 10/10"
                />

                {{-- Inactive Members --}}
                <x-member-card
                    status="inactive"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="Registered: 1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="inactive"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="Registered: 1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="inactive"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="Registered: 1/01/2023"
                    meetings="Meetings: 10/10"
                />

            </div>
        </div>
@endsection
