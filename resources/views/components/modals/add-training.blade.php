<!-- Add Training Modal -->
<div id="addTrainingModal" 
     class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-20 h-full w-full flex items-center justify-center">
    <div class="relative w-full max-w-2xl mx-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <div class="items-center">
                <h2 class="text-3xl font-bold text-customIT text-center">Add Event</h2>
            </div>
            <div class="absolute right-6 top-6">
                <button onclick="closeModal('addTrainingModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body: Add Training -->
        <form id="addTrainingForm" action="{{ route('training.store')}}" method="POST" 
              enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="mt-4 m-8 space-y-2">
                <!-- Event Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Event Name</label>
                    <input type="text" name="event_name" 
                           class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" 
                           placeholder="Enter grant/equipment name" required>
                </div>

                <!-- Event Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Event Image</label>
                    <input type="file" name="event_image" accept="image/*"
                           class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                    <p class="text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG (Max 10MB)</p>
                </div>

                <!-- Sector -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sector</label>
                    <select name="sector" 
                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                        <option value="" disabled selected>Select type</option>
                        @foreach($sectors as $sector)
                            <option value="{{ $sector->id }}">{{ $sector->sector_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30"
                              placeholder="Enter description"></textarea>
                </div>

                <!-- Venue -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Venue</label>
                    <input type="text" name="venue" min="1" 
                           class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30"
                           placeholder="Enter venue" required>
                </div>

                <!-- Dates -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" 
                               class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Time</label>
                        <input type="time" name="time" 
                               class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="text-right px-4 py-3">
                <button type="button" onclick="closeModal('addTrainingModal')" 
                        class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
                    Cancel
                </button>
                <button type="button" onclick="nextToConfirm()" 
                        class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
                    Add
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmAddModal" 
     class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-[9999] h-full w-full flex items-center justify-center">
    <div class="w-full max-w-md p-6 bg-white rounded-xl shadow-lg">
        <h2 class="text-xl font-bold text-customIT text-center mb-4">Confirm Action</h2>
        <p class="text-gray-600 text-center">Are you sure you want to add this event?</p>
                
        <div class="flex justify-center gap-4 mt-6">
            <button onclick="cancelAdd()" 
                    class="w-1/3 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                Cancel
            </button>
            <button onclick="submitAddForm()" 
                    class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
                Yes, Add
            </button>
        </div>
    </div>
</div>
@include('pop-up.toast-message')



<script>
    function openModal(id) {
        document.getElementById(id).classList.remove("hidden");
    }
    function closeModal(id) {
        document.getElementById(id).classList.add("hidden");
    }

    // Close Add Modal then show Confirm Modal
    function nextToConfirm() {
        closeModal('addTrainingModal');
        setTimeout(() => {
            openModal('confirmAddModal');
        }, 200); // small delay for smooth transition
    }

    // Cancel button → show toast
    function cancelAdd() {
        closeModal('confirmAddModal');
        showToast("❌ Action canceled", "bg-red-500");
    }

    // Submit form after confirmation
    function submitAddForm() {
        closeModal('confirmAddModal');
        showToast("✅ Event successfully added!", "bg-green-500");

        setTimeout(() => {
            document.getElementById('addTrainingForm').submit();
        }, 1200); // short delay so user sees success animation
    
    }
</script>
