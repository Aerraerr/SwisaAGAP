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
    </head>
    
    <body class="font-poppins bg-gray-100">
        <div class="w-full min-h-screen flex">
            <!-- Sidebar -->
            @include('layouts.sidebar')

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
