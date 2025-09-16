<div id="viewApplicationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-20 overflow-y-auto h-full w-full flex items-center justify-center">
    <div class="relative w-auto max-w-4xl mx-auto p-6 border w-3/7 shadow-lg rounded-md bg-white">
        <!-- Modal Header -->
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-customIT">Name's All Application</h3>
            <button onclick="closeModal('viewApplicationModal')" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex justify-end my-2">
            <input type="text" placeholder="Search here" class="w-1/2 h-9 bg-white text-xs text-gray-700 px-4 border-1 border-btncolor rounded-l-[4px] focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
            <button class="bg-btncolor text-white p-2 rounded-r-lg hover:bg-customIT transition duration-300 ease-in-out h-9 w-9">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                </svg>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="overflow-y-auto max-h-[80vh]">
            <table class="table table-hover min-w-full border-spacing-y-1">
                <thead class="bg-snbg border-gray-300 sticky top-0 z-10">
                    <tr class="text-customIT text-left text-xs font-semibold ">
                        <th class="px-4 py-3 rounded-tl-md">REQUEST ID</th>
                        <th class="px-4 py-3">MEMBER</th>
                        <th class="px-4 py-3">REQUESTED ITEM</th>
                        <th class="px-4 py-3">ITEM TYPE</th>
                        <th class="px-4 py-3">Date Submitted</th>
                        <th class="px-4 py-3 rounded-tr-md">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border-y border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-pending text-white text-center px-3 py-1 rounded-full">
                                Pending
                            </div>
                        </td>
                    </tr>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border-y border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-pending text-white text-center px-3 py-1 rounded-full">
                                Pending
                            </div>
                        </td>
                    </tr>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border-y border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-pending text-white text-center px-3 py-1 rounded-full">
                                Pending
                            </div>
                        </td>
                    </tr>
                    @for($i = 0; $i < 8; $i++)
                        <tr onclick="openModal('grantViewModal'); return false;" class="border-y border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                            <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                            <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                            <td class="px-4 py-3 ">
                                <div class="inline-block text-xs font-medium bg-approved text-white text-center px-3 py-1 rounded-full">
                                    Approved
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <!-- Modal Footer -->
        <div class="text-right px-4 py-3">
            <button onclick="closeModal('viewApplicationModal')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
                Close
            </button>
        </div>
    </div>
</div>