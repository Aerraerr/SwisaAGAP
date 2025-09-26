@props(['modalId' => null])

<div class="grid grid-cols-12 items-center mb-4 gap-2 ">
    <!-- TAB BUTTONS -->
    <div class="flex col-span-3 gap-1">
        <!-- Grid -->
        <button 
            @click="activeTab = 'grid'"
            :class="activeTab === 'grid' ? 'bg-btncolor text-white shadow' : 'text-btncolor'" 
            class="flex items-center justify-center gap-1 h-10 hover:bg-btncolor hover:text-white w-[80px] text-sm font-medium rounded-[4px] p-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                <path d="M3 3h4v4H3V3zm5 0h4v4H8V3zm5 0h4v4h-4V3zM3 8h4v4H3V8zm5 0h4v4H8V8zm5 0h4v4h-4V8zM3 13h4v4H3v-4zm5 0h4v4H8v-4zm5 0h4v4h-4v-4z"/>
            </svg>
            Grid
        </button>

        <!-- List -->
        <button 
            @click="activeTab = 'list'"
            :class="activeTab === 'list' ? 'bg-btncolor text-white shadow' : 'text-btncolor'" 
            class="flex items-center justify-center gap-1 h-10 hover:bg-btncolor hover:text-white w-[80px] text-sm font-medium rounded-[4px] p-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                <path d="M4 6h12v2H4V6zm0 4h12v2H4v-2zm0 4h12v2H4v-2z"/>
            </svg>
            List
        </button>

        <!-- Export -->
        <button 
            @click="exportData()" 
            class="flex items-center justify-center gap-1 h-10 bg-white text-btncolor hover:bg-btncolor hover:text-white w-[80px] text-sm font-medium rounded-[4px] p-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 10h4v7h6v-7h4l-7-7-7 7z"/>
            </svg>
            Export
        </button>
    </div>

    <!-- Add New + Sort + Category -->
    <div class="col-span-6 flex gap-2">
        <!-- Add New -->
        <button onclick="openModal('{{ $modalId }}')" 
            class="flex items-center justify-center gap-2 bg-btncolor hover:bg-btncolor/90 transition-colors h-10 px-4 text-sm font-medium text-white rounded-md shadow w-[200px]">
            <span class="flex items-center justify-center w-5 h-5 rounded-full bg-white text-btncolor">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </span>
            CREATE NEW
        </button>

        <!-- Sort -->
        <div class="relative flex-1">
            <select class="h-10 pl-9 w-full text-sm font-medium text-white bg-btncolor rounded-[4px] focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <option class="bg-white text-gray-800">Sort</option>
                <option class="bg-white text-gray-800">Sort A-Z</option>
                <option class="bg-white text-gray-800">Sort Z-A</option>
            </select>
            <div class="absolute inset-y-0 left-0 flex items-center pl-2 text-white pointer-events-none">
                <!-- Sort Icon -->
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M3 12h12m-9 8h9" />
                </svg>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center px-2 text-white pointer-events-none">
                <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.05 6.884 4.636 8.3L9.293 12.95z" />
                </svg>
            </div>
        </div>

        <!-- Category -->
        <div class="relative flex-1">
            <select class="h-10 pl-9 w-full text-sm font-medium text-white bg-btncolor rounded-[4px] focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <option class="bg-white text-gray-800">Category</option>
                <option class="bg-white text-gray-800">Category 1</option>
                <option class="bg-white text-gray-800">Category 2</option>
            </select>
            <div class="absolute inset-y-0 left-0 flex items-center pl-2 text-white pointer-events-none">
                <!-- Category Icon -->
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center px-2 text-white pointer-events-none">
                <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.05 6.884 4.636 8.3L9.293 12.95z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="col-span-3 flex items-center shadow rounded-lg">
        <input type="text" placeholder="Search here" class="w-full h-10 bg-white text-sm text-gray-700 px-4 border rounded-l-[4px] focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
        <button class="bg-btncolor text-white p-2 rounded-r-lg hover:bg-customIT transition duration-300 ease-in-out h-10 w-10 flex items-center justify-center">
            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
            </svg>
        </button>
    </div>
</div>
