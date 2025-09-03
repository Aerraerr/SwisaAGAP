@props(['status' => 'active', 'name', 'role', 'memberId', 'registered'])

@php
    $statusColor = $status === 'active' ? 'text-green-600' : 'text-red-600';
@endphp

<div class="w-full max-w-full sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl bg-white p-4 sm:p-6 rounded-xl shadow-lg flex flex-col space-y-6">
    <!-- Top Section -->
    <div class="flex flex-col sm:flex-row items-center sm:items-start sm:space-x-5 space-y-4 sm:space-y-0">
        <!-- Profile Image -->
        <div>
            <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                class="w-20 h-20 sm:w-16 sm:h-16 rounded-full shadow-md object-cover" />
        </div>

        <!-- Name, Status, Role -->
        <div class="flex-grow text-center sm:text-left">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-lg font-bold text-customIT break-words">{{ $name }}</h3>
                <span class="text-sm font-bold {{ $statusColor }}">{{ ucfirst($status) }}</span>
            </div>
            <p class="text-xs sm:text-sm text-gray-600">{{ $role }}</p>
            <p class="text-xs sm:text-sm text-gray-600">Member: {{ $memberId }}</p>
        </div>
    </div>

    <!-- Registered Date -->
    <div class="text-center sm:text-left text-xs sm:text-sm text-gray-600">
        <span>Registered: {{ $registered }}</span>
    </div>

    <!-- Buttons -->
    <div class="flex flex-col sm:flex-row justify-between gap-2">
        <a href="{{ route('view-profile') }}" 
           class="flex-1 p-2 text-xs sm:text-sm text-center font-medium text-customIT bg-snbg rounded-md hover:bg-gray-100 transition">
            View Profile
        </a>
        <a href="#" 
           class="flex-1 p-2 text-xs sm:text-sm text-center font-medium text-white bg-btncolor rounded-md hover:bg-green-700 transition">
            View Applications
        </a>
    </div>
</div>
