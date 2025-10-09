@props([
    'name',
    'item',
    'type',
    'item_id',
    'status',
    'request_date',
    'last_report',
    'next_report',
    'reportId' => NULL,
])

<div class="bg-white py-2 px-4 rounded-md shadow-lg overflow-hidden">
    <!-- Image Placeholder Section -->
    <div class="bg-gray-200 rounded-md h-48 flex items-center justify-center border-b border-gray-300">
        <span class="text-white text-md">IMAGE</span>
    </div>

    <!-- Card Content Section -->
    <div class="grid grid-cols-2">
        <!-- Title and Subtitle -->
        <div class="col-start-1 mb-2">
            <h3 class="text-lg pt-1 font-bold text-customIT">{{ $item }}</h3>
            <p class="text-sm text-gray-600">{{ $type }}<span> | ID-{{ $item_id }}</span></p>
        </div>
        <div class="text-right py-2 ">
            <h3 class="inline-block text-xs font-medium bg-tbr border text-gray-700 text-center px-3 py-1 rounded-full">{{ $status }}</h3>
        </div>

        <!-- Information Grid -->
        <div class="col-span-2 text-sm text-gray-700 mb-2">
            <!-- Stock Summary Section -->
            <h4 class="font-semibold text-customIT flex items-center mb-1">Report Info</h4>
            <p class="font-medium ml-5">Borrowed by: <span class="text-gray-600 ml-1">{{ $name }}</span></p>
            <p class="font-medium ml-5">Applied at: <span class="text-gray-600 ml-1">{{ $request_date }}</span></p>
            <p class="font-medium ml-5">Last report: <span class="text-gray-600 ml-1">{{ $last_report }}</span></p>
            <p class="font-medium ml-5">Next report: <span class="text-gray-600 ml-1">{{ $next_report }}</span></p>.
        </div>
    </div>
    <!-- View Button Section -->
    <div class="grid grid-cols-2 text-right mb-2">
        <a href="{{ route('view-report', $reportId)}}" class="col-start-2 bg-btncolor text-white text-sm text-center py-1.5 rounded-[3px] hover:bg-customIT transition duration-300">
            View
        </a>
    </div>
</div>
