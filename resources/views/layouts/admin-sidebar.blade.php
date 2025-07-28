<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="relative min-h-screen md:flex">
        <!-- para sa sidebar mga kupal-->
            <aside class="z-10 w-64 px-2 py-4 absolute inset-y-0 left-0 md:relative transform md:translate-x-0
                overflow-y-auto transition ease-in-out duration-200 shadow-lg">
                <!-- Logo -->
                <div class="flex item-center justify-between px-2 mb-4">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                        <span class="text-2xl font-bold">SwisaAGAP</span>
                    </div>
                </div>

                <!-- Nav links-->
                <nav>
                    <x-side-nav-link href="{{ route('dashboard')}}">
                        Dashboard
                    </x-side-nav-link>
                    <x-side-nav-link href="{{ route('profile.edit')}}">
                        Profile
                    </x-side-nav-link>
                    <x-side-nav-link>
                        __fill here mga boa
                    </x-side-nav-link>
                </nav>
            </aside>
            
            <main>
                <!--dashboard.blade content here-->
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
