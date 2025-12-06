@extends('layouts.app')

@section('content')

@include('layouts.loading-overlay')
<!-- Animations -->
<style>
    /* Smooth gradient animation */
    .animate-gradient {
        background: linear-gradient(120deg, #2C6E49, #77cf91ff, #2C6E49);
        background-size: 200% 200%;
        animation: gradientShift 20s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Subtle circle movement */
    @keyframes moveCircle1 {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(-8px, 8px); }
    }
    @keyframes moveCircle2 {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(10px, -10px); }
    }
    .animate-moveCircle1 {
        animation: moveCircle1 10s ease-in-out infinite;
    }
    .animate-moveCircle2 {
        animation: moveCircle2 14s ease-in-out infinite;
    }

    /* Gentle fade-in for text */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 1.2s ease forwards;
    }
    .delay-200 { animation-delay: 0.2s; }
    .delay-500 { animation-delay: 0.5s; }
    .delay-700 { animation-delay: 0.7s; }
</style>



<!-- Page Wrapper -->
<div class="p-4 -mt-2">
    <div class="bg-mainbg px-4 min-h-screen">
        
<!-- Header + Search Row -->
<div class="grid grid-cols-1 lg:grid-cols-4 gap-3 mb-3">

    <!-- Page Header (Container 1 - spans 3 cols) -->
    <div class="lg:col-span-4 flex flex-col sm:flex-row justify-between items-center sm:items-center 
            text-white px-4 py-5 rounded-xl shadow-md relative overflow-hidden animate-gradient">

    <!-- Decorative subtle background circles with motion -->
    <div class="absolute top-0 right-0 w-24 h-24 bg-white opacity-5 rounded-full blur-2xl animate-moveCircle1"></div>
    <div class="absolute bottom-0 left-0 w-20 h-20 bg-white opacity-5 rounded-full blur-xl animate-moveCircle2"></div>

    <!-- Left Content -->
    <div class="flex items-center gap-3 relative z-10 h-15">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-white bg-opacity-20 shadow-md">
            <span class="material-icons text-white text-2xl animate-bounce">admin_panel_settings</span>
        </div>
        <div class="flex flex-col">
            <h2 class="text-[20px] sm:text-[24px] font-semibold drop-shadow-sm animate-fadeIn">
                Welcome Back, {{ Auth::user()->first_name}}! 👋
            </h2>
            <p class="text-xs sm:text-sm opacity-90 animate-fadeIn delay-200">
                Here’s your quick overview today.
            </p>
        </div>
    </div>
    

    <!-- Right Side (Quick Status) -->
    <div class="hidden sm:flex flex-col text-right relative z-10">
        <p class="text-xs opacity-80 animate-fadeIn delay-500">
            Last Login: <span class="font-medium">Today, 9:45 AM</span>
        </p>
        <p class="text-xs opacity-80 animate-fadeIn delay-700">
            System Status: <span class="font-medium text-hover-green">All Good </span>
        </p>
    </div>
</div>


    <!-- Search Bar (Container 2 - spans 1 col)
    <div class="lg:col-span-1 bg-white p-4 rounded-xl shadow-md flex items-center gap-2">
        <span class="material-icons text-gray-500">search</span>
        <input 
            type="text" 
            placeholder="Search members, requests, or equipment..." 
            class="w-full p-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
        >
    </div>
        -->
