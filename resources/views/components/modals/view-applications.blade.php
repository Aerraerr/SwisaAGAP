<div id="viewApplicationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
    <div class="relative mx-auto p-5 border w-3/7 shadow-lg rounded-md bg-white">
        <!-- Modal Header -->
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Name's All Application</h3>
            <button onclick="closeModal('viewApplicationModal')" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex justify-end my-3">
            <input type="text" placeholder="Search here" class="w-1/2 h-9 bg-white text-xs text-gray-700 px-4 border-1 border-gray-300 rounded-md focus:outline-none">
        </div>
        <!-- Modal Body -->
        <div class="overflow-y-auto" style="max-height: 60vh;">
            <table class="table table-hover min-w-full border-spacing-y-1">
                <thead class="bg-snbg border-gray-300">
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
                    <tr onclick="openModal('grantViewModal'); return false;" class="border border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                Pending
                            </div>
                        </td>
                    </tr>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                Pending
                            </div>
                        </td>
                    </tr>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-pending text-white text-center h-5 w-20 rounded-full">
                                Pending
                            </div>
                        </td>
                    </tr>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-approved text-white text-center h-5 w-20 rounded-full">
                                Approved
                            </div>
                        </td>
                    </tr>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-approved text-white text-center h-5 w-20 rounded-full">
                                Approved
                            </div>
                        </td>
                    </tr>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-approved text-white text-center h-5 w-20 rounded-full">
                                Approved
                            </div>
                        </td>
                    </tr>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-approved text-white text-center h-5 w-20 rounded-full">
                                Approved
                            </div>
                        </td>
                    </tr>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-approved text-white text-center h-5 w-20 rounded-full">
                                Approved
                            </div>
                        </td>
                    </tr>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-approved text-white text-center h-5 w-20 rounded-full">
                                Approved
                            </div>
                        </td>
                    </tr>
                    <tr onclick="openModal('grantViewModal'); return false;" class="border border-gray-300 hover:bg-gray-100">
                        <td class="px-4 py-3 text-xs text-gray-700">REQ-ITEM00001</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Aeron Jead Marquez</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Fertilizer</td>
                        <td class="px-4 py-3 text-xs text-gray-700">Machinery</td>
                        <td class="px-4 py-3 text-xs text-gray-700">15 August 2025</td>
                        <td class="px-4 py-3">
                            <div class="inline-block text-xs font-medium bg-approved text-white text-center h-5 w-20 rounded-full">
                                Approved
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        <!-- Modal Footer -->
        <div class="text-right px-4 py-3">
            <button onclick="closeModal('viewApplicationModal')" class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-opacity-80">
                Close
            </button>
        </div>
    </div>
</div>