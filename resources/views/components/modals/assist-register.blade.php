<div id="assistRegisterModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto z-20 h-full w-full flex items-center justify-center">
    <div class="relative w-1/2 max-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <div class="items-center">
                <h2 class="text-3xl font-bold text-custom-green">Create Account</h2>
                <p class="text-gray-500 mt-1">Assist a member to get started</p>
            </div>
            <div>
                <button onclick="closeModal('assistRegisterModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body: Activity Log Entries -->
        <div class="mt-4 m-8">

            <!-- Warning Note -->
            <div class="bg-gray-200 text-sm text-custom-dark-gray rounded-lg p-3 mb-6">
                note: Don't share your account credentials to anyone even the staff that is assisting you.
            </div>

            <!-- Form Fields -->
            <form action="#" class="space-y-4">
                <div>
                    <label for="name" class="block text-gray-700 font-medium">Name</label>
                    <input type="text" id="name" placeholder="Full Name" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="email" class="block text-gray-700 font-medium">Email Address or Phone Number</label>
                    <input type="email" id="email" placeholder="Full Name@email.com" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="relative">
                    <label for="password" class="block text-gray-700 font-medium">Password</label>
                    <input type="password" id="password" placeholder="********" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="absolute right-3 top-9 text-gray-400 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                </div>
                <div class="relative">
                    <label for="confirm-password" class="block text-gray-700 font-medium">Confirm Password</label>
                    <input type="password" id="confirm-password" placeholder="********" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="absolute right-3 top-9 text-gray-400 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </span>
                </div>

                <!-- Checkbox for Terms -->
                <div class="flex items-center space-x-2 pt-4">
                    <input type="checkbox" id="terms" class="peer h-5 w-5 appearance-none rounded-md border border-gray-300 bg-white transition-colors duration-200 checked:bg-custom-green checked:border-custom-green" />
                    <svg class="absolute h-5 w-5 text-white pointer-events-none opacity-0 transition-opacity duration-200 peer-checked:opacity-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <label for="terms" class="text-gray-700 select-none">I've read and agree with the <a href="#" class="text-custom-green font-medium">Terms and Conditions</a> and the <a href="#" class="text-custom-green font-medium">Privacy Policy</a>.</label>
                </div>
        </div>
        <!-- modal footer -->
        <div class="text-right px-4 py-3">
            <button onclick="closeModal('assistRegisterModal')" class="w-1/3 px-4 py-2 bg-white text-btncolor rounded-md border border-btncolor hover:bg-btncolor hover:text-white">
                Cancel
            </button>
            <button class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
                Approved
            </button>
        </div>
    </div>
</div>
