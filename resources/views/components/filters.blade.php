<div class="flex grid grid-cols-12 mb-4 gap-1">
            <div class="tab-buttons flex col-span-2 gap-1">
                <button 
                    x-show="activeTab === 'list'"
                    class=" active:bg-btncolor h-9 active:text-white active:shadow hover:bg-btncolor hover:text-white w-[80px] text-xs text-btncolor font-semibold rounded-[4px] p-1">
                    Export
                </button>

                <button 
                    @click="activeTab = 'grid'"
                    :class="activeTab === 'grid' ? 'bg-btncolor text-white shadow' : 'text-btncolor'" 
                    class="flex items-center justify-center gap-1 w-1/2 tab-button h-9 hover:bg-btncolor hover:text-white w-[80px] text-xs text-btncolor font-medium rounded-[4px] p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                        <path d="M3 3h4v4H3V3zm5 0h4v4H8V3zm5 0h4v4h-4V3zM3 8h4v4H3V8zm5 0h4v4H8V8zm5 0h4v4h-4V8zM3 13h4v4H3v-4zm5 0h4v4H8v-4zm5 0h4v4h-4v-4z"/>
                    </svg>
                    Grid
                </button>
                
                <button 
                @click="activeTab = 'list'"
                :class="activeTab === 'list' ? 'bg-btncolor text-white shadown' : 'text-btncolor'"
                class="flex items-center justify-center gap-1 w-1/2 tab-button h-9 hover:bg-btncolor hover:text-white w-[80px] text-xs text-btncolor font-medium rounded-[4px] p-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                    <path d="M4 6h12v2H4V6zm0 4h12v2H4v-2zm0 4h12v2H4v-2z"/>
                </svg>
                List
                </button>
            </div>
            <!-- ADD NEW BUTTON-->
            <button onclick="toggleModal('upload-modal')" 
                class="col-start-5 col-span-1 flex items-center justify-center gap-2 bg-btncolor hover:bg-btncolor/90 transition-colors h-9 px-4 text-xs font-medium text-white rounded-md shadow">
                <!-- Circle + Icon -->
                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-white text-btncolor">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </span>

                Add New
            </button>


            <div class="col-span-2 relative">
                <select id="#" class="h-9 pl-3 w-full text-xs text-white bg-btncolor rounded-[4px] focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Sort</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Sort</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Sort</option>
                </select>
                <div class=" justify-between pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                    <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.05 6.884 4.636 8.3L9.293 12.95z" />
                    </svg>
                </div>
            </div>
            <div class="col-span-2 relative">
                <select id="#" class="h-9 pl-3 w-full text-xs text-white bg-btncolor rounded-[4px] focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.05 6.884 4.636 8.3L9.293 12.95z" />
                </svg>
                </div>
            </div>
            <div class="col-span-3 flex items-center shadow-lg rounded-lg">
                <input type="text" placeholder="Search here" class="w-full h-9 bg-white text-xs text-gray-700 px-4 border-1.5 rounded-l-[4px] focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <button class="bg-btncolor text-white p-2 rounded-r-lg hover:bg-customIT transition duration-300 ease-in-out h-9 w-9">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                </svg>
                </button>
            </div>
</div>



