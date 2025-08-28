@props([
    'name' => 'N/A',
    'category' => 'N/A',
    'type' => 'N/A',
    'status' => 'N/A',
    'date' => 'N/A',
    'time' => 'N/A',
])

<div class="bg-white p-6 rounded-md shadow-lg flex flex-col overflow-hidden">
    <!-- Image Placeholder Section -->
    <div class="flex justify-between items-center gap-2 mb-4">
        <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
         class="w-16 h-16 mb-2 rounded-full shadow-md object-cover" />
        <div>
            <div>
            <h3 class="text-sm pt-1 font-semibold text-customIT">{{ $name }}</h3>
            </div>
            <div>
            <h3 class="text-xs pt-1 font-light text-gray-500">{{ $category }}</h3>
            </div>
        </div>
        <h3 class="text-xs px-6 py-1 border-[2px] border-customIT font-medium text-pending rounded-[3px]">{{ $status }}</h3>
    </div>

    <!-- Card Content Section -->
    <div class="">
        <!-- Information Grid -->
        <div class="flex justify-between gap-4 text-sm text-gray-600 mb-4">
            <!-- Stock Summary Section -->
            <div>
                <h4 class="text-gray-500 flex items-center mb-1">
                    {{ $date }}
                </h4>
            </div>

            <!-- Last Restocked/Added Section -->
            <div>
                <h4 class="text-gray-500 flex items-center mb-1">
                    {{ $time }}
                </h4>
            </div>
        </div>
        
        <div class="flex justify-between gap-4 text-sm text-gray-600 mb-4">
            <!-- Stock Summary Section -->
            <div>
                <h4 class="text-gray-500 flex items-center mb-1">
                    Type of grant:
                </h4>
            </div>

            <!-- Last Restocked/Added Section -->
            <div>
                <h4 class="text-gray-500 flex items-center mb-1">
                    {{ $type }}
                </h4>
            </div>
        </div>
        <!-- View Button Section -->
        <div class="flex justify between gap-2">
            <a href="{{ route('view-grant') }}" class="bg-snbg text-green-700 text-sm py-1.5 px-8 rounded-md hover:bg-white transition duration-300">
                View
            </a>
            <a href="{{ route('view-grant') }}" class="bg-customIT text-white text-sm py-1.5 px-8 rounded-md hover:bg-green-700 transition duration-300">
                Review
            </a>
        </div>
    </div>
</div>
