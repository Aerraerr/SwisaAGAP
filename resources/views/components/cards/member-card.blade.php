@props(['status' => 'active', 'name', 'role', 'memberId', 'registered'])

@php
    $statusColor = $status === 'active' ? 'bg-approved' : 'bg-rejected';
@endphp

<div class="w-full bg-white p-4 sm:p-6 rounded-xl shadow-lg flex flex-col space-y-6">
    <!-- Top Section -->
    <div class="flex flex-col sm:flex-row items-center sm:items-start sm:space-x-5 space-y-4 sm:space-y-0">
        <!-- Profile Image -->
        <div>
            <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                class="w-20 h-20 sm:w-16 sm:h-16 rounded-full shadow-md object-cover" />
        </div>

        <!-- Admin Access: Member Card -->
        <div class="flex-grow sm:text-left">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-xl font-bold text-customIT break-words">{{ $name }}</h3>
                <span class="text-xs font-medium text-white text-center px-3 py-1 rounded-full {{ $statusColor }}">{{ ucfirst($status) }}</span>
            </div>
            <p class="text-xs sm:text-sm text-gray-600 font-light pb-4">{{ $role }}</p>
            <p class="text-xs font-medium sm:text-sm text-gray-700">Member ID:<span class="text-gray-600 ml-1">{{ $memberId }}</span></p>
            <!-- Registered Date -->
            <div class="sm:text-left text-xs sm:text-sm text-gray-600">
                <p class="text-xs font-medium sm:text-sm text-gray-700">Registered:<span class="text-gray-600 ml-1">{{ $registered }}</span></p>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="flex flex-col sm:flex-row justify-between gap-2">
        <a href="{{ route('view-profile') }}" 
           class="flex-1 p-2 text-xs sm:text-sm text-center font-medium text-customIT bg-snbg rounded-[3px] hover:bg-opacity-80 transition">
            View Profile
        </a>
        <button onclick="openModal('viewApplicationModal')"
           class="flex-1 p-2 text-xs sm:text-sm text-center font-medium text-white bg-btncolor rounded-[3px] hover:bg-customIT transition">
            View Applications
        </button>
    </div>
</div>
