@extends('layouts.sidebar')
@section('content')
<body class="bg-mainbg px-2">
    <div class="text-customIT text-2xl flex justify-between items-center mb-4">
        <h1 class="font-bold">Available Grants & Equipments</h1>
        <h1>Monday, 00 Month 2025</h1>
    </div>

    @include('components.filters')

    <!-- Example of using the reusable component -->
    <div class="pt-2 bg-gray-100 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
        <!-- Card with specific data -->
        <x-grant-card
            title="Pangkagkag ni Peter"
            category="Machinery"
            stockAvailable="12"
            pendingRequests="24"
            approved="6"
            addedOn="12 units"
            lastUpdated="24"
            eligibility="Registered Members"
            allocationPercentage="50"
        />

        <!-- Another card with different data -->
        <x-grant-card
            title="Another Grant"
            category="Agriculture"
            stockAvailable="5"
            pendingRequests="10"
            approved="3"
            addedOn="10 units"
            lastUpdated="15"
            eligibility="All Members"
            allocationPercentage="30"
        />

        <!-- A third card -->
        <x-grant-card
            title="Third Grant"
            category="Technology"
            stockAvailable="20"
            pendingRequests="15"
            approved="10"
            addedOn="20 units"
            lastUpdated="18"
            eligibility="New Members"
            allocationPercentage="75"
        />
        <x-grant-card
            title="Pangkagkag ni Peter"
            category="Machinery"
            stockAvailable="12"
            pendingRequests="24"
            approved="6"
            addedOn="12 units"
            lastUpdated="24"
            eligibility="Registered Members"
            allocationPercentage="50"
        />
        <x-grant-card
            title="Pangkagkag ni Peter"
            category="Machinery"
            stockAvailable="12"
            pendingRequests="24"
            approved="6"
            addedOn="12 units"
            lastUpdated="24"
            eligibility="Registered Members"
            allocationPercentage="50"
        />
        <x-grant-card
            title="Pangkagkag ni Peter"
            category="Machinery"
            stockAvailable="12"
            pendingRequests="24"
            approved="6"
            addedOn="12 units"
            lastUpdated="24"
            eligibility="Registered Members"
            allocationPercentage="50"
        />
    </div>

</body>
@endsection
