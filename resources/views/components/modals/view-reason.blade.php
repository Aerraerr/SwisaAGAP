<div id="viewReasonModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-20 overflow-y-auto h-full w-full flex items-center justify-center">
    <div class="relative w-1/3 max-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <h3 class="text-2xl font-bold text-customIT">View Reason</h3>
            <div>
                <button onclick="closeModal('viewReasonModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body: Activity Log Entries -->
        <div class="mt-4 max-h-auto">
            <!-- Log Group 1 -->
            <div class="mb-4">
                <div class="flex text-md">
                    <p class="font-medium text-gray-700 mr-4">Requested Item:</p>
                    <p class="text-gray-500">Item Name</p>
                </div>
                <div class="flex">
                    <p class="font-medium text-gray-700 mr-4">Item Type:</p>
                    <p class=" text-gray-500">Item Type</p>
                </div>
                <div class="flex">
                    <p class="font-medium text-gray-700 mr-4">Date Submitted:</p>
                    <p class="text-gray-500">25 August 2025</p>
                </div>
            </div>
            <div>
                <p class="font-medium text-gray-700 mr-4">Reason for Requesting:</p>
                <div class="px-4 py-6 border border-gray-600 rounded-md">
                    <p class="text-gray-500">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                </div>
            </div>
        </div>
        <!-- modal footer -->
        <div class="text-right pt-6">
            <button onclick="closeModal('viewReasonModal')" class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-opacity-80">
                Close
            </button>
        </div>
    </div>
</div>