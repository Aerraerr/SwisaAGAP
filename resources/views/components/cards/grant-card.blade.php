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
])

<div class="bg-white py-2 px-4 rounded-md shadow-lg border border-gray-300 overflow-hidden">
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
        <div>
            <p class="pt-1 font-semibold text-customIT mb-2">Details </p>
        </div>

        <div class="text-sm  mb-3">
            <!-- Stock Summary Section -->
            <div>
                <p class="font-medium ml-2 text-sm">Available: <span class="text-gray-600 ml-1">{{ $stockAvailable }} units</span></p>
                <p class="font-medium ml-2 text-sm">Available Until: <span class="text-gray-600 ml-1">{{ $end_date }}</span></p>
            </div>
        </div>

        <!-- View Button Section -->
        <div class="grid grid-cols-2 mb-2">
            <a href="{{ route('view-grant', $grantId) }}" class="col-start-2 bg-btncolor text-white text-sm text-center py-1.5 rounded-[3px] hover:bg-customIT transition duration-300">
                View
            </a>
        </div>
    </div>
</div>
