<div id="activityLogsModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-20 h-full w-full flex items-center justify-center">
    <div class="relative w-1/2 max-w-3xl max-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <h3 class="text-2xl font-bold text-customIT">Activity Logs</h3>
            <div>
                <button onclick="closeModal('activityLogsModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="text-right relative border-b border-gray-200 pb-4">
            <select id="#" class="h-9 pl-3 w-40 text-xs text-white bg-btncolor rounded-[3px]">
                <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Sort</option>
                <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Sort</option>
                <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Sort</option>
            </select>
            <div class="justify-between pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 pb-[14px] text-white">
                <svg class="fill-current h-6 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.05 6.884 4.636 8.3L9.293 12.95z" />
                </svg>
            </div>
        </div>

        <!-- Modal Body: Activity Log Entries -->
        <div class="mt-4 max-h-[80vh] overflow-auto ">
            <!-- Log Group 1 -->
            <div class="mb-4">
                <p class="text-sm font-bold text-gray-500 mb-2">July 12, 2023</p>
                <div class="space-y-2">
                    <!-- Log Entry 1 -->
                    <div class="flex items-center mx-1 p-3 rounded-sm border border-customIT">
                        <input type="checkbox" class="h-4 w-4 text-customIT rounded-sm border-customIT mr-4">
                        <div class="flex-grow">
                            <span class="text-sm text-gray-500 font-medium mr-2">3:05 PM</span>
                            <span class="text-sm text-customIT font-medium">Submitted Request</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            <span class="font-medium">Module:</span> Request
                        </div>
                    </div>
                    <!-- Log Entry 2 -->
                    <div class="flex items-center mx-1 p-3 rounded-sm border border-customIT">
                        <input type="checkbox" class="h-4 w-4 text-customIT rounded-sm border-customIT mr-4">
                        <div class="flex-grow">
                            <span class="text-sm text-gray-500 font-medium mr-2">3:05 PM</span>
                            <span class="text-sm text-customIT font-medium">Changed Password</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            <span class="font-medium">Module:</span> Security Settings
                        </div>
                    </div>
                    <!-- Log Entry 3 -->
                    <div class="flex items-center mx-1 p-3 rounded-sm border border-customIT">
                        <input type="checkbox" class="h-4 w-4 text-customIT rounded-sm border-customIT mr-4">
                        <div class="flex-grow">
                            <span class="text-sm text-gray-500 font-medium mr-2">3:05 PM</span>
                            <span class="text-sm text-customIT font-medium">Logged In</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            <span class="font-medium">Module:</span> Authentication
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Log Group 2 -->
            <div class="mb-4">
                <p class="text-sm font-bold text-gray-500 mb-2">April 12, 2023</p>
                <div class="space-y-2">
                    <div class="flex items-center mx-1 p-3 rounded-sm border border-customIT">
                        <input type="checkbox" class="h-4 w-4 text-customIT rounded-sm border-customIT mr-4">
                        <div class="flex-grow">
                            <span class="text-sm text-gray-500 font-medium mr-2">3:05 PM</span>
                            <span class="text-sm text-customIT font-medium">Submitted Request</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            <span class="font-medium">Module:</span> Request
                        </div>
                    </div>
                    <div class="flex items-center mx-1 p-3 rounded-sm border border-customIT">
                        <input type="checkbox" class="h-4 w-4 text-customIT rounded-sm border-customIT mr-4">
                        <div class="flex-grow">
                            <span class="text-sm text-gray-500 font-medium mr-2">3:05 PM</span>
                            <span class="text-sm text-customIT font-medium">Changed Password</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            <span class="font-medium">Module:</span> Security Settings
                        </div>
                    </div>
                </div>
            </div>

            <!-- Log Group 3 -->
            <div>
                <p class="text-sm font-bold text-gray-500 mb-2">January 12, 2023</p>
                <div class="space-y-2">
                    <div class="flex items-center mx-1 p-3 rounded-sm border border-customIT">
                        <input type="checkbox" class="h-4 w-4 text-customIT rounded-sm border-customIT mr-4">
                        <div class="flex-grow">
                            <span class="text-sm text-gray-500 font-medium mr-2">3:05 PM</span>
                            <span class="text-sm text-customIT font-medium">Submitted Request</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            <span class="font-medium">Module:</span> Request
                        </div>
                    </div>
                    <div class="flex items-center mx-1 p-3 rounded-sm border border-customIT">
                        <input type="checkbox" class="h-4 w-4 text-customIT rounded-sm border-customIT mr-4">
                        <div class="flex-grow">
                            <span class="text-sm text-gray-500 font-medium mr-2">3:05 PM</span>
                            <span class="text-sm text-customIT font-medium">Changed Password</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            <span class="font-medium">Module:</span> Security Settings
                        </div>
                    </div>
                    <div class="flex items-center mx-1 p-3 rounded-sm border border-customIT">
                        <input type="checkbox" class="h-4 w-4 text-customIT rounded-sm border-customIT mr-4">
                        <div class="flex-grow">
                            <span class="text-sm text-gray-500 font-medium mr-2">3:05 PM</span>
                            <span class="text-sm text-customIT font-medium">Logged In</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            <span class="font-medium">Module:</span> Authentication
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal footer -->
        <div class="text-right px-4 py-3">
            <button onclick="closeModal('activityLogsModal')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
                Close
            </button>
        </div>
    </div>
</div>