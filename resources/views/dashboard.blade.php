@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')

<div class="p-4">
    <div class="text-customIT flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 gap-2">
        <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Welcome Back Admin!</h2>
        @include('components.UserTab')
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-7 gap-3">
        <!-- Total Registered Members -->
        <div class="lg:col-span-2 bg-[#2C6E49] text-white p-6 rounded-xl shadow-lg font-product">
            <div class="flex flex-col sm:flex-row items-start gap-2">
                <img src="{{ asset('images/right.png') }}" alt="Check Icon" class="w-12 h-12 object-contain" />
                <div class="flex flex-col justify-center w-full">
                    <p class="header1 font-semibold tracking-widest">Total Registered <br> Members</p>
                    <h1 class="text-poppins text-4xl sm:text-5xl font-bold leading-tight tracking-widest pb-5">1,233</h1>
                    <div class="text-right">
                        <a href="#" class="text-sm text-white">View All Members &gt;</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty placeholder -->
        <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow hidden sm:block"></div>

        <!-- Messages -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/message.png') }}" alt="Check Icon" class="w-12 h-12 object-contain mt-1" />
                <div class="mt-2">
                    <p class="header1 font-semibold text-custom dashheader">Messages</p>
                    <p class="text-sm text-gray-500">2 unread messages</p>
                </div>
            </div>
            <div class="flex mt-4 space-x-2">
                <img src="https://i.pravatar.cc/40?img=1" class="w-8 h-8 rounded-full">
                <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full">
                <img src="https://i.pravatar.cc/40?img=3" class="w-8 h-8 rounded-full">
            </div>
            <div class="text-right mt-4">
                <a href="#" class="text-xs text-custom">All messages &rarr;</a>
            </div>
        </div>

        <!-- Charts -->
        @include('charts.monthly-requests')
        @include('charts.request-status-overview')
        @include('charts.top-requested')
        @include('charts.member-type-breakdown')
                @include('charts.recent-activity')

        @include('charts.shortcuts-quicklinks')
    </div>
</div>
@endsection
