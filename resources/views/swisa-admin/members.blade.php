@extends('layouts.sidebar')
@section('content')
<body class="bg-mainbg px-2">
    <div class="text-customIT text-2xl flex justify-between items-center mb-4">
        <h1 class="font-bold">Registered Members</h1>
        <h1>Monday, 00 Month 2025</h1>
    </div>

    @include('components.filters')

        <div class="mt-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                {{-- For demonstration, hardcoded cards are used --}}
                
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
</body>    
@endsection
