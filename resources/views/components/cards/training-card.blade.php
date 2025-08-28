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
    <div class="bg-gray-200 rounded-md h-44 flex items-center justify-center border-b border-gray-300">
        <span class="text-white text-md">IMAGE</span>
    </div>

    <!-- Card Content Section -->
    <div class="py-1">
        <!-- Title and Subtitle -->
        <div class="flex justify-between mb-3">
            <div>
                <h3 class="text-lg font-bold text-customIT">{{ $title }}</h3>
                <p class="text-sm font-medium text-gray-400">{{ $category }}</p>
            </div>
            <div class="flex  pt-3">
                <p class="text-xs mr-4">Status</p>
                <p class="text-xs text-center h-4 w-16 rounded-xl text-white bg-btncolor">{{$status}}</p>
            </div>
        </div>
        
        <div>
            <p class="text-sm pt-1 font-semibold text-customIT">Details </p>
        </div>

        <div class="flex justify-between gap-4 text-xs text-gray-600 mb-3">
            <div class="grid grid-cols-6">

                <p class="col-start-1 col-span-2 font-medium flex items-center"> Date</p>
                <p class="col-start-4 col-span-2 font-medium text-gray-400 flex items-center">{{ $date }}</p>
                
                <p class="col-start-1 col-span-2 font-medium flex items-center"> Time</p>
                <p class="col-start-4 col-span-2 font-medium text-gray-400 flex items-center"> {{$time}}</p>

                <p class="col-start-1 col-span-2 font-medium flex items-center"> Venue</p>
                <p class="col-start-4 col-span-2 font-medium text-gray-400 flex items-center"> {{$venue}}</p>

                <p class="col-start-1 col-span-2 font-medium flex items-center"> Participants</p>
                <p class="col-start-4 col-span-2 font-medium text-gray-400 flex items-center"> {{$participants}}</p>

            </div>
        </div>

        <!-- View Button Section -->
        <div class="grid grid-cols-2 text-right my-2">
            <a href="{{route('view-training')}}" class="col-start-2 bg-btncolor text-white text-center text-sm py-2 rounded-[3px] hover:bg-customIT transition duration-300">
                View
            </a>
        </div>
    </div>
</div>
