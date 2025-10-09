@props([
    'grantId' => null,
    'title' => 'Title Placeholder',
    'category' => 'Category Placeholder',
    'image' => '/images/placeholder.png',
    'stockAvailable' => 0,
    'pendingRequests' => 0,
    'approved' => 0,
    'available_date' => 'N/A',
    'end_date' => 'N/A',
    'eligibility' => 'N/A',
    'allocationPercentage' => 0,
])

<div class="bg-white py-2 px-4 rounded-md shadow-lg overflow-hidden">
    <!-- Image Placeholder Section -->
    <div class="bg-gray-200 rounded-md h-48 flex items-center justify-center border-b border-gray-300">
       <img 
            src= {{ $image }} 
            alt="Product image placeholder" 
            class="object-cover w-full h-full"
        >
    </div>

    <!-- Card Content Section -->
    <div class="">
        <!-- Title and Subtitle -->
        <div class="mb-2">
            <h3 class="text-xl pt-1 font-bold text-customIT">{{ $title }}</h3>
            <p class="text-md text-gray-500">{{ $category }}</p>
        </div>

        <!-- Information Grid -->
        <div class="grid grid-cols-2 gap-4 text-md text-gray-600 mb-2">
            <!-- Stock Summary Section -->
            <div>
                <h4 class="font-semibold text-customIT flex items-center mb-1">
                    <!-- Box icon -->
                    Stock Remaining
                </h4>
                <p class="font-medium ml-5 text-sm">Available: <span class="text-gray-600 ml-1">{{ $stockAvailable }} units</span></p>
            </div>

            <!-- Last Restocked/Added Section -->
            <div>
                <h4 class="font-semibold text-green-700 flex items-center mb-1">
                    <!-- Calendar icon -->
                    Availability
                </h4>
                <p class="font-medium ml-5 text-sm">Available Until: <span class="text-gray-600 ml-1">{{ $end_date }}</span></p>
            </div>
        </div>

        <!-- Eligibility and Progress Bar Section -->
        {{--<div class="flex items-center justify-between mb-4">
            <div class="items-start">
                <h4 class="font-semibold text-sm text-customIT flex items-center mr-2">
                    <!-- Badge icon -->
                    <svg class="h-4 w-4 mr-1 text-customIT" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 10a1 1 0 012 0v5a1 1 0 11-2 0v-5zm1-3a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                    Eligibility Info
                </h4>
                <p class="font-medium text-sm text-gray 700 ml-5">
                For: <span class="text-gray-600 ml-1">{{ $eligibility }}</span>
                </p>
            </div>
            <div class="w-1/2 flex items-center ml-auto">
                <div class="h-2 w-full bg-gray-200 rounded-full mr-2">
                    <div
                        class="h-full bg-customIT rounded-full"
                        style="width: {{ $allocationPercentage }}%;">
                    </div>
                    <div class="text-center">
                        <span class="text-sm text-gray-600">{{ $allocationPercentage }}% Allocated</span>
                    </div>
                </div>
                {{--<span class="text-sm text-gray-600">{{ $allocationPercentage }}% Allocated</span>--}}
            {{--</div>
        </div>--}}

        <!-- View Button Section -->
        <div class="grid grid-cols-2 mb-2">
            <a href="{{ route('view-grant', $grantId) }}" class="col-start-2 bg-btncolor text-white text-sm text-center py-1.5 rounded-[3px] hover:bg-customIT transition duration-300">
                View
            </a>
        </div>
    </div>
</div>
