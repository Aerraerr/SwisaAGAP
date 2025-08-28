<div id="editGrantModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto z-50 h-full w-full flex items-center justify-center">
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
            <div class="grid grid-cols-2 gap-4 relative">
                <div class="col-span-1">
                    <div class="bg-gray-200 rounded-md h-44 flex items-center justify-center border-b border-gray-300">
                        <span class="text-white text-md">IMAGE</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-medium text-customIT mb-2">Grant Name</p>
                    <p class="text-lg font-medium text-customIT mb-2">Requirements</p>
                    <div class="flex">
                        <input type="checkbox" class="h-4 w-4 text-customIT rounded-sm border-customIT mr-4">
                        <p class="text-sm font-light text-customIT mb-2">Basic Requirements</p>
                    </div>
                    <div class="flex">
                        <input type="checkbox" class="h-4 w-4 text-customIT rounded-sm border-customIT mr-4">
                        <p class="text-sm font-light text-customIT mb-2">Additional Requirements</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 relative p-4">
                <h2 class="text-lg font-medium text-customIT my-4">Item Summary</h2>
                <div class="col-start-1">
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-customIT ">ITEM ID</p>
                        <input class="text-sm font-extralight text-customIT p-1 rounded-sm" placeholder="112233445566">
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-customIT ">Type</p>
                        <input class="text-sm font-extralight text-customIT p-1 rounded-sm" placeholder="Type">
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-customIT ">Category</p>
                        <input class="text-sm font-extralight text-customIT p-1 rounded-sm" placeholder="Category">
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-customIT ">Last Updated</p>
                        <input class="text-sm font-extralight text-customIT p-1 rounded-sm" placeholder="Jan 25, 2025">
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-customIT ">Program Source</p>
                        <input class="text-sm font-extralight text-customIT p-1 rounded-sm" placeholder="CIF - Confidential Funds">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 relative p-4">
                <div class="col-start-1">
                    <h2 class="text-lg font-medium text-customIT my-4">Availability Period</h2>
                    <div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm font-medium text-customIT ">Start Date</p>
                            <input class="text-sm font-extralight text-customIT p-1 rounded-sm" placeholder="July 25, 2025">
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm font-medium text-customIT ">End Date</p>
                            <input class="text-sm font-extralight text-customIT p-1 rounded-sm" placeholder="July 25, 2025">
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