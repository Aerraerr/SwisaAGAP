<div id="{{ $modalId ?? 'checkedModal' }}" x-data="{ showReasonModal: false }" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto z-20 h-full w-full flex items-center justify-center">
    <div class="relative w-1/3 max-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <div class="flex items-center">
                <img src="{{ asset('images/caution.svg') }}" alt="Profile"
                class="w- h-16 rounded-full object-cover" />
                <h3 class="text-2xl font-bold text-customIT">Verify Requirements</h3>
            </div>
            <div>
                <button onclick="closeModal('{{$modalId}}')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body: Activity Log Entries -->
        <div class="mt-4 m-8">
            <div class="items-center">
                <p class="text-lg text-gray-700">Are you sure you want to mark this application of <span class="font-semibold text-customIT" x-text="selectedUser.name"></span> as checked?</p>
                <p class="text-sm text-gray-600 mt-2">This will indicate that the requirements have been reviewed.</p>
            </div>
        </div>
        <!-- modal footer -->
        <form :action="`/grant-application/${selectedUser.id}/checked`" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')
            <div class="text-right px-4 py-3">
                <button type="button" class="w-1/3 px-4 py-2 bg-white text-rejected rounded-md border border-rejected hover:bg-rejected hover:text-white">
                    Cancel
                </button>
                
                <button type="submit" name="action" class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
                    Checked
                </button>
            </div>
        </form>
    </div>
</div>