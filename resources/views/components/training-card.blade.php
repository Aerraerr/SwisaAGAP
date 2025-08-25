@props([
    'title' => 'Title Placeholder',
    'category' => 'N/A',
    'date' => 'N/A',
    'time' => 'N/A',
    'venue' => 'N/A',
    'participants' => 0,
    'status' => 'open',
])

<div class="bg-white pt-2 pl-4 pr-4 rounded-md shadow-lg overflow-hidden">
    <!-- Image Placeholder Section -->
    <div class="bg-gray-200 rounded-md h-44 flex items-center justify-center border-b border-gray-300">
        <span class="text-white text-md">IMAGE</span>
    </div>

    <!-- Card Content Section -->
    <div class="py-1">
        <!-- Title and Subtitle -->
        <div class="flex justify-between mb-2">
            <div>
                <h3 class="text-lg font-bold text-customIT">{{ $title }}</h3>
                <p class="text-sm font-medium text-gray-400">{{ $category }}</p>
            </div>
            <div class="flex  pt-3">
                <p class="text-xs mr-4">Status</p>
                <p class="text-xs px-4 h-4 w-16 rounded-xl text-white bg-btncolor">{{$status}}</p>
            </div>
        </div>
        

        <div>
            <p class="text-sm pt-1 font-medium text-customIT"> Details </p>
        </div>
        <!-- Information Grid -->
        <div class="flex justify-between gap-4 text-sm text-gray-600 mb-2">
            <!-- Stock Summary Section -->
            <div>
                <span class="font-medium flex items-center mb-1"> Date
                    <p class="font-medium text-gray-400 flex items-center mb-1">{{ $date }}</p>
                </span>
                <h4 class="font-medium flex items-center mb-1"> Time
                    {{ $time }}
                </h4>
                <h4 class="font-medium flex items-center mb-1"> Venue
                    {{ $venue }}
                </h4>
                <h4 class="font-medium flex items-center mb-1"> Participants
                    {{ $participants }}
                </h4>
            </div>

            <!-- Last Restocked/Added Section -->
            <div>
            </div>
        </div>

        <!-- View Button Section -->
        <div class="text-right m-2 gap-2">
            <a href="{{ route('view-grant') }}" class="bg-btncolor text-white text-sm py-1.5 px-8 rounded-md hover:bg-white transition duration-300">
                View
            </a>
        </div>
    </div>
</div>
