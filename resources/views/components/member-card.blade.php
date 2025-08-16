@props(['status' => 'active', 'name', 'role', 'memberId', 'registered'])

@php
    $statusColor = $status === 'active' ? 'text-customIT' : 'text-red-600';
@endphp

<div class="bg-white p-6 rounded-md shadow-xl flex flex-col space-y-2">
    <div class="flex items-center space-x-4">
        <div>
            <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
             class="w-16 h-16 rounded-full shadow-md object-cover" />
        </div>
        <div class="flex-grow">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-customIT">{{ $name }}</h3>
                <span class="text-sm font-bold {{ $statusColor }}">{{ ucfirst($status) }}</span>
            </div>
            <p class="text-xs text-gray-600">{{ $role }}</p>
            <p class="text-xs text-gray-600">Member: {{ $memberId }}</p>
        </div>
    </div>
    
    <div class="flex justify-between ml-20 text-xs text-gray-600">
        <span>Registered: {{ $registered }}</span>
    </div>

    <div class="flex justify-between space-x-2">
        <a href="view-profile" class="flex-1 p-2 text-xs text-center font-medium text-customIT bg-snbg rounded-md hover:bg-gray-100 transition">View Profile</a>
        <a href="#" class="flex-1 p-2 text-xs text-center font-medium text-white bg-btncolor rounded-md hover:bg-green-700 transition">View Applications</a>
    </div>
</div>