<div id="updateStatusModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-20 overflow-y-auto h-full w-full flex items-center justify-center">
    <div class="relative w-1/3 max-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <h3 class="text-2xl font-bold text-customIT">Update Status</h3>
            <div>
                <button onclick="closeModal('updateStatusModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body: Activity Log Entries -->
        <div class="space-y-4 mt-4">
            <!-- Updating text -->
            <p class="text-gray-700 text-sm">
                Updating the status for Item <span class="font-semibold text-customIT">PANGKAGKAG ID-123456789</span> reported by 
                <span class="font-semibold text-customIT">Ron Peter Mortega</span>
            </p>

            <!-- Current Status -->
            <div>
                <p class="font-medium text-sm text-gray-700">Current Status: 
                    <span class="font-semibold text-md text-customIT">To be review</span>
                </p>
            </div>

            <!-- Select new status -->
            <div>
                <p class="font-medium text-sm text-gray-700 mb-2">Select a new status:</p>
                <div class="flex justify-center gap-4">
                    <button class="px-6 py-2 rounded-md bg-approved text-white hover:bg-opacity-80">Good</button>
                    <button class="px-6 py-2 rounded-md bg-neutral text-white hover:bg-opacity-80">Fair</button>
                    <button class="px-6 py-2 rounded-md bg-pending text-white hover:bg-opacity-80">Poor</button>
                    <button class="px-6 py-2 rounded-md bg-rejected text-white hover:bg-opacity-80">Damaged</button>
                </div>
            </div>

            <!-- Staff Notes -->
            <div>
                <p class="font-medium text-sm text-gray-700 mb-2">Staff Notes (Optional)</p>
                <textarea class="w-full border rounded-md p-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-customIT" rows="5">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</textarea>
            </div>
        </div>

        <!-- modal footer -->
        <div class="text-right pt-6">
            <button onclick="closeModal('updateStatusModal')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
                Cancel
            </button>
            <button class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
                Delete
            </button>
        </div>
    </div>
</div>