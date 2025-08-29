<div class="flex justify-between items-center w-[28%] px-6 py-4 bg-white shadow-lg rounded-xl font-poppins relative"
     id="user-widget">
    
    <!-- Live Clock Display -->
    <div class="text-[#2C6E49] text-sm font-bold tracking-wide text-custom" id="user-live-time">
        {{ \Carbon\Carbon::now()->format('F d, Y - h:i:s A') }}
    </div>

    <!-- User Dropdown -->
    <div class="relative">
        <div class="flex items-center gap-4 cursor-pointer select-none" id="user-toggle">
            <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                 class="w-8 h-8 rounded-full shadow-md object-cover" />
        </div>

        <!-- Dropdown Menu -->
        <div class="hidden absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-md shadow-lg z-50"
             id="user-dropdown-menu">
            <div class="py-2 text-sm text-gray-700 space-y-1 px-2">
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

<!-- Scoped Script -->
<script>
(function () {
    const widget = document.getElementById('user-widget');
    if (!widget) return;

    const toggleBtn = widget.querySelector('#user-toggle');
    const dropdown = widget.querySelector('#user-dropdown-menu');
    const liveTime = widget.querySelector('#user-live-time');

    // Toggle dropdown
    toggleBtn.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });

    // Close dropdown if clicked outside
    window.addEventListener('click', function (e) {
        if (!widget.contains(e.target)) {
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

        liveTime.textContent = `${formattedDate} - ${hours}:${minutes}:${seconds} ${ampm}`;
    }

    setInterval(updateLiveTime, 1000);
})();
</script>
