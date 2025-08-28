@extends('layouts.sidebar')
@section('content')
<body class="bg-mainbg px-2">
    <div class="text-customIT text-2xl flex justify-between items-center mb-4">
        <h1 class="font-bold">Initiatives & Events</h1>
        <h1>Monday, 00 Month 2025</h1>
    </div>

    @include('components.filters')
    
    <!-- Example of using the reusable component -->
    <div class="pt-2 bg-gray-100 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
        <!-- Card with specific data -->
        <x-cards.training-card
            title="Suntukan sa B4"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            participants="24"
        />
        <x-cards.training-card
            title="Suntukan sa B4"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            participants="24"
        />
        <x-cards.training-card
            title="Suntukan sa B4"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            participants="24"
        />
        <x-cards.training-card
            title="Suntukan sa B4"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            participants="24"
        />
        <x-cards.training-card
            title="Suntukan sa B4"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            participants="24"
        />
        <x-cards.training-card
            title="Suntukan sa B4"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            participants="24"
        />
    </div>

</body>
@endsection
