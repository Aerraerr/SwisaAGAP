@props(['status', 'name', 'role', 'cont_type', 'cont_quantity', 'cont_source', 'cont_date'])


<div class="w-full bg-white p-4 sm:p-6 rounded-xl shadow-lg flex flex-col space-y-6">
    <!-- Top Section -->
    <div class="flex flex-col sm:flex-row items-center sm:items-start sm:space-x-5 space-y-4 sm:space-y-0">
        <!-- Profile Image -->
        <div>
            <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                class="w-20 h-20 sm:w-16 sm:h-16 rounded-full shadow-md object-cover" />
        </div>

        <!-- Admin Access: Member Card -->
        <div class="flex-grow text-left">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-xl font-bold text-customIT break-words">{{ $name }}</h3>
                <span class="text-xs font-medium text-white text-center px-3 py-1 rounded-full">{{ ($status) }}</span>
            </div>
            <p class="text-xs sm:text-sm text-gray-600 font-light pb-4">{{ $role }}</p>
        </div>
    </div>
    <div class="text-sm text-gray-700 mb-2 ml-2">
        <!-- Stock Summary Section -->
        <h4 class="font-semibold text-customIT flex items-center mb-1">Giveback Info</h4>
        <p class="font-medium">Contribution Type: <span class="text-gray-600 ml-1">{{ $cont_type }}</span></p>
        <p class="font-medium">Contribution Quantity: <span class="text-gray-600 ml-1">{{ $cont_quantity }}</span></p>
        <p class="font-medium">Contribution Source: <span class="text-gray-600 ml-1">{{ $cont_source }}</span></p>
        <p class="font-medium">Contribution Date: <span class="text-gray-600 ml-1">{{ $cont_date }}</span></p>
    </div>
    <!-- Buttons -->
    <div class="grid grid-cols-2 sm:flex-row justify-between gap-2">
        <button onclick="openModal('viewApplicationModal')"
           class="col-start-2 p-2 text-xs sm:text-sm text-center font-medium text-white bg-btncolor rounded-[3px] hover:bg-customIT transition">
            View Giveback
        </button>
    </div>
</div>
