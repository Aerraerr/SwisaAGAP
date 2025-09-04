<div id="requirementModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50  z-20 overflow-y-auto h-full w-full flex items-center justify-center">
    <div x-data="{ verified: false }" class="relative w-auto max-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <h3 class="text-xl font-bold text-customIT">View Requirement</h3>
            <div>
                <div class="inline-block text-xs font-medium bg-pending text-white text-center px-3 py-1 rounded-full">
                    Pending
                </div>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="grid grid-cols-2 mt-4 space-y-4">
            <!--info -->
            <div class="col-start-1 py-4 items-center">
                <p class="text-xs text-gray-500">Requested by:</p>
                <div class="flex my-2">
                    <img src="{{ asset('images/profile-user.png') }}" alt="profile" class="w-10 h-10 rounded-full">
                    <div class="ml-2">
                        <p class="text-md font-semibold text-customIT">Ron Peter Mortega</p>
                        <p class="text-xs text-gray-500">Registered Member</p>
                    </div>
                </div>
            </div>
            <div class="col-start-2 items-center">
                <p class="text-xs text-gray-500">Item Info</p>
                <p class="text-sm font-semibold text-bsctxt">Item Requested: <span  class="font-medium ml-2">Organic Fertilizer</span></p>
                <p class="text-sm font-semibold text-bsctxt">Request ID: <span class="font-medium ml-2">REQ-ITEM0000001</span></p>
                <p class="text-sm font-semibold text-bsctxt">Date Submitted: <span class="font-medium ml-2">15 Aug 2025</span></p>
            </div>
            
            <div class="col-start-1">
                <!-- <p class="font-bold text-xl text-bsctxt">Requirement Approval</p> -->
                <p class="font-semibold text-lg text-bsctxt">Basic Requirement: <span class="text-customIT ml-2">Valid ID</span></p>
                <p class="text-md font-medium text-bsctxt ml-4">2 attachments:</p>
                <p class="text-sm text-bsctxt ml-8">National ID</p>
                <p class="text-sm text-bsctxt ml-8">Other Valid ID</p>
            </div>
            <!-- attached document -->
            <div class="col-span-2">
                <div class="flex grid grid-cols-2 gap-2 justify-center">
                    <div class="col-start-1 px-8 py-6 h-auto bg-gray-200 rounded-md">
                        <p class="text-gray-500 p-24">Image</p>
                    </div>
                    <div class="col-start-2 px-4 py-6 h-auto bg-gray-200 rounded-md">
                        <p class="text-gray-500 p-24">Image</p>
                    </div>
                </div>
            </div>
            <div class="col-span-2 flex items-center">
                <input type="checkbox"  x-model="verified" class="peer h-5 w-5 appearance-none rounded-md border border-gray-300 bg-white transition-colors duration-200 checked:bg-btncolor focus:ring-btncolor checked:border-btncolor">
                <p class="text-sm text-bsctxt ml-2">This requirement have been reviewed and verified.</p>
            </div>
        </div>
        <!-- modal footer -->
        <div class="text-right pt-6">
            <button onclick="closeModal('requirementModal')" class="w-1/3 px-4 py-2 bg-white border border-btncolor text-btncolor rounded-md hover:bg-btncolor hover:text-white">
                Cancel
            </button>
            <button class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md"
                 :class="verified ? 'bg-opacity-100 hover:bg-opacity-80' : 'bg-opacity-50'"
                :disabled="!verified">
                Approved
            </button>
        </div>
    </div>
</div>