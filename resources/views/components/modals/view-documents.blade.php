<div id="viewDocumentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50  z-20 overflow-y-auto h-full w-full flex items-center justify-center">
    <div class="relative w-1/3 max-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <h3 class="text-2xl font-bold text-customIT">View Attached Document</h3>
            <div>
                <button onclick="closeModal('viewDocumentModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body: Activity Log Entries -->
        <div class="mt-4 max-h-[80vh]">
            <!-- Log Group 1 -->
            <div class="flex justify-between">
                <div class="flex text-md">
                    <p class="font-medium text-gray-700 mr-4">Document Name:</p>
                    <p class="text-gray-500">Document Name</p>
                </div>
                <div class="flex bg-white px-4 border border-btncolor rounded-md">
                    <button class="text-xs text-btncolor">Download</button>
                </div>
            </div>
            <div class="flex mb-8">
                <p class="font-medium text-gray-700 mr-4">Date Submitted:</p>
                <p class="text-gray-500">25 August 2025</p>
            </div>
            <div class="">
                <p class="font-medium text-gray-700 mr-4">Document Image:</p>
                <div class="flex grid grid-cols-2 gap-2 justify-center">
                    <div class="col-start-1 px-4 py-6 h-auto bg-gray-200 rounded-md">
                        <p class="text-gray-500 p-24">Image</p>
                    </div>
                    <div class="col-start-2 px-4 py-6 h-auto bg-gray-200 rounded-md">
                        <p class="text-gray-500 p-24">Image</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal footer -->
        <div class="text-right pt-6">
            <button onclick="closeModal('viewDocumentModal')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
                Close
            </button>
        </div>
    </div>
</div>