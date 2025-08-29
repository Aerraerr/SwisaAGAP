<div class="flex grid grid-cols-12 mb-4 gap-1">
            <div class="tab-buttons flex col-span-2 gap-1">
                <button 
                    x-show="activeTab === 'list'"
                    class=" active:bg-btncolor h-9 active:text-white active:shadow hover:bg-btncolor hover:text-white w-[80px] text-xs text-btncolor font-semibold rounded-[3px] p-1">
                    Export
                </button>

                <button 
                    @click="activeTab = 'grid'"
                    :class="activeTab === 'grid' ? 'bg-btncolor text-white shadow' : 'text-btncolor'" 
                    class="w-1/2 tab-button h-9 hover:bg-btncolor hover:text-white w-[80px] text-xs text-btncolor font-semibold rounded-[3px] p-1">
                    Grid
                </button>
                
                <button 
                @click="activeTab = 'list'"
                :class="activeTab === 'list' ? 'bg-btncolor text-white shadown' : 'text-btncolor'"
                class="w-1/2 tab-button h-9 hover:bg-btncolor hover:text-white w-[80px] text-xs text-btncolor font-semibold rounded-[3px] p-1" data-tab="list">List</button>
            </div>
            <button onclick="toggleModal('upload-modal')" class="col-start-5 col-span-1 bg-btncolor h-9 text-xs text-white border rounded-[3px] p-1">&#43; Add New</button>
            <div class="col-span-2 relative">
                <select id="#" class="h-9 pl-3 w-full text-xs text-white bg-btncolor border rounded-[3px]">
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
                <select id="#" class="h-9 pl-3 w-full text-xs text-white bg-btncolor border rounded-[3px]">
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
                <input type="text" placeholder="Search here" class="w-full h-9 bg-white text-xs text-gray-700 px-4 border-1.5 rounded-l-[3px] focus:outline-none">
                <button class="bg-btncolor text-white p-2 rounded-r-lg hover:bg-customIT transition duration-300 ease-in-out h-9 w-9">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                </svg>
                </button>
            </div>
</div>