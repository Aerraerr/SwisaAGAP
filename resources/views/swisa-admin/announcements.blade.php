@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')
    <!-- Page Header -->
<div class="p-4">
    <div class="bg-mainbg px-4 min-h-screen">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
            <!-- Left side -->
            <div class="text-customIT flex flex-col">
                <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Announcement</h2>
                <p class="text-sm text-gray-600">Manage, track, and publish important information for SWISA members.</p>
            </div>
        </div>

        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Create New Announcement (Left) -->
            <div class="bg-white shadow-md rounded-lg p-6 md:col-span-1">
                <h2 class="text-lg font-semibold text-customIT mb-4 flex items-center">
                    <i class="material-icons mr-1">campaign</i>
                    Create New Announcement
                </h2>
                
                <form action="{{ route('announcement.store')}}" method="POST" 
                enctype="multipart/form-data" class="space-y-4">
                @csrf
                    <div class="mb-4">
                        <label for="announcement_title" class="text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="announcement_title" id="announcement_title" placeholder="e.g., General Meeting" class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent" required>
                    </div>

                    <div class="mb-4">
                        <label for="announcement_content" class="text-sm font-medium text-gray-700">Content</label>
                        <textarea name="announcement_content" id="announcement_content" rows="4" placeholder="Write your message here..." class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent" required></textarea>
                    </div>

                    {{--<div class="mb-4">
                        <label for="announcement_files" class="text-sm font-medium text-gray-700">Attach Files / Images</label>
                        <input type="file" name="announcement_files" id="announcement_files" class="block w-full text-sm mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-customIT file:text-white hover:file:bg-customIT/90" />
                    </div>--}}

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="announcement_audience" class="text-sm font-medium text-gray-700">Audience</label>
                            <select name="announcement_audience" id="announcement_audience" class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent">
                                <option value="">Select Audience</option>
                                @foreach(\App\Models\Announcement::AUDIENCE as $audience)
                                    <option value="{{ $audience }}">{{ $audience }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="announcement_status" class="text-sm font-medium text-gray-700">Status</label>
                            <select name="announcement_status" id="announcement_status" class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ old('announcement_status') == $status->id ? 'selected' : '' }}>
                                        {{ $status->status_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="announcement_start" class="text-sm font-medium text-gray-700">Visible From</label>
                            <input type="date" name="announcement_start" id="announcement_start" class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent" required/>
                        </div>
                        <div>
                            <label for="announcement_end" class="text-sm font-medium text-gray-700">Visible Until</label>
                            <input type="date" name="announcement_end" id="announcement_end" class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent" />
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-btncolor hover:bg-customIT text-white py-2 rounded-md text-sm font-medium transition duration-300 ease-in-out">Publish Announcement</button>
                </form>
            </div>

            <!-- Announcement List (Right) -->
            <div class="md:col-span-2">
                <!-- Filters & Search -->
                <div class="w-full flex flex-col sm:flex-row mb-4 gap-2 sm:items-center">
                    <!-- Dropdowns -->
                    <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                        <!-- Status -->
                        <select class="w-full sm:w-auto min-w-[150px] pl-3 pr-8 py-2 text-xs border rounded-md focus:ring-2 focus:ring-customIT focus:border-transparent">
                            <option>All Status</option>
                            <option>Published</option>
                            <option>Draft</option>
                            <option>Archived</option>
                        </select>

                        <!-- Audience -->
                        <select class="w-full sm:w-auto min-w-[150px] pl-3 pr-8 py-2 text-xs border rounded-md focus:ring-2 focus:ring-customIT focus:border-transparent">
                            <option>All Audience</option>
                            <option>Farmers</option>
                            <option>Staff</option>
                            <option>All members</option>
                        </select>
                    </div>

                    <!-- Search Box -->
                    <div class="flex w-full sm:w-full items-center shadow-md rounded overflow-hidden">
                        <input 
                            type="text" 
                            placeholder="Search here" 
                            class="flex-1 h-9 bg-white text-xs text-gray-700 px-3 focus:outline-none"
                        >
                        <button class="bg-btncolor text-white p-2 hover:bg-customIT transition duration-300 ease-in-out h-9 w-9 flex items-center justify-center">
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Example Pinned Announcement -->
                <div class="bg-green-50 border-l-4 border-green-500 rounded-md p-4 mb-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold text-green-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 17v5"/><path d="M9 10.76a2 2 0 0 1-1.11 1.79l-1.78.9A2 2 0 0 0 5 15.24V16a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-.76a2 2 0 0 0-1.11-1.79l-1.78-.9A2 2 0 0 1 15 10.76V7a1 1 0 0 1 1-1 2 2 0 0 0 0-4H8a2 2 0 0 0 0 4 1 1 0 0 1 1 1z"/></svg>
                            Pinned to Top: General Assembly Meeting
                        </h3>
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-gray-700 text-sm">Edit</button>
                            <button class="text-red-500 hover:text-red-700 text-sm">Unpin</button>
                        </div>
                    </div>
                    <p class="text-sm text-green-700 mt-1">
                        This is a reminder for the upcoming general assembly. Please check the content below for details.
                    </p>
                </div>

                <!-- Example Announcement Cards -->
                @foreach($announcements as $announcement)
                    <div class="space-y-4 my-2">
                        <div class="bg-white shadow-sm rounded-md p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center relative">
                            <div class="absolute top-4 right-4 text-xs font-semibold px-2 py-1 rounded-full bg-green-100 text-green-700">Published</div>
                            @if($announcement->image)
                                <img src="{{ asset('storage/'.$announcement->image) }}" alt="Announcement Image" class="w-40 h-30 object-cover">
                            @endif
                            <div>
                                <h3 class="font-semibold text-customIT">{{ $announcement->title}}</h3>
                                <p class="text-sm text-gray-600 mb-5">{{ $announcement->message}}</p>
                                <p class="text-sm text-gray-500 mt-1">Audience: <span class="font-medium text-gray-700">{{ $announcement->audience}}</span> | Visible: <span class="font-medium text-gray-700">{{ $announcement->posted_at->format('F d Y')}} - {{ $announcement->end_at->format('F d Y')}}</span></p>
                            </div>
                            <div class="flex gap-2 mt-5 sm:mt-10">
                                <button onclick="openModal('editAnnouncementModal-{{ $announcement->id }}')" class="bg-gray-100 text-gray-600 hover:bg-gray-200 p-2 rounded-md"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 00-1.41 0L18 8.34l3.75 3.75 1.29-1.29a1 1 0 000-1.41l-2.33-2.35z"/></svg></button>
                                <button onclick="openModal('deleteAnnouncementModal-{{ $announcement->id }}')" class="bg-gray-100 text-gray-600 hover:bg-gray-200 p-2 rounded-md"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19a2 2 0 002 2h8a2 2 0 002-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg></button>
                                <button class="bg-gray-100 text-gray-600 hover:bg-gray-200 p-2 rounded-md"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M5 20h14v-2H5v2zm7-18l-5.5 5.5h4v6h3v-6h4L12 2z"/></svg></button>
                            </div>
                            @include('components.modals.edit-announcement', ['announcement' => $announcement])
                            @include('components.modals.delete-announcement', ['announcement' => $announcement])
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> 
</div>
@endsection
