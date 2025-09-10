@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')
            <div class="flex justify-end mr-8 pt-1">
                @include('components.UserTab')
            </div>

<!-- Page Wrapper -->
<div class="p-4">
    <div class="bg-mainbg px-4 min-h-screen">
        
<!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center sm:items-center mb-3 gap-4 
                    text-white px-6 py-6 rounded-xl shadow-lg relative overflow-hidden"
            style="background: linear-gradient(120deg, rgba(44, 110, 73, 1), rgba(89, 170, 114, 0.68));">

            <!-- Decorative subtle background circles -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>

            <!-- Left Content -->
            <div class="flex items-center gap-4 relative z-10">
                <!-- Admin Icon -->
                <div class="flex items-center justify-center w-14 h-14 rounded-full bg-white bg-opacity-20 shadow-md">
                    <span class="material-icons text-white text-3xl">admin_panel_settings</span>
                </div>

                <div class="flex flex-col">
                    <h2 class="text-[22px] sm:text-[28px] font-bold drop-shadow-sm animate-fadeIn">
                        Welcome Back, Admin! 👋
                    </h2>
                    <p class="text-sm sm:text-base opacity-90">
                        Here’s a quick overview of your system today.
                    </p>
                </div>
            </div>

            <!-- Right Side (Optional Quick Status) -->
            <div class="hidden sm:flex flex-col text-right relative z-10">
                <p class="text-sm opacity-80">Last Login: <span class="font-semibold">Today, 9:45 AM</span></p>
                <p class="text-sm opacity-80">System Status: <span class="font-semibold text-hover-green">All Good ✅</span></p>
            </div>
        </div>




        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-7 gap-2">
            
            <!-- Total Registered Members -->
            <div class="lg:col-span-2 text-white p-6 rounded-xl shadow-lg font-product" style="background: linear-gradient(120deg, rgba(44, 110, 73, 0.9), rgba(47, 143, 78, 0.85));">
                <div class="flex flex-col sm:flex-row items-start gap-3">
                    <img src="{{ asset('images/right.png') }}" alt="Check Icon" class="w-12 h-12 object-contain" />
                    <div class="flex flex-col justify-center w-full">
                        <p class="header1 font-semibold tracking-widest">Total Registered <br> Members</p>
                        <h1 class="text-poppins text-4xl sm:text-5xl font-bold leading-tight tracking-widest pb-5">1,233</h1>
                        <div class="text-right">
                            <a href="#" class="text-sm text-white hover:underline">View All Members &gt;</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Placeholder -->
            <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow hidden sm:block"></div>

            <!-- Messages -->
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/message.png') }}" alt="Message Icon" class="w-12 h-12 object-contain mt-1" />
                    <div class="mt-1">
                        <p class="header1 font-semibold dashheader text-[#2C6E49]">Messages</p>
                        <p class="text-sm text-gray-500">2 unread messages</p>
                    </div>
                </div>
                <div class="flex mt-4 space-x-2">
                    <img src="https://i.pravatar.cc/40?img=1" class="w-8 h-8 rounded-full">
                    <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full">
                    <img src="https://i.pravatar.cc/40?img=3" class="w-8 h-8 rounded-full">
                </div>
                <div class="text-right mt-4">
                    <a href="#" class="text-xs text-custom hover:underline">All messages &rarr;</a>
                </div>
            </div>

            <!-- Charts Section -->
            @include('charts.monthly-requests')
            @include('charts.request-status-overview')
            @include('charts.member-type-breakdown')
            @include('charts.top-requested')
            @include('charts.recent-activity')
            @include('charts.shortcuts-quicklinks')

        </div>
    </div>
</div>
@endsection
