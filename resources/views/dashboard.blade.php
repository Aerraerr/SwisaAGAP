@extends('layouts.sidebar')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fordashboard.css') }}">
</head>
<body class="bg-[#F2F5F3] p-6 font-product">
    <div class="flex justify-between items-start mb-6">
        <h2 class="text-[25px] font-bold text-custom">Dashboard</h2>
        <div class="text-right text-custom font-normal">
            <p class="text-md">Monday, 00 Month 2025</p>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-6">
        <!-- Total Registered Members -->
        <div class="col-span-1 bg-[#2C6E49] text-white p-6 rounded-xl shadow-lg font-product">
            <div class="flex items-start gap-4">
                <img src="{{ asset('images/right.png') }}" alt="Check Icon" class="w-12 h-12 object-contain mt-1" />
                <div class="flex flex-col justify-center w-full">
                    <p class="text-xl text-bold font-product tracking-wide">Total Registered Members</p>
                    <h1 class="text-4xl font-bold leading-snug">1,233</h1>
                    <div class="text-right mt-5">
                        <a href="#" class="text-sm text-white ">View All Members &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty placeholder -->
        <div class="col-span-2 bg-white p-6 rounded-xl shadow"></div>

        <!-- Messages -->
        <div class="col-span-1 bg-white p-6 rounded-xl shadow-lg">
            <div class="flex justify-between items-center">
                <p class="font-semibold text-custom">Messages</p>
                <p class="text-sm">2 unread messages</p>
            </div>
            <div class="flex mt-4 space-x-2">
                <img src="https://i.pravatar.cc/40?img=1" class="w-8 h-8 rounded-full">
                <img src="https://i.pravatar.cc/40?img=2" class="w-8 h-8 rounded-full">
                <img src="https://i.pravatar.cc/40?img=3" class="w-8 h-8 rounded-full">
            </div>
            <div class="text-right mt-4">
                <a href="#" class="text-xs text-custom ">All messages &rarr;</a>
            </div>
        </div>

        <!-- Monthly Request Submissions -->
        <div class="col-span-2 bg-white p-6 rounded-xl shadow">
            <p class="font-semibold mb-2">Monthly Request Submissions</p>
            <div class="h-40 bg-gray-100 flex items-center justify-center">[Line Chart]</div>
            <div class="text-right mt-2">
                <a href="#" class="text-xs text-custom ">View &rarr;</a>
            </div>
        </div>

        <!-- Request Status Overview -->
        <div class="col-span-1 bg-white p-6 rounded-xl shadow">
            <p class="font-semibold mb-2">Request Status Overview</p>
            <div class="h-40 bg-gray-100 flex items-center justify-center">[Pie Chart]</div>
            <div class="text-right mt-2">
                <a href="#" class="text-xs text-custom ">View &rarr;</a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-span-1 bg-white p-6 rounded-xl shadow">
            <p class="font-semibold mb-2">Recent Activity</p>
            <ul class="text-sm space-y-1">
                <li><span class="text-green-600">●</span> Aeron Jead Marquez submitted a new request. <span class="text-gray-500">2 hours ago</span></li>
                <li><span class="text-green-600">●</span> Aeron Jead Marquez submitted a new request. <span class="text-gray-500">2 hours ago</span></li>
                <li><span class="text-green-600">●</span> Aeron Jead Marquez submitted a new request. <span class="text-gray-500">2 hours ago</span></li>
                <li><span class="text-green-600">●</span> Aeron Jead Marquez submitted a new request. <span class="text-gray-500">2 hours ago</span></li>
            </ul>
            <div class="text-right mt-2">
                <a href="#" class="text-xs text-custom ">View All Activity &rarr;</a>
            </div>
        </div>

        <!-- Top Requested Equipment / Grants Monitoring -->
        <div class="col-span-2 bg-white p-6 rounded-xl shadow">
            <p class="font-semibold mb-2">Top Requested Equipment / Grants Monitoring</p>
            <div class="text-sm space-y-2">
                <div class="flex justify-between">
                    <span>01 Item Name</span>
                    <span>85%</span>
                </div>
                <div class="w-full h-2 bg-gray-200 rounded-full">
                    <div class="h-2 bg-green-600 rounded-full w-[85%]"></div>
                </div>

                <div class="flex justify-between">
                    <span>02 Item Name</span>
                    <span>17%</span>
                </div>
                <div class="w-full h-2 bg-gray-200 rounded-full">
                    <div class="h-2 bg-green-600 rounded-full w-[17%]"></div>
                </div>
            </div>
        </div>

        <!-- Member Type Breakdown -->
        <div class="col-span-1 bg-white p-6 rounded-xl shadow">
            <p class="font-semibold mb-2">Member Type Breakdown</p>
            <div class="h-40 bg-gray-100 flex items-center justify-center">[Bar Chart]</div>
            <div class="text-right mt-2">
                <a href="#" class="text-xs text-custom ">View &rarr;</a>
            </div>
        </div>

        <!-- Shortcuts / Quick Links -->
        <div class="col-span-1 bg-white p-6 rounded-xl shadow">
            <p class="font-semibold">Shortcuts / Quick Links</p>
            <ul class="text-sm mt-2 space-y-1">
                <li><a href="#" class="text-custom ">Add Member</a></li>
                <li><a href="#" class="text-custom ">Post Announcement</a></li>
                <li><a href="#" class="text-custom ">View Training</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
@endsection
