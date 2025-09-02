<div id="editGrantModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto z-20 h-full w-full flex items-center justify-center">
    <div class="relative w-1/2 max-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <h3 class="text-2xl font-bold text-customIT">Edit Grant/Equipment</h3>
            <div>
                <button onclick="closeModal('editGrantModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body: Activity Log Entries -->
        <div class="mt-4 overflow-y-auto mr-2" style="max-height: 70vh;">
            <!-- Log Group 1 -->
            <div class="grid grid-cols-3 gap-4 relative">
                <div class="col-span-1">
                    <div class="bg-gray-200 rounded-md h-52 flex items-center justify-center border-b border-gray-300">
                        <span class="text-white text-md">IMAGE</span>
                    </div>
                </div>
                <div class="col-start-2">
                    <p class="text-2xl font-medium text-customIT mb-2">Grant Name</p>
                    <p class="text-lg font-medium text-customIT mb-2">Basic Requirements</p>
                    <div class="flex justify-between">
                        <p class="text-sm font-light text-customIT mb-2">Requirement 1</p>
                        <button class="justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-sm font-light text-customIT mb-2">Requirement 1</p>
                        <button class="justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                    <div>
                        <input type="text" class="h-8 w-full text-sm text-gray-700 rounded-sm border-gray-700 mb-1" placeholder="add requirement">
                        <button class="flex text-sm font-light bg-btncolor text-white rounded-sm py-1 px-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Add
                        </button>
                    </div>
                </div>
                <div class="col-start-3">
                    <p class="text-lg font-medium text-customIT mt-10 mb-2">Additional Requirements</p>
                    <div class="flex justify-between">
                        <p class="text-sm font-light text-customIT mb-2">Requirement 1</p>
                        <button class="justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-sm font-light text-customIT mb-2">Requirement 1</p>
                        <button class="justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                    <div>
                        <input type="text" class="h-8 w-full text-gray-700 text-sm rounded-sm border-gray-700 mb-1" placeholder="add requirement">
                        <button class="flex text-sm font-light bg-btncolor text-white rounded-sm py-1 px-3 rounded-sm p-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Add
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 relative p-4">
                <h2 class="text-lg font-medium text-customIT">Item Summary</h2>
                <div class="col-start-1">
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-customIT ">ITEM ID</p>
                        <input class="text-sm h-9 font-extralight text-customIT p-1 rounded-sm" placeholder="112233445566">
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-customIT ">Type</p>
                        <select id="#" class="h-9 pl-3 w-[197px] text-sm text-gray-500 bg-white border rounded-[3px]">
                            <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Type</option>
                            <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Type</option>
                            <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Type</option>
                        </select>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-customIT ">Category</p>
                        <select id="#" class="h-9 pl-3 w-[197px] text-sm text-gray-500 bg-white border rounded-[3px]">
                            <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                            <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                            <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-customIT ">Last Updated</p>
                        <input class="text-sm h-9 font-extralight text-customIT p-1 rounded-sm" placeholder="Jan 25, 2025">
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-customIT ">Program Source</p>
                        <input class="text-sm h-9 font-extralight text-customIT p-1 rounded-sm" placeholder="CIF - Confidential Funds">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 relative p-4 ">
                <div class="col-start-1">
                    <h2 class="text-lg font-medium text-customIT my-4">Availability Period</h2>
                    <div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm font-medium text-customIT ">Start Date</p>
                            <input type="date" class="text-sm h-9 w-1/2 font-extralight text-customIT p-1 mr-4 rounded-sm" placeholder="July 25, 2025">
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm font-medium text-customIT ">End Date</p>
                            <input type="date" class="text-sm h-9 w-1/2 font-extralight text-customIT p-1 mr-4 rounded-sm" placeholder="July 25, 2025">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal footer -->
        <div class="text-right px-4 py-3">
            <button onclick="closeModal('editGrantModal')" class="w-1/3 px-4 py-2 bg-white text-btncolor rounded-md border border-btncolor hover:bg-btncolor hover:text-white">
                Cancel
            </button>
            <button class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
                Save Changes
            </button>
        </div>
    </div>
</div>