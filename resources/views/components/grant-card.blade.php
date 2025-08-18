@props([
    'title' => 'Title Placeholder',
    'category' => 'Category Placeholder',
    'stockAvailable' => 0,
    'pendingRequests' => 0,
    'approved' => 0,
    'addedOn' => 'N/A',
    'lastUpdated' => 'N/A',
    'eligibility' => 'N/A',
    'allocationPercentage' => 0,
])

<div class="max-w-xl bg-white pt-2 pl-4 pr-4 rounded-md shadow-lg overflow-hidden">
    <!-- Image Placeholder Section -->
    <div class="bg-gray-200 rounded-md h-40 flex items-center justify-center border-b border-gray-300">
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
        <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 mb-2">
            <!-- Stock Summary Section -->
            <div>
                <h4 class="font-semibold text-customIT flex items-center mb-1">
                    <!-- Box icon -->
                    <svg class="h-4 w-4 mr-1 customIT" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 12a1 1 0 112 0 1 1 0 01-2 0zm1-5a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                    Stock Summary
                </h4>
                <p class="ml-5 text-xs">Available: <span class="font-medium text-gray-800">{{ $stockAvailable }} units</span></p>
                <p class="ml-5 text-xs">Pending: <span class="font-medium text-gray-800">{{ $pendingRequests }}</span></p>
                <p class="ml-5 text-xs">Approved: <span class="font-medium text-gray-800">{{ $approved }}</span></p>
            </div>

            <!-- Last Restocked/Added Section -->
            <div>
                <h4 class="font-semibold text-green-700 flex items-center mb-1">
                    <!-- Calendar icon -->
                    <svg class="h-4 w-4 mr-1 text-customIT" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                    Last Restocked
                </h4>
                <p class="ml-5 text-xs">Added On: <span class="font-medium text-gray-800">{{ $addedOn }}</span></p>
                <p class="ml-5 text-xs">Last Updated: <span class="font-medium text-gray-800">{{ $lastUpdated }}</span></p>
            </div>
        </div>

        <!-- Eligibility and Progress Bar Section -->
        <div class="flex items-center justify-between mb-4">
            <div class="items-start">
                <h4 class="font-semibold text-sm text-customIT flex items-center mr-2">
                    <!-- Badge icon -->
                    <svg class="h-4 w-4 mr-1 text-customIT" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 10a1 1 0 012 0v5a1 1 0 11-2 0v-5zm1-3a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                    Eligibility Info
                </h4>
                <p class="text-xs text-gray-500 ml-5">
                For: <span class="font-medium text-gray-800">{{ $eligibility }}</span>
                </p>
            </div>
            <div class="w-1/2 flex items-center ml-auto">
                <div class="h-2 w-full bg-gray-200 rounded-full mr-2">
                    <div
                        class="h-full bg-customIT rounded-full"
                        style="width: {{ $allocationPercentage }}%;">
                    </div>
                </div>
                {{--<span class="text-sm text-gray-600">{{ $allocationPercentage }}% Allocated</span>--}}
            </div>
        </div>

        <!-- View Button Section -->
        <div class="grid-cols-2 text-right mb-2 gap-2">
            <a href="{{ route('view-grant') }}" class="bg-customIT text-white text-sm py-1.5 px-12 rounded-md hover:bg-green-700 transition duration-300">
                View
            </a>
        </div>
    </div>
</div>
