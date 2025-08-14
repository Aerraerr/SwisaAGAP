@props(['status' => 'active', 'name', 'role', 'memberId', 'registered'])

@php
    $statusColor = $status === 'active' ? 'text-customIT' : 'text-red-600';
@endphp

<div class="bg-white p-6 rounded-md shadow-xl flex flex-col space-y-2">
    <div class="flex items-center space-x-4">
        <div class="h-16 w-16 bg-gray-200 rounded-full flex items-center justify-center">
            <svg class="h-16 w-16 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 4a4 4 0 100 8 4 4 0 000-8zm0 10c4.418 0 8 1.79 8 4v2H4v-2c0-2.21 3.582-4 8-4z"/>
            </svg>
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
        <a href="#" class="flex-1 p-2 text-xs text-center font-medium text-customIT bg-snbg rounded-md hover:bg-gray-100 transition">View Profile</a>
        <a href="#" class="flex-1 p-2 text-xs text-center font-medium text-white bg-btncolor rounded-md hover:bg-green-700 transition">View Applications</a>
    </div>
</div>