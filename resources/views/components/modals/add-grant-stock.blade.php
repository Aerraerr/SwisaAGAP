<div id="addStockModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto z-20 h-full w-full flex items-center justify-center">
    <div class="relative w-full max-w-2xl mx-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <h3 class="text-2xl font-bold text-customIT">Add New Stock</h3>
            <div>
                <button onclick="closeModal('addStockModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

    <form action="{{ route('addGrantStock.update', $grant->id)}}" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')
        <!-- Modal Body: Activity Log Entries -->
        <div class="mt-4 overflow-y-auto mr-2 max-h-[80vh]">
            <!-- Log Group 1 -->
            <div class="px-4">
                <div class="bg-gray-200 rounded-md h-64 w-full flex items-center justify-center border-b border-gray-300">
                    <img 
                                src= "{{ $grant->documents->first() ? asset('storage/' . $grant->documents->first()->file_path) : asset('image/placeholder.png') }} "
                                alt="Grant Image" 
                                class="object-cover w-full h-full"
                            >
                </div>
                <h2 class="text-2xl font-bold text-customIT my-4">{{ $grant->title}}</h2>
                <div class="flex text-gray-700">
                        {{--<div class="bg-customIT rounded-full h-5 w-5 mr-2"></div>--}}
                        <p class="text-md font-medium mr-2">Current Stock:</p>
                        <p class="text-md">{{ $grant->total_quantity}} unit/s</p>
                </div>
            </div>

            <div class="p-4">
                <div >
                    <h2 class="text-lg font-medium text-customIT mt-4">Stock Quantity to Add</h2>
                    <div class="flex justify-between text-gray-700 gap-2">
                        <!-- Checkbox 1 -->
                        <div class="flex-1">
                            <input type="checkbox" name="options[]" id="option1" class="peer hidden" value="5">
                            <label for="option1" class="block w-full border border-btncolor py-3 rounded-lg text-md shadow-lg 
                                flex items-center justify-center cursor-pointer select-none peer-checked:bg-btncolor peer-checked:text-white transition duration-300">
                                +5
                            </label>
                        </div>

                        <!-- Checkbox 2 -->
                        <div class="flex-1">
                             <input type="checkbox" name="options[]" id="option2" class="peer hidden" value="10">
                            <label for="option2" class="block w-full border border-btncolor py-3 rounded-lg text-md shadow-lg 
                                flex items-center justify-center cursor-pointer select-none peer-checked:bg-btncolor peer-checked:text-white transition duration-300">
                                +10
                            </label>
                        </div>

                        <!-- Checkbox 3 -->
                        <div class="flex-1">
                            <input type="checkbox" name="options[]" id="option3" class="peer hidden" value="20">
                            <label for="option3" class="block w-full border border-btncolor py-3 rounded-lg text-md shadow-lg 
                                flex items-center justify-center cursor-pointer select-none peer-checked:bg-btncolor peer-checked:text-white transition duration-300">
                                +20
                            </label>
                        </div>
                    </div>
                    <h2 class="text-lg font-medium text-customIT mt-4">Enter Custom Amount</h2>
                    <input type="number" name="options[]" class="text-md w-full font-medium py-3 text-center rounded-lg p-2 border border-btncolor" placeholder="0">
                </div>
            </div>
        </div>
            <!-- modal footer -->
            <div class="text-right px-4 py-3">
                <button type="button" onclick="closeModal('addStockModal')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
                    Cancel
                </button>
                <button type="submit" class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
                    Add Stock
                </button>
            </div>
        </form>
    </div>
</div>