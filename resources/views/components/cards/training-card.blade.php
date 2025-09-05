@props([
    'title' => 'Title Placeholder',
    'category' => 'N/A',
    'date' => 'N/A',
    'time' => 'N/A',
    'venue' => 'N/A',
    'participants' => 0,
    'status' => 'open',
])

<div class="bg-white pt-2 px-4 rounded-md shadow-lg overflow-hidden">
    <!-- Image Placeholder Section -->
    <div class="bg-gray-200 rounded-md h-48 flex items-center justify-center border-b border-gray-300">
        <span class="text-white text-md">IMAGE</span>
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
                <p class="inline-block text-xs font-medium bg-approved text-white text-center px-3 py-1 rounded-full">{{$status}}</p>
            </div>
        </div>
        
        <div>
            <p class="pt-1 font-semibold text-customIT">Details </p>
        </div>

        <div class="text-sm mb-3">
            <p class="font-medium ml-5 text-sm">Date: <span class="text-gray-600 ml-1">{{ $date }}</span></p>
            <p class="font-medium ml-5 text-sm">Time: <span class="text-gray-600 ml-1">{{ $time }}</span></p>
            <p class="font-medium ml-5 text-sm">Venue: <span class="text-gray-600 ml-1">{{ $venue }}</span></p>
            <p class="font-medium ml-5 text-sm">Participants: <span class="text-gray-600 ml-1">{{ $participants }}</span></p>
        </div>

        <!-- View Button Section -->
        <div class="grid grid-cols-2 text-right my-2">
            <a href="{{route('view-training')}}" class="col-start-2 bg-btncolor text-white text-center text-sm py-2 rounded-[3px] hover:bg-customIT transition duration-300">
                View
            </a>
        </div>
    </div>
</div>
