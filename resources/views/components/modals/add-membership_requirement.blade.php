<div id="addMemReqModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-20 h-full w-full flex items-center justify-center">
    <div class="relative w-full max-w-2xl mx-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <div class="items-center">
                <h2 class="text-3xl font-bold text-customIT">Add Membership Requirement</h2>
            </div>
            <div>
                <button onclick="closeModal('addMemReqModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <form action="{{ route('admin.membership_requirement.store')}}" method="POST" 
            enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="max-h-[70vh] overflow-y-auto pr-4">
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Select Requirement</label>
                    <select name="requirement_id" required class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:ring-accent-green focus:border-accent-green">
                        <option value="" disabled selected>-- Select a Requirement --</option>
                        @foreach($requirements as $req)
                            <option value="{{ $req->id }}">{{ $req->requirement_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- modal footer -->
            <div class="text-right px-4 py-3">
                <button type="button" onclick="closeModal('addMemReqModal')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
                    Cancel
                </button>
                <button type="submit" class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
                    Add
                </button>
            </div>
        </form>
    </div>
</div>
