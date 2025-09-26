<!-- User Management -->
<div id="users-section" class="settings-section hidden">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold text-[#2C6E49]">User Management</h3>
        <div class="flex items-center space-x-2 cursor-pointer hover:text-[#2C6E49] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="text-gray-800 font-medium">Add Profile</span>
        </div>
    </div>

    <!-- Logged In User -->
    <p class="text-sm font-medium text-gray-600 mb-2">Logged In as</p>
    <div class="bg-white p-6 rounded-lg shadow-md mb-10 flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 border-2 border-gray-300">
        <img src="{{ asset('images/profile-user.png') }}" alt="Profile" class="w-24 h-24 rounded-full border border-gray-400">
        <div class="flex-grow text-center md:text-left">
            <h2 class="text-xl font-semibold text-gray-800">Super Admin</h2>
            <p class="text-gray-600">marquezjaronjead@gmail.com</p>
            <div class="flex items-center justify-center md:justify-start space-x-2 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-green-600 font-medium">Sync is on</span>
            </div>
        </div>
        <div class="flex items-center space-x-2 mt-4 md:mt-0">
            <button class="p-2 border rounded-full hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>
            <button class="p-2 border rounded-full hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100 transition">Sign out</button>
        </div>
    </div>

    <!-- Other Accounts -->
    <p class="text-sm font-medium text-gray-600 mb-3">Other Swisa Accounts</p>

    <!-- Admin Example -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 border-2 border-gray-300">
        <img src="{{ asset('images/profile-user.png') }}" alt="Profile" class="w-20 h-20 rounded-full border border-gray-400">
        <div class="flex-grow text-center md:text-left">
            <h2 class="text-lg font-semibold text-gray-800">Admin</h2>
            <p class="text-gray-600">example@gmail.com</p>
        </div>
        <div class="flex items-center space-x-2 mt-4 md:mt-0">
            <button class="p-2 border rounded-full hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>
            <button class="p-2 border rounded-full hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Support Staff Example -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 border-2 border-gray-300">
        <img src="{{ asset('images/profile-user.png') }}" alt="Profile" class="w-20 h-20 rounded-full border border-gray-400">
        <div class="flex-grow text-center md:text-left">
            <h2 class="text-lg font-semibold text-gray-800">Support Staff</h2>
            <p class="text-gray-600">example@gmail.com</p>
        </div>
        <div class="flex items-center space-x-2 mt-4 md:mt-0">
            <button class="p-2 border rounded-full hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>
            <button class="p-2 border rounded-full hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </div>
    </div>
</div>
