@extends('layouts.app')
@section('content')
<div class="p-4">
    <div class="bg-mainbg px-2">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">View Report</h2>
            </div>
            @include('components.UserTab')
        </div>
    </div>

    <div class="grid grid-cols-12 gap-2">
        <!-- left part -->
        <div class="col-span-12 lg:col-span-8 space-y-2">
            <!-- Top left part -->
            <div class="bg-white shadow-lg rounded-md p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-2xl lg:text-3xl font-bold text-customIT">ITEM NAME</p>
                        <p class="text-sm text-bsctxt">ID: 123456789</p>
                    </div>
                    <div>
                        <button class="border border-btncolor text-sm text-btncolor rounded-[4px] py-1 px-3 hover:bg-btncolor hover:text-white transition-colors">Update</button>
                    </div>
                </div>
            </div>
            <!--  Buttom left part -->
            <div class="bg-white  shadow-lg rounded-md space-y-6 px-6 py-8">
                <div class="flex justify-between items-center">
                    <p class="text-lg font-semibold text-customIT">Latest Report: dd-mm-yyyy</p>
                    <div class="text-xs px-2 py-1 bg-tbr text-gray-700 border rounded-full">To be reviewed</div>
                </div>
                <div>
                    <p class="font-medium text-gray-700 mb-1">User Notes:</p>
                    <div class="border shadow rounded-md px-3 py-4">
                        <p class="text-sm text-bsctxt mt-1">
                            Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        </p>
                    </div>
                </div>
                <div>
                    <p class="font-medium text-gray-700">Report Proof:</p>
                    <div class="mt-2 bg-gray-200 h-72 rounded-md flex items-center justify-center text-gray-500">
                        image
                    </div>
                    <div class="flex space-x-2 mt-2 text-xs">
                        <div class="bg-gray-200 h-16 w-16 flex items-center justify-center text-gray-500 rounded-md">
                            image
                        </div>
                        <div class="bg-gray-200 h-16 w-16 flex items-center justify-center text-gray-500 rounded-md">
                            image
                        </div>
                        <div class="bg-gray-200 h-16 w-16 flex items-center justify-center text-gray-500 rounded-md">
                            image
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- right part -->
        <div class="col-span-12 lg:col-span-4 space-y-2">
            <!-- Top right part -->
            <div class="flex flex-col items-center bg-white shadow-lg rounded-md py-6">
                <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                    class="w-30 h-30 md:w-28 md:h-28 lg:w-36 lg:h-36 xl:w-40 xl:h-40 rounded-full shadow-md mb-2" />   
                <p class="text-2xl font-bold text-customIT">Aeron Jead Marquez</p>
                <p class="text-sm text-bsctxt">REGISTERED MEMBER</p>
                <div><p class="text-lg font-medium text-customIT py-4">ITEM INFORMATION</p></div>
                <div class="grid grid-cols-2 space-x-2">
                    <div class="col-start-1 text-sm space-y-1 text-gray-700">
                        <p class="text-md text-gray-600 font-semibold">Item Name :<span class="text-sm ml-4 font-extralight text-bsctxt">Pongkagkog</span></span>
                        <p class="text-md text-gray-600 font-semibold">Item Type :<span class="text-sm ml-4 font-extralight text-bsctxt">Machinery</span></span>
                        <p class="text-md text-gray-600 font-semibold">Item ID :<span class="text-sm ml-4 font-extralight text-bsctxt">ITEM-00001</span></span>
                    </div>
                    <div class="col-start-2 text-sm space-y-1 text-gray-700">
                        <p class="text-md text-gray-600 font-semibold">Applied at :<span class="text-sm ml-4 font-extralight text-bsctxt">25 Aug 2025</span></span>
                        <p class="text-md text-gray-600 font-semibold">Return date :<span class="text-sm ml-4 font-extralight text-bsctxt">25 Sept 2025</span></span>
                        <p class="text-md text-gray-600 font-semibold">Next report :<span class="text-sm ml-4 font-extralight text-bsctxt">25 Oct 2025</span></span>
                    </div>
                </div>
            </div>
            <!-- buttom right part -->
            <div class="flex flex-col h-auto items-center bg-white shadow-lg rounded-md py-6 px-4">
                <p class="text-xl font-bold text-customIT w-full">Reports History</p>
                <div class="space-y-4 w-full lg:overflow-y-auto lg:h-[54vh]">
                    <!-- Reports-->
                    @for($i = 0; $i < 2; $i++)
                        <div class="p-4 border-b">
                            <div class="flex justify-between items-center">
                                <p class="font-semibold text-md text-customIT">Report #1: dd-mm-yyyy</p>
                                <div class="text-xs px-3 py-1  px-3 py-1 bg-approved text-white rounded-full">Good</div>
                            </div>
                            <div class="mt-2">
                                <p class="font-medium text-sm text-gray-700">User Notes:</p>
                                <div class="items-right border border-gray-200 rounded-md shadow px-2 py-4 ">
                                    <p class="text-xs text-bsctxt mt-1">
                                        Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    </p>
                                </div>
                                <button class="text-xs text-bsctxt mr-2 hover:text-customIT hover:underline">Report proof</button>
                                <button class="text-xs text-bsctxt hover:text-customIT hover:underline">Staff note</button>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection