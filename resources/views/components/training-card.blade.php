@props([
    'title' => 'Title Placeholder',
    'category' => 'N/A',
    'date' => 'N/A',
    'time' => 'N/A',
    'description' => 'N/A',
    'attendees' => 0,
])

<div class="bg-white pt-2 pl-4 pr-4 rounded-md shadow-lg overflow-hidden">
    <!-- Image Placeholder Section -->
    <div class="bg-gray-200 rounded-md h-44 flex items-center justify-center border-b border-gray-300">
        <span class="text-white text-md">IMAGE</span>
    </div>

    <!-- Card Content Section -->
    <div class="">
        <!-- Title and Subtitle -->
        <div class="mb-2">
            <h3 class="text-md pt-1 font-bold text-customIT">{{ $title }}</h3>
            <p class="text-xs text-gray-500">{{ $category }}</p>
        </div>

        <!-- Information Grid -->
        <div class="flex justify-between gap-4 text-sm text-gray-600 mb-2">
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

        <!-- Eligibility and Progress Bar Section -->
        <div class="flex items-center justify-between mb-4">
            <div class="items-start">
                <h4 class="font-light text-sm text-gray-500 flex items-center mr-2">
                    description: <p class="text-sm font-medium text-gray-800 ml-2 block w-40 truncate">{{ $description }}</p>
                </h4>
            </div>
        </div>

        <!-- View Button Section -->
        <div class="flex justify between text-right m-2 gap-2">
            <a href="{{ route('view-grant') }}" class="bg-snbg text-green-700 text-sm py-1.5 px-8 rounded-md hover:bg-white transition duration-300">
                View
            </a>
            <a href="{{ route('view-grant') }}" class="bg-customIT text-white text-sm py-1.5 px-8 rounded-md hover:bg-green-700 transition duration-300">
                Attendees
            </a>
        </div>
    </div>
</div>
