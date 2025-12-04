<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ asset('images/swisa-logov1.png') }}" type="png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/forsidebar.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

        <!-- QR Scanner Library -->
        <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
        <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
        
    </head>
    
    <body class="font-poppins bg-gray-100 ">
        <div class="w-full min-h-screen flex">


            @include('layouts.sidebar')
                        @include('layouts.topbar')

            <!-- Sidebar -->

            <!-- Page Content -->
            <div class="main-content flex-1 bg-mainbg">


                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main>
                    {{ $slot ?? '' }}
                    @yield('content')
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
{{-- for modal toggle--}}
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.body.style.zoom = "90%";
    });
</script>
<!-- popup/flash message -->
<script>
    // SweetAlert2 Global Flash Message

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500 
        })
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            confirmButtonText: 'Got It',
            customClass: {
                confirmButton: 'bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded',
            },
            buttonsStyling: false,
        })
    @endif

    @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: '{{ session('warning') }}',
            showConfirmButton: true,
            confirmButtonText: 'Okay',
            customClass: { 
                confirmButton: 'bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded',
            },
            buttonsStyling: false,
        })
    @endif
</script>
{{-- for reusable search --}}
<script>
    // --- Performance Helper: Debounce Function ---
    // Prevents the filter function from running hundreds of times while the user types.
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // --- Core Filtering Function ---
    window.filterTable = (searchInputId, tbodyId) => {
        const input = document.getElementById(searchInputId);
        const tbody = document.getElementById(tbodyId);

        if (!input || !tbody) {
            // console.warn(`Filter setup error: Missing element for Input ID: ${searchInputId} or TBody ID: ${tbodyId}`);
            return; 
        }

        const term = input.value.toLowerCase().trim();
        const rows = tbody.querySelectorAll('tr');

        rows.forEach(row => {
            // Skip rows that are empty states (e.g., "No applications.")
            if (row.querySelector('td[colspan]')) return; 

            // Get the entire text content of the row
            const rowText = row.textContent.toLowerCase();
            
            // Show or hide the row
            row.style.display = rowText.includes(term) ? '' : 'none';
        });
    };

    // --- Debounced Global Function (Used in the Blade Component) ---
    // The filter will run 300 milliseconds after the user stops typing.
    window.debouncedFilterTable = debounce(window.filterTable, 300);
</script>
{{-- for sort--}}
<script>
    // --- Core Sorting Function ---
    window.sortHtmlTable = (sortValue, tbodyId) => {
        if (!sortValue) return;

        const [columnIndex, direction] = sortValue.split('|');
        const tbody = document.getElementById(tbodyId);

        if (!tbody) {
            console.error(`TBody with ID ${tbodyId} not found for sorting.`);
            return;
        }

        const rows = Array.from(tbody.querySelectorAll('tr'));
        const index = parseInt(columnIndex, 10);
        
        // 1. Sort the rows array based on cell content
        rows.sort((rowA, rowB) => {
            // Get the text content of the target cell
            const cellA = rowA.cells[index]?.textContent.trim().toLowerCase() || '';
            const cellB = rowB.cells[index]?.textContent.trim().toLowerCase() || '';

            // Handle numeric comparison for IDs/Quantities
            let comparison = 0;
            if (!isNaN(cellA) && !isNaN(cellB) && cellA !== '' && cellB !== '') {
                // Numeric sort
                comparison = parseFloat(cellA) - parseFloat(cellB);
            } else {
                // Alphabetical or Date sort
                if (cellA < cellB) {
                    comparison = -1;
                } else if (cellA > cellB) {
                    comparison = 1;
                }
            }

            // Apply direction (1 for asc, -1 for desc)
            return direction === 'asc' ? comparison : -comparison;
        });

        // 2. Re-append rows in the new sorted order
        rows.forEach(row => {
            tbody.appendChild(row);
        });
    };
    
    // --- Debounce function (Assuming this exists from the filter implementation) ---
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }
    
    // --- Debounced Global Filter Function (Assuming this still exists) ---
    // window.debouncedFilterTable = debounce(window.filterTable, 300);
</script>

<script>
    /**
     * Handles changing the number of results displayed per page.
     * This function modifies the URL's query parameters and reloads the page.
     * * @param {HTMLSelectElement} selectElement The <select> element that triggered the change.
     */
    window.handlePerPageChange = (selectElement) => {
        const perPage = selectElement.value;
        
        // 1. Create a URL object based on the current page URL
        const url = new URL(window.location.href);

        // 2. Set the 'per_page' parameter to the new value
        url.searchParams.set('per_page', perPage);
        
        // 3. IMPORTANT: Reset the 'page' parameter to 1 to ensure the user doesn't end up on a blank page
        url.searchParams.set('page', 1); 

        // 4. Navigate to the new URL
        window.location.href = url.toString();
    };
</script>