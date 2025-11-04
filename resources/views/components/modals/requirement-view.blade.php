<div id="requirementModal"  x-show="selectedRequirement"  x-cloak class=" fixed inset-0 bg-gray-600 bg-opacity-50  z-20 overflow-y-auto h-full w-full flex items-center justify-center">
    <div x-data="{ verified: false }" class="relative w-auto max-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <h3 class="text-xl font-bold text-customIT" x-text="`View Requirement: ${selectedRequirement?.name || ''}`"></h3>
        </div>

        <!-- Modal Body -->
        <div class="grid grid-cols-2 mt-4 space-y-4 max-h-[85vh]">
            <!--info -->
            <div class="col-start-1 py-4 items-center">
                <p class="text-xs text-gray-500">Uploaded by:</p>
                <div class="flex my-2">
                    <img src="{{ asset('images/profile-user.png') }}" alt="profile" class="w-10 h-10 rounded-full">
                    <div class="ml-2">
                        <p class="text-md text-center font-semibold text-customIT" x-text="selectedUser.name"></p>
                    </div>
                </div>
            </div>
            <template x-if="selectedRequirement?.document">
                <div class="col-span-2">
                    <p class="text-sm text-gray-600 mb-2 font-medium">Uploaded File:</p>
                    <template x-if="selectedRequirement.document.file_name.toLowerCase().endsWith('.pdf')">
                        <iframe 
                            :src="`/storage/${selectedRequirement.document.file_path}`" 
                            class="w-full h-[500px] border rounded-md">
                        </iframe>
                    </template>

                    <template x-if="!selectedRequirement.document.file_name.toLowerCase().endsWith('.pdf')">
                        <img 
                            :src="`/storage/${selectedRequirement.document.file_path}`" 
                            alt="Document Image"
                            class="w-full h-[500px] rounded-md">
                    </template>

                    <!-- Optional Download -->
                    <a 
                        :href="`/storage/${selectedRequirement.document.file_path}`" 
                        download 
                        class="inline-block mt-3 text-sm text-blue-600 hover:underline">
                        Download File
                    </a>
                </div>
            </template>

            <template x-if="!selectedRequirement?.document">
                <div class="col-span-2 text-gray-500 italic text-sm">No document uploaded for this requirement.</div>
            </template>
        </div>
        <!-- modal footer -->
        <div class="text-right pt-6">
            <button @click="selectedRequirement = null" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
                Cancel
            </button>
        </div>
    </div>
</div>

