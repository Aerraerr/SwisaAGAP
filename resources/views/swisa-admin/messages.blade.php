
@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')
<div class="bg-mainbg  min-h-screen flex -m-2">

        <!-- LEFT SIDEBAR (Messages list) -->
        <div class="w-full sm:w-1/3 lg:w-1/4 border-r border-gray-200 flex flex-col">
            <div class="flex items-center justify-between py-2 px-3 border-b border-gray-200">
                <h2 class="text-customIT text-lg font-semibold">Messages <span class="text-customIT ">(13)</span></h2>
                <button class="bg-[#4C956C] hover:bg-[#2C6E49]  text-white rounded-full w-8 h-8 flex items-center justify-center">
                    +
                </button>
            </div>

            <!-- Search bar -->
            <div class="p-3">
                <input type="text" placeholder="Search messages"
                    class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Messages list -->
            <div class="flex-1 overflow-y-auto">
                <div class="p-3 flex items-center gap-2 cursor-pointer hover:bg-gray-100">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49]  flex items-center justify-center text-white">
                        M
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">Member Name</p>
                        <p class="text-xs text-gray-500">message</p>
                        <span class="text-xs text-green-600">Follow up</span>
                    </div>
                    <span class="text-xs text-gray-400">1m</span>
                </div>
                <div class="p-3 flex items-center gap-2 cursor-pointer hover:bg-gray-100">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">
                        A
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">Alfonzo Schuessler</p>
                        <p class="text-xs text-gray-500">message</p>
                        <span class="text-xs text-green-600">Follow up</span>
                    </div>
                    <span class="text-xs text-gray-400">1m</span>
                </div>
                <!-- Repeat for more messages -->
            </div>
        </div>

        <!-- RIGHT CHAT PANEL -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49]  flex items-center justify-center text-white">
                        M
                    </div>
                    <div>
                        <p class="font-medium">Member Name</p>
                        <p class="text-xs text-green-600">● Online</p>
                    </div>
                </div>
                <button class="flex items-center gap-1 text-green-600 hover:text-green-700">
                    <i class="material-icons">call</i>
                    Call
                </button>
            </div>

            <!-- Chat Messages -->
            <div class="flex-1 p-4 overflow-y-auto space-y-3">
                <!-- Member message -->
                <div class="flex items-start gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49]  flex items-center justify-center text-white">
                        M
                    </div>
                    <div class="bg-gray-100 rounded-lg px-3 py-2 text-sm">
                        Hi Admin, I'd like to ask about the grant for swine raisers. <br>
                        Am I eligible to apply?
                    </div>
                </div>

                <!-- Admin reply -->
                <div class="flex items-start justify-end gap-2">
                    <div class="bg-green-100 rounded-lg px-3 py-2 text-sm text-green-800">
                        Good day! <br>
                        Yes, if you're a registered member and meet the production criteria, you can apply.
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49]  flex items-center justify-center text-white">
                        A
                    </div>
                </div>

                <!-- Another Member message -->
                <div class="flex items-start gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49]  flex items-center justify-center text-white">
                        M
                    </div>
                    <div class="bg-gray-100 rounded-lg px-3 py-2 text-sm">
                        I see. <br>
                        Where can I access the application form?
                    </div>
                </div>

                <!-- Admin reply -->
                <div class="flex items-start justify-end gap-2">
                    <div class="bg-green-100 rounded-lg px-3 py-2 text-sm text-green-800">
                        You can find it under the "Grant Application" section in your dashboard. <br>
                        Just log in and click "Apply".
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49]  flex items-center justify-center text-white">
                        A
                    </div>
                </div>

                <!-- Member closing -->
                <div class="flex items-start gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49]  flex items-center justify-center text-white">
                        M
                    </div>
                    <div class="bg-gray-100 rounded-lg px-3 py-2 text-sm">
                        Got it. <br>
                        Thank you so much!
                    </div>
                </div>
            </div>

            <!-- Input box -->
            <div class="border-t border-gray-200 p-3 flex items-center gap-2">
                <input type="text" placeholder="Type a message"
                       class="flex-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                <button class="bg-[#4C956C] hover:bg-[#2C6E49]  text-white p-2 rounded-lg">
                    <i class="material-icons">send</i>
                </button>
            </div>
        </div>
    </div>
@endsection
