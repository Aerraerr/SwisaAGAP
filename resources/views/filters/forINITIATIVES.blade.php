<div class="flex grid grid-cols-12 mb-5 mt-5 gap-1">
    <!-- Grid Button -->
    <button 
        class="mr-0 col-span-1 flex items-center justify-center gap-1 h-9 w-[100px] text-xs font-semibold rounded-[3px] p-1 transition"
        :class="view === 'grid' ? 'bg-btncolor text-white shadow' : 'bg-transparent text-btncolor  hover:bg-btncolor hover:text-white'"
        @click="view = 'grid'">
        <!-- Grid Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20">
            <path d="M3 3h4v4H3V3zm5 0h4v4H8V3zm5 0h4v4h-4V3zM3 8h4v4H3V8zm5 0h4v4H8V8zm5 0h4v4h-4V8zM3 13h4v4H3v-4zm5 0h4v4H8v-4zm5 0h4v4h-4v-4z"/>
        </svg>
        Grid
    </button>

    <!-- List Button -->
    <button 
        class="-ml-7 col-span-1 flex items-center justify-center gap-1 h-9 w-[100px] text-xs font-semibold rounded-[3px] p-1 transition"
        :class="view === 'list' ? 'bg-btncolor text-white shadow' : 'bg-transparent text-btncolor  hover:bg-btncolor hover:text-white'"
        @click="view = 'list'">
        <!-- List Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20">
            <path d="M4 6h12v2H4V6zm0 4h12v2H4v-2zm0 4h12v2H4v-2z"/>
        </svg>
        List
    </button>

    <!-- Add New Button -->
    <button onclick="toggleModal('upload-modal')" 
        class="col-start-5 col-span-1 flex items-center justify-center gap-1 bg-btncolor h-9 text-xs text-white border rounded-[3px] p-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20">
            <path d="M10 5v10m5-5H5" />
        </svg>
        Add New
    </button>

    <!-- Sort Dropdown -->
    <div class="col-span-2 relative">
        <select class="h-9 pl-3 w-full text-xs text-white bg-btncolor border rounded-[3px]">
            <option class="bg-white text-gray-800" value="">Sort</option>
            <option class="bg-white text-gray-800" value="latest">Latest</option>
            <option class="bg-white text-gray-800" value="oldest">Oldest</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.05 6.884 4.636 8.3 9.293 12.95z" />
            </svg>
        </div>
    </div>

    <!-- Category Dropdown -->
    <div class="col-span-2 relative">
        <select class="h-9 pl-3 w-full text-xs text-white bg-btncolor border rounded-[3px]">
            <option class="bg-white text-gray-800" value="">Category</option>
            <option class="bg-white text-gray-800" value="workshop">Workshop</option>
            <option class="bg-white text-gray-800" value="event">Event</option>
            <option class="bg-white text-gray-800" value="initiative">Initiative</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.05 6.884 4.636 8.3 9.293 12.95z" />
            </svg>
        </div>
    </div>

    <!-- Search Box -->
    <div class="col-span-3 flex items-center shadow-lg rounded-lg">
        <input type="text" placeholder="Search here" 
            class="w-full h-9 bg-white text-xs text-gray-700 px-4 border rounded-l-[3px] focus:outline-none">
        <button class="bg-btncolor text-white p-2 rounded-r-lg hover:bg-customIT transition duration-300 ease-in-out h-9 w-9">
            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
            </svg>
        </button>
    </div>
</div>
