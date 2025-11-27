@props([
    'trainingId' => null,
    'image' => '/images/placeholder.png',
    'title' => 'Title Placeholder',
    'category' => 'N/A',
    'date' => 'N/A',
    'time' => 'N/A',
    'venue' => 'N/A',
    'participants' => 0,
    'status' => 'N/A',
])

<div class="bg-white pt-2 px-4 rounded-md shadow-md border border-gray-300 overflow-hidden 
            transform transition duration-300 hover:scale-104 hover:shadow-xl">
    <!-- Image Placeholder Section -->
    <div class="bg-gray-200 rounded-md h-48 flex items-center justify-center border-b border-gray-300">
       <img 
            src="{{ $image }}" 
            alt="Event image" 
            class="object-cover w-full h-full"
        >
    </div>

    <!-- Card Content Section -->
    <div class="py-1">
        <!-- Title and Subtitle -->
        <div class="flex justify-between mb-3">
            <div>
                <h3 class="text-lg font-bold text-customIT">{{ $title }}</h3>
                <p class="text-sm text-gray-600">{{ $category }}</p>
            </div>
            <div class="py-1">
                <p class="inline-block text-xs font-medium bg-approved text-white text-center px-3 py-1 rounded-full">
                    {{ $status }}
                </p>
            </div>
        </div>
        
        <div>
            <p class="pt-1 font-semibold text-customIT mb-2">Details </p>
        </div>

        <div class="text-sm mb-3">
            <p class="font-medium text-sm">Date: <span class="text-gray-600 ml-1">{{ $date }}</span></p>
            <p class="font-medium text-sm">Time: <span class="text-gray-600 ml-1">{{ $time }}</span></p>
            <p class="font-medium text-sm">Venue: <span class="text-gray-600 ml-1">{{ $venue }}</span></p>
            <p class="font-medium text-sm">Participants: <span class="text-gray-600 ml-1">{{ $participants }}</span></p>
        </div>

        <!-- View Button Section -->
        <div class="grid grid-cols-2 text-right my-2">
            <a href="{{ route('view-training', $trainingId) }}" 
               class="mb-2 col-start-2 bg-btncolor text-white text-center text-sm py-2 rounded-[3px] hover:bg-customIT transition duration-300">
                View
            </a>
        </div>
    </div>
</div>

