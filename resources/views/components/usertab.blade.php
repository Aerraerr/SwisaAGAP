<div class="flex justify-between items-center w-[28%] px-6 py-4 bg-white shadow-lg rounded-xl font-product relative">
    <!-- Live Clock Display -->
    <div class="text-gray-700 text-sm font-medium tracking-wide text-custom" id="live-time">
        <!-- Initial time loaded by PHP, but updated live by JS -->
        {{ \Carbon\Carbon::now()->format('F d, Y - h:i:s A') }}
    </div>

    <!-- User Dropdown -->
    <div class="relative" id="user-dropdown">
    <!-- Clickable User Icon + Settings -->
    <div class="flex items-center gap-4 cursor-pointer select-none" onclick="profiletoggleDropdown()">

        <!-- Profile Picture -->
        <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
             class="w-8 h-8 rounded-full shadow-md object-cover" />
    </div>

    <!-- Dropdown Menu -->
    <div id="dropdownMenu"
         class="hidden absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-md shadow-lg z-50">
        <div class="py-2 text-sm text-gray-700 space-y-1 px-2"> <!-- Apply horizontal padding here -->
            <a href="{{ route('profile.edit') }}" class="block w-full px-2 py-2 rounded hover:bg-gray-100">View Profile</a>
            <a href="#" class="block w-full px-2 py-2 rounded hover:bg-gray-100">Settings</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left px-2 py-2 rounded hover:bg-gray-100 text-red-500 flex items-center gap-2">
                    <span class="material-icons text-red-500">logout</span> Logout
                </button>
            </form>
        </div>
    </div>
</div>

</div>

<!-- Script Section -->
<script>
    function profiletoggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown if clicked outside
    window.addEventListener('click', function (e) {
        const dropdown = document.getElementById('dropdownMenu');
        const button = document.getElementById('user-dropdown');
        if (!button.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Live Time Update every second
    function updateLiveTime() {
        const now = new Date();
        const options = { month: 'long', day: '2-digit', year: 'numeric' };
        const formattedDate = now.toLocaleDateString('en-US', options);
        let hours = now.getHours();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12;
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        document.getElementById('live-time').textContent =
            `${formattedDate} - ${hours}:${minutes}:${seconds} ${ampm}`;
    }

    // Start updating the time
    setInterval(updateLiveTime, 1000);
</script>
