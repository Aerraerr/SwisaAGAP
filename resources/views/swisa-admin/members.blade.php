@extends('layouts.sidebar')
@section('content')
<body class="bg-mainbg">
    <div class="text-customIT text-2xl flex justify-between items-center mb-4">
        <h1 class="font-bold">Registered Members</h1>
        <h1>Monday, 00 Month 2025</h1>
    </div>

        <div class="flex mb-2 gap-1">
            <button onclick="toggleModal('upload-modal')" class="bg-btncolor w-[50px] text-white border rounded-[3px] ml-[38%] p-1">&#43;</button>
            <div class="relative flex-grow justify-between">
                <select id="#" style="padding-left:10px; height:35px; width:190px;" class="w-full text-white bg-btncolor border rounded-[3px]">
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">sort</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                </select>
                <div class=" justify-between pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                    <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.05 6.884 4.636 8.3L9.293 12.95z" />
                    </svg>
                </div>
            </div>
            <div class="relative flex-grow">
                <select id="#" style="padding-left:10px; height:35px; width:190px;" class="w-full text-white bg-btncolor border rounded-[3px]">
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">sort</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.05 6.884 4.636 8.3L9.293 12.95z" />
                </svg>
                </div>
            </div>
            <div class="relative flex-grow flex items-center shadow-lg rounded-lg">
                <input type="text" placeholder="Search here" class="w-full h-9 bg-white text-gray-700 px-4 border-1.5 rounded-l-[3px] focus:outline-none">
                <button class="bg-btncolor text-white p-2 rounded-r-lg hover:bg-customIT transition duration-300 ease-in-out h-9 w-9">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                </svg>
                </button>
            </div>
        </div>

        <div class="p-4 sm:p-6 lg:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- For demonstration, hardcoded cards are used --}}
                
                {{-- Active Members --}}
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="active"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />

                {{-- Inactive Members --}}
                <x-member-card
                    status="inactive"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="inactive"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />
                <x-member-card
                    status="inactive"
                    name="Full Name"
                    role="General Producer"
                    memberId="123-456"
                    registered="1/01/2023"
                    meetings="Meetings: 10/10"
                />

            </div>
        </div>
</body>    
@endsection
