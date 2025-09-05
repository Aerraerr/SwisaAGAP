@extends('layouts.app')
@section('content')
<div class="p-4">
    <div class="bg-mainbg px-2">
        <div class="text-customIT text-2xl flex justify-between items-center mb-4">
            <h1 class="font-bold">Member Application Management</h1>
                @include('components.UserTab')
        </div>

        <div class="grid grid-cols-12 gap-1 md:gap-2" x-data="{ selectedUser: null, activeTab: 'All-Request' }" >
            <!-- quick stats -->
            <div class="col-span-12 md:col-span-9 h-64 bg-white rounded-md shadow">
                <p class="font-bold text-center mt-20">LINE CHART</p>
            </div>
            <div class="col-span-12 md:col-span-3 md:col-start-10 bg-white rounded-md shadow py-3 px-5">
                <h2 class="text-customIT text-md font-bold">Application Status Overview</h2>
                <div class="my-2">
                    <h2 class="font-semibold text-gray-600 text-xs">Cumulative Approved Application</h2>
                    <p class="font-semibold text-btncolor text-xl">1,000</p>
                </div>
                <div class="my-2">
                    <h2 class="font-semibold text-gray-600 text-xs">Cumulative Pending Application</h2>
                    <p class="font-semibold text-btncolor text-xl">1,000</p>
                </div>
                <div class="my-2">
                    <h2 class="font-semibold text-gray-600 text-xs">Cumulative Denied Application</h2>
                    <p class="font-semibold text-btncolor text-xl">1,000</p>
                </div>
                <hr class="mx-2 my-3">
                <div class="font-semibold text-btncolor text-xs text-center">
                    <a href="{{route('logs')}}">View All Application Logs</a>
                </div>
            </div>

            <!-- tab -->
            <div class="col-span-12 col-start-1 h-auto bg-white rounded-md shadow">
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 text-center">
                        <!-- All Requests Tab -->
                        <div @click="activeTab = 'All-Request'" :class="activeTab === 'All-Request' 
                                ? 'p-4 bg-btncolor text-white rounded-lg cursor-pointer transition-colors duration-200' 
                                : 'p-4 bg-gray-200 text-gray-700 rounded-sm cursor-pointer transition-colors duration-200 hover:bg-btncolor hover:text-white hover:rounded-lg'">
                            <i class="fas fa-list-ul mb-2 text-2xl"></i>
                            <p class="text-xs font-light">All Requests</p>
                        </div>
                        <!-- Pending Tab -->
                        <div c @click="activeTab = 'Pending-Request'" :class="activeTab === 'Pending-Request' 
                                ? 'p-4 bg-btncolor text-white rounded-lg cursor-pointer transition-colors duration-200' 
                                : 'p-4 bg-gray-200 text-gray-700 rounded-sm cursor-pointer transition-colors duration-200 hover:bg-btncolor hover:text-white hover:rounded-lg'">
                            <i class="fas fa-hourglass-half mb-2 text-2xl"></i>
                            <p class="text-xs font-light">Pending</p>
                        </div>
                        <!-- Approved Tab -->
                        <div @click="activeTab = 'Approved-Request'" :class="activeTab === 'Approved-Request' 
                                ? 'p-4 bg-btncolor text-white rounded-lg cursor-pointer transition-colors duration-200' 
                                : 'p-4 bg-gray-200 text-gray-700 rounded-sm cursor-pointer transition-colors duration-200 hover:bg-btncolor hover:text-white hover:rounded-lg'">
                            <i class="fas fa-check-circle mb-2 text-2xl"></i>
                            <p class="text-xs font-light">Approved</p>
                        </div>
                        <!-- Denied Tab -->
                        <div @click="activeTab = 'Rejected-Request'" :class="activeTab === 'Denied-Request' 
                                ? 'p-4 bg-btncolor text-white rounded-lg cursor-pointer transition-colors duration-200' 
                                : 'p-4 bg-gray-200 text-gray-700 rounded-sm cursor-pointer transition-colors duration-200 hover:bg-btncolor hover:text-white hover:rounded-lg'">
                            <p class="text-xs font-light">Rejected</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- All Request Tab-content -->
            <div x-show="activeTab === 'All-Request'" class="col-span-12 lg:col-span-8 col-start-1 h-full bg-white px-6 py-4 rounded-md shadow">
                    <div class="flex items-center">
                        <img src="{{ asset('images/file-svg-green.svg') }}"
                            class="w-12 h-12" />
                        <p class="text-customIT text-lg font-bold">Request List</p>
                    </div>
                    <div class="flex justify-end mb-2">
                        <input type="text" placeholder="Search here" class="w-1/2 h-9 bg-white text-xs text-gray-700 px-4 border-1 border-gray-300 rounded-md focus:outline-none">
                    </div>
                    <div class="overflow-auto h-[80vh]">
                        <table class="table table-hover min-w-full border-spacing-y-1">
                            <thead class="bg-snbg border-gray-300">
                                <tr class="text-customIT text-left text-xs font-semibold ">
                                    <th class="px-4 py-3 rounded-tl-md">APPLICATION ID</th>
                                    <th class="px-4 py-3">NAME</th>
                                    <th class="px-4 py-3">NUMBER </th>
                                    <th class="px-4 py-3">EMAIL</th>
                                    <th class="px-4 py-3">Date Submitted</th>
                                    <th class="px-4 py-3 rounded-tr-md">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border border-gray-300 hover:bg-gray-100"
                                    @click="selectedUser = {
                                    name: 'Ron Peter Mortega', 
                                    id: 'REQ-ITEM00001', 
                                    date: '15 Aug 2025', 
                                    status: 'Approved',
                                    number: '09090909090',
                                    email: 'rpm@gmail.com' 
                                    }">
                                    <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Ron Peter Mortega</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">09090909090</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">rpm@gmail.com</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                    <td class="px-4 py-3">
                                        <div class="inline-block text-xs font-medium bg-approved text-white text-center px-3 py-1 rounded-full">
                                            Approved
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border border-gray-300 hover:bg-gray-100"
                                    @click="selectedUser = { 
                                    name: 'Aeron Jead Marquez', 
                                    id: 'REQ-ITEM00002', 
                                    date: '15 Aug 2025', 
                                    status: 'Rejected',
                                    phone: '09090909090',
                                    email: 'ajm@gmail.com'
                                    }">
                                    <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">09090909090</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">ajm@gmail.com</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                    <td class="px-4 py-3">
                                        <div class="inline-block text-xs font-medium bg-rejected text-white text-center px-3 py-1 rounded-full">
                                            Rejected
                                        </div>
                                    </td>
                                </tr>
                                @for($i = 0; $i < 10; $i++)
                                    <tr class="border border-gray-300 hover:bg-gray-100"
                                        @click="selectedUser = {
                                        name: 'Random People', 
                                        id: 'REQ-ITEM00000', 
                                        date: '15 Aug 2025', 
                                        status: 'Pending',
                                        phone: '09090909090',
                                        email: 'rp@gmail.com' 
                                        }">
                                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">Random People</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">09090909090</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">rp@gmail.com</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                        <td class="px-4 py-3">
                                            <div class="inline-block text-xs font-medium bg-pending text-white px-3 py-1 rounded-full">
                                                Pending
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    @include('components.pagination')
            </div>

            <div x-show="activeTab === 'All-Request'" class="col-span-12 lg:col-start-9 lg:col-span-4">
                    <div class="flex flex-col bg-white shadow-lg px-8 py-6 h-auto rounded-md text-center overflow-auto">
                        <!-- default display -->
                        <template x-if="!selectedUser">
                            <div class="flex flex-col items-center my-6">
                                <img src="{{ asset('images/file-svg.svg') }}" class="w-32 h-32 pt-4"/>
                                <div class="border-t border-gray-300">
                                    <p class="text-gray-300 font-medium text-md mt-2">Select an application to view details</p>
                                </div>
                            </div>
                        </template>

                        <!-- Show selected user details -->
                        <template x-if="selectedUser" x-data="{ verified: false }">
                            <div class="flex flex-col items-stretch text-left space-y-2">

                                <!-- Header -->
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-bold text-customIT">Application Details</h2>
                                    <span x-text="selectedUser.status" class="text-white text-xs px-3 py-1 rounded-full font-medium"
                                    :class="{
                                        'bg-approved': selectedUser.status === 'Approved',
                                        'bg-pending': selectedUser.status === 'Pending',
                                        'bg-rejected': selectedUser.status === 'Rejected'
                                        }">
                                    </span>
                                </div>

                                <!-- Member Application Info -->
                                <div class="flex gap-4">
                                    <!--image dgd -->
                                    <img src="{{ asset('images/profile-user.png') }}" alt="profile" class="w-10 h-10 rounded-full">
                                    <div>
                                        <h3 x-text="selectedUser.name" class="text-green-700 font-semibold"></h3>
                                        <p class="text-xs font-semibold text-gray-500">Application ID: <span x-text="selectedUser.id" class="font-medium ml-2"></span></p>
                                        <p class="text-xs font-semibold text-gray-500">Date Submitted: <span x-text="selectedUser.date" class="font-medium ml-2"></span></p>
                                    </div>
                                </div>


                                <!-- Requirements Approval -->
                                <h3 class="text-sm font-bold text-customIT">REQUIREMENTS APPROVAL</h3>

                                <!-- Basic Requirements -->
                                <div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>Basic Requirements</p>
                                        <span class="text-approved text-xs font-semibold">Approved</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Registered Member
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Member ID
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Valid ID
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Request Form
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Proof of need
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="text-xs text-approved font-medium">
                                        <p>Checked by the system on 25 August 2025</p>
                                    </div>
                                </div>

                                <!-- Additional Requirements -->
                                {{--<div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2 text-pending">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        Basic Requirements</p>
                                        <span class="text-pending text-xs font-semibold">In process</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Barangay Certificate
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Farm Profile
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 text-pending">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                </div> --}}

                                <!-- Verification Note -->
                                <div class="flex items-center">
                                    <input type="checkbox" x-model="verified" class="peer h-5 w-5 appearance-none rounded-md border border-gray-300 bg-white transition-colors duration-200 checked:bg-btncolor focus:ring-btncolor checked:border-btncolor">
                                    <p class="text-xs text-bsctxt ml-2">All requirements have been reviewed and verified.</p>
                                </div>

                                <!-- Approve Button -->
                                <div class="grid grid-cols-2 pt-4">
                                    <button onclick="openModal('approvedModal')" class="col-start-2 bg-btncolor text-white font-medium py-2 px-4 rounded-md"
                                        :class="verified ? 'bg-opacity-100 hover:bg-opacity-80' : 'bg-opacity-50'"
                                        :disabled="!verified">
                                        Approve
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
            </div>

            <!-- Pending Tab-content -->
            <div x-show="activeTab === 'Pending-Request'" class="col-span-12 lg:col-span-8 col-start-1 h-full bg-white px-6 py-4 rounded-md shadow">
                    <div class="flex items-center">
                        <img src="{{ asset('images/file-svg-green.svg') }}"
                            class="w-12 h-12" />
                        <p class="text-customIT text-lg font-bold">Request List</p>
                    </div>
                    <div class="flex justify-end mb-2">
                        <input type="text" placeholder="Search here" class="w-1/2 h-9 bg-white text-xs text-gray-700 px-4 border-1 border-gray-300 rounded-md focus:outline-none">
                    </div>
                    <div class="overflow-auto h-[80vh]">
                        <table class="table table-hover min-w-full border-spacing-y-1">
                            <thead class="bg-snbg border-gray-300">
                                <tr class="text-customIT text-left text-xs font-semibold ">
                                    <th class="px-4 py-3 rounded-tl-md">APPLICATION ID</th>
                                    <th class="px-4 py-3">MEMBER</th>
                                    <th class="px-4 py-3">NUMBER</th>
                                    <th class="px-4 py-3">EMAIL</th>
                                    <th class="px-4 py-3">Date Submitted</th>
                                    <th class="px-4 py-3 rounded-tr-md">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border border-gray-300 hover:bg-gray-100"
                                    @click="selectedUser = {
                                    name: 'Ron Peter Mortega', 
                                    id: 'REQ-ITEM00001', 
                                    date: '15 Aug 2025', 
                                    status: 'Pending',
                                    phone: '09090909090',
                                    email: 'rpm@gmail.com' 
                                    }">
                                    <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Ron Peter Mortega</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">09090909090</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">rpm@gmail.com</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                    <td class="px-4 py-3">
                                        <div class="inline-block text-xs font-medium bg-pending text-white text-center px-3 py-1 rounded-full">
                                            Pending
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border border-gray-300 hover:bg-gray-100"
                                    @click="selectedUser = { 
                                    name: 'Aeron Jead Marquez', 
                                    id: 'REQ-ITEM00002', 
                                    date: '15 Aug 2025', 
                                    status: 'Pending',
                                    phone: '09090909090',
                                    email: 'ajm@gmail.com'
                                    }">
                                    <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">09090909090</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">ajm@gmail.com</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                    <td class="px-4 py-3">
                                        <div class="inline-block text-xs font-medium bg-pending text-white text-center px-3 py-1 rounded-full">
                                            Pending
                                        </div>
                                    </td>
                                </tr>
                                @for($i = 0; $i < 10; $i++)
                                    <tr class="border border-gray-300 hover:bg-gray-100"
                                        @click="selectedUser = {
                                        name: 'Random People', 
                                        id: 'REQ-ITEM00000', 
                                        date: '15 Aug 2025', 
                                        status: 'Pending',
                                        phone: '09090909090',
                                        email: 'rp@gmail.com' 
                                        }">
                                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">Random People</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">09090909090</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">rp@gmail.com</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                        <td class="px-4 py-3">
                                            <div class="inline-block text-xs font-medium bg-pending text-white px-3 py-1 rounded-full">
                                                Pending
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    @include('components.pagination')
            </div>

            <div x-show="activeTab === 'Pending-Request'" class="col-span-12 lg:col-start-9 lg:col-span-4">
                    <div class="flex flex-col bg-white shadow-lg px-8 py-6 h-auto rounded-md text-center overflow-auto">
                        <!-- default display -->
                        <template x-if="!selectedUser">
                            <div class="flex flex-col items-center my-6">
                                <img src="{{ asset('images/file-svg.svg') }}" class="w-32 h-32 pt-4"/>
                                <div class="border-t border-gray-300">
                                    <p class="text-gray-300 font-medium text-md mt-2">Select a request to view details</p>
                                </div>
                            </div>
                        </template>

                        <!-- Show selected user details -->
                        <template x-if="selectedUser" x-data="{ verified: false }">
                            <div class="flex flex-col items-stretch text-left space-y-2">

                                <!-- Header -->
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-bold text-customIT">Requested Item</h2>
                                    <span x-text="selectedUser.status" class="text-white text-xs px-3 py-1 rounded-full font-medium"
                                    :class="{
                                        'bg-approved': selectedUser.status === 'Approved',
                                        'bg-pending': selectedUser.status === 'Pending',
                                        'bg-rejected': selectedUser.status === 'Rejected'
                                        }">
                                    </span>
                                </div>

                                <!-- Member Application Info -->
                                <div class="flex gap-4">
                                    <!--image dgd -->
                                    <img src="{{ asset('images/profile-user.png') }}" alt="profile" class="w-10 h-10 rounded-full">
                                    <div>
                                        <h3 x-text="selectedUser.name" class="text-green-700 font-semibold"></h3>
                                        <p class="text-xs font-semibold text-gray-500">Application ID: <span x-text="selectedUser.id" class="font-medium ml-2"></span></p>
                                        <p class="text-xs font-semibold text-gray-500">Date Submitted: <span x-text="selectedUser.date" class="font-medium ml-2"></span></p>
                                    </div>
                                </div>

                                <!-- Requirements Approval -->
                                <h3 class="text-sm font-bold text-customIT">REQUIREMENTS APPROVAL</h3>

                                <!-- Basic Requirements -->
                                <div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 text-pending mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            Basic Requirements</p>
                                        <span class="text-pending text-xs font-semibold">Pending</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Member ID
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Valid ID
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 text-pending">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Application Form
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="text-xs text-approved font-medium">
                                        <p>Pending for the system to checked on it</p>
                                    </div>
                                </div>

                                <!-- Additional Requirements -->
                                {{--<div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2 text-pending">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        Basic Requirements</p>
                                        <span class="text-pending text-xs font-semibold">In process</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Barangay Certificate
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Farm Profile
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 text-pending">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                </div>--}}

                                <!-- Verification Note -->
                                <div class="flex items-center">
                                    <input type="checkbox" x-model="verified" class="peer h-5 w-5 appearance-none rounded-md border border-gray-300 bg-white transition-colors duration-200 checked:bg-btncolor focus:ring-btncolor checked:border-btncolor">
                                    <p class="text-xs text-bsctxt ml-2">All requirements have been reviewed and verified.</p>
                                </div>

                                <!-- Approve Button -->
                                <div class="grid grid-cols-2 pt-4">
                                    <button onclick="openModal('approvedModal')" class="col-start-2 bg-btncolor text-white font-medium py-2 px-4 rounded-md"
                                        :class="verified ? 'bg-opacity-100 hover:bg-opacity-80' : 'bg-opacity-50'"
                                        :disabled="!verified">
                                        Approve
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
            </div>

            <!-- Approved Tab-content -->
            <div x-show="activeTab === 'Approved-Request'" class="col-span-12 lg:col-span-8 col-start-1 h-full bg-white px-6 py-4 rounded-md shadow">
                    <div class="flex items-center">
                        <img src="{{ asset('images/file-svg-green.svg') }}"
                            class="w-12 h-12" />
                        <p class="text-customIT text-lg font-bold">Request List</p>
                    </div>
                    <div class="flex justify-end mb-2">
                        <input type="text" placeholder="Search here" class="w-1/2 h-9 bg-white text-xs text-gray-700 px-4 border-1 border-gray-300 rounded-md focus:outline-none">
                    </div>
                    <div class="overflow-auto h-[80vh]">
                        <table class="table table-hover min-w-full border-spacing-y-1">
                            <thead class="bg-snbg border-gray-300">
                                <tr class="text-customIT text-left text-xs font-semibold ">
                                    <th class="px-4 py-3 rounded-tl-md">APPLICATION ID</th>
                                    <th class="px-4 py-3">MEMBER</th>
                                    <th class="px-4 py-3">NUMBER</th>
                                    <th class="px-4 py-3">EMAIL</th>
                                    <th class="px-4 py-3">Date Submitted</th>
                                    <th class="px-4 py-3 rounded-tr-md">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border border-gray-300 hover:bg-gray-100"
                                    @click="selectedUser = {
                                    name: 'Ron Peter Mortega', 
                                    id: 'REQ-ITEM00001', 
                                    date: '15 Aug 2025', 
                                    status: 'Approved',
                                    phone: '09090909090',
                                    email: 'rpm@gmail.com' 
                                    }">
                                    <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Ron Peter Mortega</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">09090909090</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">rpm@gmail.com</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                    <td class="px-4 py-3">
                                        <div class="inline-block text-xs font-medium bg-approved text-white text-center px-3 py-1 rounded-full">
                                            Approved
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border border-gray-300 hover:bg-gray-100"
                                    @click="selectedUser = { 
                                    name: 'Aeron Jead Marquez', 
                                    id: 'REQ-ITEM00002', 
                                    date: '15 Aug 2025', 
                                    status: 'Approved',
                                    phone: '09090909090',
                                    email: 'ajm@gmail.com'
                                    }">
                                    <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">09090909090</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">ajm@gmail.com</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                    <td class="px-4 py-3">
                                        <div class="inline-block text-xs font-medium bg-approved text-white text-center px-3 py-1 rounded-full">
                                            Approved
                                        </div>
                                    </td>
                                </tr>
                                @for($i = 0; $i < 10; $i++)
                                    <tr class="border border-gray-300 hover:bg-gray-100"
                                        @click="selectedUser = {
                                        name: 'Random People', 
                                        id: 'REQ-ITEM00000', 
                                        date: '15 Aug 2025', 
                                        status: 'Approved',
                                        phone: '09090909090',
                                        email: 'rp@gmail.com' 
                                        }">
                                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">Random People</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">09090909090</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">rp@gmail.com</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                        <td class="px-4 py-3">
                                            <div class="inline-block text-xs font-medium bg-approved text-white px-3 py-1 rounded-full">
                                                Approved
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    @include('components.pagination')
            </div>

            <div x-show="activeTab === 'Approved-Request'" class="col-span-12 lg:col-start-9 lg:col-span-4">
                    <div class="flex flex-col bg-white shadow-lg px-8 py-6 h-auto rounded-md text-center overflow-auto">
                        <!-- default display -->
                        <template x-if="!selectedUser">
                            <div class="flex flex-col items-center my-6">
                                <img src="{{ asset('images/file-svg.svg') }}" class="w-32 h-32 pt-4"/>
                                <div class="border-t border-gray-300">
                                    <p class="text-gray-300 font-medium text-md mt-2">Select a request to view details</p>
                                </div>
                            </div>
                        </template>

                        <!-- Show selected user details -->
                        <template x-if="selectedUser" x-data="{ verified: false }">
                            <div class="flex flex-col items-stretch text-left space-y-2">

                                <!-- Header -->
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-bold text-customIT">Requested Item</h2>
                                    <span x-text="selectedUser.status" class="text-white text-xs px-3 py-1 rounded-full font-medium"
                                    :class="{
                                        'bg-approved': selectedUser.status === 'Approved',
                                        'bg-pending': selectedUser.status === 'Pending',
                                        'bg-rejected': selectedUser.status === 'Rejected'
                                        }">
                                    </span>
                                </div>

                                <!-- Member Application Info -->
                                <div class="flex gap-4">
                                    <!--image dgd -->
                                    <img src="{{ asset('images/profile-user.png') }}" alt="profile" class="w-10 h-10 rounded-full">
                                    <div>
                                        <h3 x-text="selectedUser.name" class="text-green-700 font-semibold"></h3>
                                        <p class="text-xs font-semibold text-gray-500">Application ID: <span x-text="selectedUser.id" class="font-medium ml-2"></span></p>
                                        <p class="text-xs font-semibold text-gray-500">Date Submitted: <span x-text="selectedUser.date" class="font-medium ml-2"></span></p>
                                    </div>
                                </div>

                                <!-- Requirements Approval -->
                                <h3 class="text-sm font-bold text-customIT">REQUIREMENTS APPROVAL</h3>

                                <!-- Basic Requirements -->
                                <div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>Basic Requirements</p>
                                        <span class="text-approved text-xs font-semibold">Approved</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Registered Member
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Member ID
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Valid ID
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Request Form
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Proof of need
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="text-xs text-approved font-medium">
                                        <p>*Checked by the system on 25 August 2025</p>
                                    </div>
                                </div>

                                <!-- Additional Requirements -->
                                {{--<div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2 text-pending">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        Basic Requirements</p>
                                        <span class="text-pending text-xs font-semibold">In process</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Barangay Certificate
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Farm Profile
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 text-pending">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                </div>--}}

                                <!-- Verification Note -->
                                <div class="flex items-center">
                                    <input type="checkbox" x-model="verified" class="peer h-5 w-5 appearance-none rounded-md border border-gray-300 bg-white transition-colors duration-200 checked:bg-btncolor focus:ring-btncolor checked:border-btncolor">
                                    <p class="text-xs text-bsctxt ml-2">All requirements have been reviewed and verified.</p>
                                </div>

                                <!-- Approve Button -->
                                <div class="grid grid-cols-2 pt-4">
                                    <button onclick="openModal('approvedModal')" class="col-start-2 bg-btncolor text-white font-medium py-2 px-4 rounded-md"
                                        :class="verified ? 'bg-opacity-100 hover:bg-opacity-80' : 'bg-opacity-50'"
                                        :disabled="!verified">
                                        Approve
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
            </div>

            <!-- Rejected Tab-content -->
            <div x-show="activeTab === 'Rejected-Request'" class="col-span-12 lg:col-span-8 col-start-1 h-full bg-white px-6 py-4 rounded-md shadow">
                    <div class="flex items-center">
                        <img src="{{ asset('images/file-svg-green.svg') }}"
                            class="w-12 h-12" />
                        <p class="text-customIT text-lg font-bold">Request List</p>
                    </div>
                    <div class="flex justify-end mb-2">
                        <input type="text" placeholder="Search here" class="w-1/2 h-9 bg-white text-xs text-gray-700 px-4 border-1 border-gray-300 rounded-md focus:outline-none">
                    </div>
                    <div class="overflow-auto h-[80vh]">
                        <table class="table table-hover min-w-full border-spacing-y-1">
                            <thead class="bg-snbg border-gray-300">
                                <tr class="text-customIT text-left text-xs font-semibold ">
                                    <th class="px-4 py-3 rounded-tl-md">APPLICATION ID</th>
                                    <th class="px-4 py-3">MEMBER</th>
                                    <th class="px-4 py-3">NUMBER</th>
                                    <th class="px-4 py-3">EMAIL</th>
                                    <th class="px-4 py-3">Date Submitted</th>
                                    <th class="px-4 py-3 rounded-tr-md">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border border-gray-300 hover:bg-gray-100"
                                    @click="selectedUser = {
                                    name: 'Ron Peter Mortega', 
                                    id: 'REQ-ITEM00001', ,
                                    date: '15 Aug 2025', 
                                    status: 'Rejected',
                                    phone: '09090909090',
                                    email: 'rpm@gmail.com' 
                                    }">
                                    <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Ron Peter Mortega</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Organic Fertilizer</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                    <td class="px-4 py-3">
                                        <div class="inline-block text-xs font-medium bg-rejected text-white text-center px-3 py-1 rounded-full">
                                            Rejected
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border border-gray-300 hover:bg-gray-100"
                                    @click="selectedUser = { 
                                    name: 'Aeron Jead Marquez', 
                                    id: 'REQ-ITEM00002', 
                                    item: 'Rolls-Royce',
                                    type: 'Machinery',
                                    date: '15 Aug 2025', 
                                    status: 'Rejected',
                                    phone: '09090909090',
                                    email: 'ajm@gmail.com'
                                    }">
                                    <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Rolls-Royce</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                                    <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                    <td class="px-4 py-3">
                                        <div class="inline-block text-xs font-medium bg-rejected text-white text-center px-3 py-1 rounded-full">
                                            Rejected
                                        </div>
                                    </td>
                                </tr>
                                @for($i = 0; $i < 10; $i++)
                                    <tr class="border border-gray-300 hover:bg-gray-100"
                                        @click="selectedUser = {
                                        name: 'Random People', 
                                        id: 'REQ-ITEM00000', 
                                        item: 'Rice Seeds',
                                        type: 'Seeds',
                                        date: '15 Aug 2025', 
                                        status: 'Rejected',
                                        phone: '09090909090',
                                        email: 'rp@gmail.com' 
                                        }">
                                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">Random People</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">Rice Seeds</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">Seeds</td>
                                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                                        <td class="px-4 py-3">
                                            <div class="inline-block text-xs font-medium bg-rejected text-white px-3 py-1 rounded-full">
                                                Rejected
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    @include('components.pagination')
            </div>

            <div x-show="activeTab === 'Rejected-Request'" class="col-span-12 lg:col-start-9 lg:col-span-4">
                    <div class="flex flex-col bg-white shadow-lg px-8 py-6 h-auto rounded-md text-center overflow-auto">
                        <!-- default display -->
                        <template x-if="!selectedUser">
                            <div class="flex flex-col items-center my-6">
                                <img src="{{ asset('images/file-svg.svg') }}" class="w-32 h-32 pt-4"/>
                                <div class="border-t border-gray-300">
                                    <p class="text-gray-300 font-medium text-md mt-2">Select a request to view details</p>
                                </div>
                            </div>
                        </template>

                        <!-- Show selected user details -->
                        <template x-if="selectedUser" x-data="{ verified: false }">
                            <div class="flex flex-col items-stretch text-left space-y-2">

                                <!-- Header -->
                                <div class="flex justify-between items-center">
                                    <h2 class="text-lg font-bold text-customIT">Requested Item</h2>
                                    <span x-text="selectedUser.status" class="text-white text-xs px-3 py-1 rounded-full font-medium"
                                    :class="{
                                        'bg-approved': selectedUser.status === 'Approved',
                                        'bg-pending': selectedUser.status === 'Pending',
                                        'bg-rejected': selectedUser.status === 'Rejected'
                                        }">
                                    </span>
                                </div>

                                <!-- Item Info -->
                                <div class="flex gap-4">
                                    <!--image dgd -->
                                    <img src="{{ asset('images/profile-user.png') }}" alt="profile" class="w-10 h-10 rounded-full">
                                    <div>
                                        <h3 x-text="selectedUser.name" class="text-green-700 font-semibold"></h3>
                                        <p class="text-xs font-semibold text-gray-500">Application ID: <span x-text="selectedUser.id" class="font-medium ml-2"></span></p>
                                        <p class="text-xs font-semibold text-gray-500">Date Submitted: <span x-text="selectedUser.date" class="font-medium ml-2"></span></p>
                                    </div>
                                </div>

                                <!-- Requirements Approval -->
                                <h3 class="text-sm font-bold text-customIT">REQUIREMENTS APPROVAL</h3>

                                <!-- Basic Requirements -->
                                <div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-rejected mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            Basic Requirements
                                        </p>
                                        <span class="text-rejected text-xs font-semibold">rejected</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Member ID
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-rejected">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Valid ID
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-rejected">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Application Form
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-rejected">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="text-xs text-approved font-medium">
                                        <p class="cursor-pointer">Checked by the system and it's rejected.</p>
                                    </div>
                                </div>

                                <!-- Additional Requirements -->
                                {{--<div class="border rounded-md p-4 space-y-2">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="flex items-center font-semibold text-sm text-customIT">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 mr-2 text-pending">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        Basic Requirements</p>
                                        <span class="text-pending text-xs font-semibold">In process</span>
                                    </div>
                                    <ul class="space-y-1 font-medium text-xs text-gray-600 px-4">
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Barangay Certificate
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex justify-between items-center cursor-pointer hover:text-gray-700">
                                            <span onclick="openModal('requirementModal')" class="flex">Farm Profile
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="12" viewBox="0 0 48 48" class="text-customIT ml-1">
                                                <path d="M 41.470703 4.9863281 A 1.50015 1.50015 0 0 0 41.308594 5 L 27.5 5 A 1.50015 1.50015 0 1 0 27.5 8 L 37.878906 8 L 22.439453 23.439453 A 1.50015 1.50015 0 1 0 24.560547 25.560547 L 40 10.121094 L 40 20.5 A 1.50015 1.50015 0 1 0 43 20.5 L 43 6.6894531 A 1.50015 1.50015 0 0 0 41.470703 4.9863281 z M 12.5 8 C 8.3754991 8 5 11.375499 5 15.5 L 5 35.5 C 5 39.624501 8.3754991 43 12.5 43 L 32.5 43 C 36.624501 43 40 39.624501 40 35.5 L 40 25.5 A 1.50015 1.50015 0 1 0 37 25.5 L 37 35.5 C 37 38.003499 35.003499 40 32.5 40 L 12.5 40 C 9.9965009 40 8 38.003499 8 35.5 L 8 15.5 C 8 12.996501 9.9965009 11 12.5 11 L 22.5 11 A 1.50015 1.50015 0 1 0 22.5 8 L 12.5 8 z"></path>
                                                </svg>
                                            </span>
                                            <span class="text-approved">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 text-pending">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </span>
                                        </li>
                                    </ul>
                                </div>--}}
                            </div>
                        </template>
                    </div>
            </div>
        </div>
    </div>
</div>
@include('components.modals.requirement-view')
@include('components.modals.approved-modal')
@endsection