</div>
<div class="mb-4 text-sm text-gray-600">
</div>








        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-10 gap-3">
            
            <!-- Total Registered Members -->
            <div class="lg:col-span-2 text-white p-6 rounded-xl shadow-lg font-product" style="background: linear-gradient(120deg, rgba(44, 110, 73, 0.9), rgba(47, 143, 78, 0.85));">
                <div class="flex flex-col sm:flex-row items-start gap-3">
                    <img src="{{ asset('images/right.png') }}" alt="Check Icon" class="w-12 h-12 object-contain" />
                    <div class="flex flex-col justify-center w-full">
                        <p class="header1 font-semibold tracking-widest">Total Registered <br> Members</p>
                            <h1 class="text-poppins text-4xl sm:text-5xl font-bold leading-tight tracking-widest pb-5">
                                {{ number_format($totalMembers) }}
                            </h1>

                        <div class="text-right">
                            <a href="#" class="text-sm text-white hover:underline">View All Members &gt;</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available grants -->
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow hidden sm:block">
                <div class="flex flex-col sm:flex-row items-start gap-3">
                    <img src="{{ asset('images/grants.png') }}" alt="Check Icon" class="w-12 h-12 object-contain" />
                    <div class="flex flex-col justify-center w-full">
                        @if(Auth()->user()->role_id == 3)
                            <p class="header1 font-semibold text-[#2C6E49] tracking-widest">Available <br> Grants</p>
                            <h1 class="text-poppins text-[#2C6E49] text-4xl sm:text-5xl font-bold leading-tight tracking-widest pb-5">
                                {{ $totalGrants }}
                            </h1>
                            <div class="text-right">
                                <a href="{{ route('grantsNequipment') }}" class="text-sm text-[#2C6E49] hover:underline">View All Grants &gt;</a>
                            </div>
                        @elseif(Auth()->user()->role_id == 2)
                            <p class="header1 font-semibold text-[#2C6E49] tracking-widest">Total <br> Givebacks</p>
                            <h1 class="text-poppins text-[#2C6E49] text-4xl sm:text-5xl font-bold leading-tight tracking-widest pb-5">
                                {{ $totalGivebacks }}
                            </h1>
                            <div class="text-right">
                                <a href="{{ route('giveback') }}" class="text-sm text-[#2C6E49] hover:underline">View All Givebacks &gt;</a>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>


            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow hidden sm:block">
                <div class="flex flex-col sm:flex-row items-start gap-3">
                    <img src="{{ asset('images/events.png') }}" alt="Check Icon" class="w-12 h-12 object-contain" />
                    <div class="flex flex-col justify-center w-full">
                        <p class="header1 font-semibold text-[#2C6E49] tracking-widest">Upcoming <br> Events</p>
                        <h1 class="text-poppins text-[#2C6E49] text-4xl sm:text-5xl font-bold leading-tight tracking-widest pb-5">
                            {{ $upcomingTrainings }}
                        </h1>


                        <div class="text-right">
                            <a href="{{ route('training-workshop') }}" class="text-sm text-[#2C6E49] hover:underline">View All Events &gt;</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- All Pending Requests Card -->
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow hidden sm:block">
                <div class="flex flex-col sm:flex-row items-start gap-3">
                    <img src="{{ asset('images/pending.png') }}" alt="Check Icon" class="w-12 h-12 object-contain" />

                    <div class="flex flex-col justify-center w-full">
                        <p class="header1 font-semibold text-[#2C6E49] tracking-widest">All Pending <br> Requests</p>

                        <h1 class="text-poppins text-[#2C6E49] text-4xl sm:text-5xl font-bold leading-tight tracking-widest pb-5">
                            {{ $pendingRequests }}
                        </h1>
                        <div class="text-right">
                            <a href="{{ route('grant-request') }}" class="text-sm text-[#2C6E49] hover:underline">View All Requests &gt;</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Messages -->
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/messages.png') }}" alt="Message Icon" class="w-12 h-12 object-contain mt-1" />
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
                <div class="text-right">
                    <a href="{{ route('chat.index') }}" class="text-sm text-[#2C6E49] hover:underline">View All Messages &gt;</a>
                </div>
            </div>
            <!-- Charts Section -->
            @include('charts.monthly-requests')
            @include('charts.request-status-overview')
            @if(Auth()->user()->role_id == 3)
                @include('charts.member-type-breakdown')
            @endif
            @include('charts.top-requested')
            @if(Auth()->user()->role_id == 3)
                @include('charts.recent-activity', ['recentLogs' => \App\Models\Log::latest('activity_timestamp')->take(5)->get()])
            @endif
            


            <!-- New: Member Demographics -->
            <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow-lg">
                <p class="font-semibold mb-4 text-[#2C6E49] flex items-center">
                    <span class="material-icons mr-2 text-custom">groups</span>
                    Member Demographics
                </p>

                <!-- Gender Distribution -->
                <div class="mb-4">
                    <p class="text-sm font-semibold text-gray-600 mb-2">Gender</p>

                    <div class="flex items-center mb-3">
                        <span class="material-icons text-blue-600 mr-2">male</span>
                        <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $malePercent }}%"></div>
                        </div>
                        <span class="text-xs font-medium text-blue-600">{{ $malePercent }}% Male</span>
                    </div>

                    <div class="flex items-center">
                        <span class="material-icons text-purple-600 mr-2">female</span>
                        <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $femalePercent }}%"></div>
                        </div>
                        <span class="text-xs font-medium text-purple-600">{{ $femalePercent }}% Female</span>
                    </div>
                </div>

                <!-- Age Distribution -->
                <div>
                    <p class="text-sm font-semibold text-gray-600 mb-2">Age Distribution</p>

                    <div class="flex items-center mb-2">
                        <span class="text-xs font-medium w-16 text-gray-800 shrink-0">Under 18:</span>
                        <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                            <!-- Using a soft color for this group -->
                            <div class="bg-green-300 h-2 rounded-full" style="width: {{ $agePercent['below_18'] ?? 0 }}%"></div>
                        </div>
                        <span class="text-xs font-medium text-gray-700 w-8 text-right shrink-0">{{ $agePercent['below_18'] ?? 0 }}%</span>
                    </div>

                    <div class="flex items-center mb-2">
                        <span class="text-xs font-medium w-16 text-gray-800 shrink-0">18–25:</span>
                        <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                            <div class="bg-teal-500 h-2 rounded-full" style="width: {{ $agePercent['18-25'] ?? 0 }}%"></div>
                        </div>
                        <span class="text-xs font-medium text-gray-700 w-8 text-right shrink-0">{{ $agePercent['18-25'] ?? 0 }}%</span>
                    </div>

                    <div class="flex items-center mb-2">
                        <span class="text-xs font-medium w-16 text-gray-800 shrink-0">26–40:</span>
                        <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                            <div class="bg-orange-500 h-2 rounded-full" style="width: {{ $agePercent['26-40'] ?? 0 }}%"></div>
                        </div>
                        <span class="text-xs font-medium text-gray-700 w-8 text-right shrink-0">{{ $agePercent['26-40'] ?? 0 }}%</span>
                    </div>

                    <div class="flex items-center mb-2">
                        <span class="text-xs font-medium w-16 text-gray-800 shrink-0">41–60:</span>
                        <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: {{ $agePercent['41-60'] ?? 0 }}%"></div>
                        </div>
                        <span class="text-xs font-medium text-gray-700 w-8 text-right shrink-0">{{ $agePercent['41-60'] ?? 0 }}%</span>
                    </div>

                    <div class="flex items-center">
                        <span class="text-xs font-medium w-16 text-gray-800 shrink-0">60+:</span>
                        <div class="flex-1 mx-2 bg-gray-200 rounded-full h-2">
                            <div class="bg-slate-500 h-2 rounded-full" style="width: {{ $agePercent['60+'] ?? 0 }}%"></div>
                        </div>
                        <span class="text-xs font-medium text-gray-700 w-8 text-right shrink-0">{{ $agePercent['60+'] ?? 0 }}%</span>
                    </div>
                </div>
            </div>


           <!-- Announcements / Notices -->
            <div class="lg:col-span-4 bg-white p-6 rounded-xl shadow-lg">
                <p class="font-semibold mb-4 text-[#2C6E49] flex items-center">
                    <span class="material-icons mr-2 text-custom">campaign</span>
                    Announcements
                </p>

                <div class="space-y-3 text-sm">

                    @forelse($announcements as $announcement)

                        @php
                            $colors = [
                                'bg-green-50 border-green-600 text-green-800',
                                'bg-yellow-50 border-yellow-500 text-yellow-800',
                                'bg-blue-50 border-blue-500 text-blue-800',
                                'bg-red-50 border-red-600 text-red-800',
                                'bg-purple-50 border-purple-600 text-purple-800',
                                'bg-pink-50 border-pink-600 text-pink-800',
                            ];

                            $style = $colors[array_rand($colors)];
                        @endphp

                        <div class="p-3 rounded-lg border-l-4 {{ $style }}">
                            <p class="font-medium">
                                {{ $announcement->title }}
                            </p>
                            <p class="text-gray-600">
                                {{ $announcement->message }}
                            </p>

                            @if($announcement->end_at)
                                <p class="text-xs mt-1 italic text-gray-400">
                                    Until {{ \Carbon\Carbon::parse($announcement->end_at)->format('M d, Y') }}
                                </p>
                            @endif
                        </div>

                    @empty
                        <p class="text-center text-gray-500 italic">
                            No announcements at the moment.
                        </p>
                    @endforelse

                </div>
                <div class="mt-2 text-right">
                    <a href="{{ route('announcements') }}" class="text-sm text-[#2C6E49] hover:underline">View All Announcements &gt;</a>
                </div>
            </div>
            @include('charts.shortcuts-quicklinks')
        </div>
    </div>
</div>




@endsection
