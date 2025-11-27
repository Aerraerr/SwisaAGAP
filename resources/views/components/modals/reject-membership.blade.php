<div x-show="showReasonModal"
     class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-30"
     x-transition>
    <div class="bg-white w-full h-[90%] max-auto p-6 rounded-xl shadow-lg">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-2xl font-bold text-rejected mb-2">Reject Application</h3>
            <button @click="showReasonModal = false" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form :action="`/member-application/${selectedUser.id}`" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <label class="block text-gray-700 font-medium">Select Reason for Rejection</label>
            <select name="rejection_reason" class="w-full border rounded-md p-2 mb-4 focus:ring-opacity-30 focus:ring-btncolor focus:border-btncolor">
                <option value="">-- Select Reason --</option>
                <option value="Incomplete Requirements">Incomplete Requirements</option>
                <option value="Invalid Documents">Invalid Documents</option>
                <option value="Failed Verification">Failed Verification</option>
                <option value="Other">Other</option>
            </select>

            <div class="text-right pt-3">
                <button type="submit" name="action" value="reject"
                        class="px-4 py-2 bg-rejected text-white rounded-md hover:bg-opacity-90">
                    Confirm Reject
                </button>
            </div>
        </form>
    </div>
</div>
