@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')

<div class="h-screen flex" x-data="{ activeChat: 1 }">
    <!-- LEFT SIDEBAR -->
    <div class="w-full h-[110%] sm:w-1/3 lg:w-1/4 border-r border-gray-200 flex flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between py-2 px-3 border-b border-gray-200">
            <h2 class="text-customIT text-lg font-semibold">Messages <span class="text-customIT">(3)</span></h2>
            <button class="bg-[#4C956C] hover:bg-[#2C6E49] text-white rounded-full w-8 h-8 flex items-center justify-center">
                +
            </button>
        </div>

        <!-- Search bar -->
        <div class="p-3">
            <input type="text" placeholder="Search messages"
                class="w-full p-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <!-- Messages list -->
        <div class="w-full flex-1 overflow-y-auto">
            <!-- Member 1 -->
            <button @click="activeChat = 1"
                class="w-full text-left p-3 flex items-center gap-2 hover:bg-gray-100 focus:bg-gray-200 transition"
                :class="{ 'bg-gray-200': activeChat === 1 }">
                <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">M</div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-medium truncate">Maria Santos</p>
                    <p class="text-xs text-gray-500 truncate">Hi Admin, about the grant...</p>
                </div>
                <span class="text-xs text-gray-400">2m</span>
            </button>

            <!-- Member 2 -->
            <button @click="activeChat = 2"
                class="w-full text-left p-3 flex items-center gap-2 hover:bg-gray-100 focus:bg-gray-200 transition"
                :class="{ 'bg-gray-200': activeChat === 2 }">
                <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">A</div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-medium truncate">Alfonzo Schuessler</p>
                    <p class="text-xs text-gray-500 truncate">Thanks for the info...</p>
                </div>
                <span class="text-xs text-gray-400">5m</span>
            </button>

            <!-- Member 3 -->
            <button @click="activeChat = 3"
                class="w-full text-left p-3 flex items-center gap-2 hover:bg-gray-100 focus:bg-gray-200 transition"
                :class="{ 'bg-gray-200': activeChat === 3 }">
                <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">J</div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-medium truncate">Juan Dela Cruz</p>
                    <p class="text-xs text-gray-500 truncate">Where can I register?</p>
                </div>
                <span class="text-xs text-gray-400">10m</span>
            </button>
        </div>
    </div>

    <!-- RIGHT CHAT PANEL -->
    <div class="flex-1 h-[110%] flex flex-col">
        <!-- Chat for Member 1 -->
        <div x-show="activeChat === 1" class="flex-1 flex flex-col">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">M</div>
                    <div>
                        <p class="font-medium">Maria Santos</p>
                        <p class="text-xs text-green-600">● Online</p>
                    </div>
                </div>
                <button class="flex items-center gap-1 text-green-600 hover:text-green-700">
                    <i class="material-icons">call</i> Call
                </button>
            </div>

            <!-- Messages -->
            <div class="flex-1 p-4 overflow-y-auto space-y-3">
                <div class="flex items-start gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">M</div>
                    <div class="bg-gray-100 rounded-lg px-3 py-2 text-sm">
                        Hi Admin, I'd like to ask about the grant for swine raisers. Am I eligible to apply?
                    </div>
                </div>
                <div class="flex items-start justify-end gap-2">
                    <div class="bg-green-100 rounded-lg px-3 py-2 text-sm text-green-800">
                        Yes, if you're a registered member and meet the production criteria, you can apply.
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">A</div>
                </div>
            </div>

            <!-- Input -->
            <div class="border-t border-gray-200 p-3 flex items-center gap-2">
                <input type="text" placeholder="Type a message"
                    class="flex-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                <button class="bg-[#4C956C] hover:bg-[#2C6E49] text-white p-2 rounded-lg">
                    <i class="material-icons">send</i>
                </button>
            </div>
        </div>

        <!-- Chat for Member 2 -->
        <div x-show="activeChat === 2" class="flex-1 flex flex-col">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">A</div>
                    <div>
                        <p class="font-medium">Alfonzo Schuessler</p>
                        <p class="text-xs text-green-600">● Online</p>
                    </div>
                </div>
            </div>
            <div class="flex-1 p-4 overflow-y-auto space-y-3">
                <div class="flex items-start gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">A</div>
                    <div class="bg-gray-100 rounded-lg px-3 py-2 text-sm">
                        Thanks for helping me last time!
                    </div>
                </div>
                <div class="flex items-start justify-end gap-2">
                    <div class="bg-green-100 rounded-lg px-3 py-2 text-sm text-green-800">
                        Always welcome! Do you need help with something else?
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">A</div>
                </div>
            </div>
        </div>

        <!-- Chat for Member 3 -->
        <div x-show="activeChat === 3" class="flex-1 flex flex-col">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">J</div>
                    <div>
                        <p class="font-medium">Juan Dela Cruz</p>
                        <p class="text-xs text-gray-500">Last seen 5m ago</p>
                    </div>
                </div>
            </div>
            <div class="flex-1 p-4 overflow-y-auto space-y-3">
                <div class="flex items-start gap-2">
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">J</div>
                    <div class="bg-gray-100 rounded-lg px-3 py-2 text-sm">
                        Where can I register for training?
                    </div>
                </div>
                <div class="flex items-start justify-end gap-2">
                    <div class="bg-green-100 rounded-lg px-3 py-2 text-sm text-green-800">
                        You can register via your dashboard under the "Training Programs" tab.
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white">A</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
