<div id="addTrainingModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto z-20 h-full w-full flex items-center justify-center">
    <div class="relative w-full max-w-2xl mx-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <div class="items-center">
                <h2 class="text-3xl font-bold text-customIT">Add Event</h2>
            </div>
            <div>
                <button onclick="closeModal('addTrainingModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>


        <!-- Modal Body: Add Training -->
         <!-- Add Form Fields -->
        <form action="{{ route('training.store')}}" method="POST" 
            enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="mt-4 m-8 space-y-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Event Name</label>
                    <input type="text" name="event_name" 
                           class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" 
                           placeholder="Enter grant/equipment name" required>
                </div>

                <!-- Grant Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Event Image</label>
                    <input type="file" name="event_image" accept="image/*"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                    <p class="text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG (Max 10MB)</p>
                </div>

                <!-- Sector Type -->
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
                           placeholder="Enter quantity" required>
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

            <!-- modal footer -->
            <div class="text-right px-4 py-3">
                <button type="button" onclick="closeModal('addTrainingModal')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
                    Cancel
                </button>
                <button type="submit" class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
                    Add
                </button>
            </div>
        </form>
    </div>
</div>
