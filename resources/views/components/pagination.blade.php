@props(['paginator'])

<div class="text-right pt-4 px-4 bottom-0 left-0 right-0">

    <nav class="relative z-0 inline-flex rounded-md text-xs shadow-sm -space-x-px gap-1" aria-label="Pagination">

        {{-- BACK --}}
        @if ($paginator->onFirstPage())
            <span class="flex ring-1 ring-inset ring-gray-300 items-center text-gray-400 rounded-[4px] bg-gray-100 py-1 px-2 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <span class="font-medium px-2">Back</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="flex ring-1 ring-inset ring-gray-300 items-center text-bsctxt rounded-[4px] bg-white hover:bg-btncolor hover:text-white cursor-pointer py-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
                <span class="font-medium px-2">Back</span>
            </a>
        @endif


        {{-- PAGE INDICATOR --}}
        <span class="relative z-10 inline-flex items-center rounded-[4px] bg-white px-4 py-2 text-sm font-medium text-bsctxt ring-1 ring-inset ring-gray-300">
            Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
        </span>


        {{-- NEXT --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="flex ring-1 ring-inset ring-gray-300 text-bsctxt items-center rounded-[4px] bg-white hover:bg-btncolor hover:text-white cursor-pointer py-1">
                <span class="font-medium px-2">Next</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        @else
            <span class="flex ring-1 ring-inset ring-gray-300 text-gray-400 items-center rounded-[4px] bg-gray-100 py-1 px-2 cursor-not-allowed">
                <span class="font-medium px-2">Next</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </span>
        @endif

    </nav>

    <!-- Results per page -->
    <div class="relative inline-flex items-center ml-4">
        <span class="text-sm font-medium text-bsctxt mr-2">Result per page</span>

        <form method="GET" id="perPageForm">
            <select name="per_page"
                onchange="document.getElementById('perPageForm').submit()"
                class="rounded-[4px] w-20 px-4 py-[7px] border-gray-300 shadow-sm focus:border-customIT focus:ring-customIT text-sm">

                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
            </select>
        </form>
    </div>

</div>
