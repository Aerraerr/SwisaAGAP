<!-- User Widget -->
<div id="user-widget" 
     class="flex justify-between items-center w-[380px] h-16 hover:w-[500px] px-5 py-3 bg-white shadow-lg rounded-lg font-poppins relative transition-all duration-300 ease-in-out">

    <!-- Live Clock Display (hidden on mobile) -->
    <div id="user-live-time" 
         class="text-[#2C6E49] text-sm font-bold tracking-wide text-custom whitespace-nowrap overflow-hidden hidden md:block">
        {{ \Carbon\Carbon::now()->format('F d, Y - h:i:s A') }}
    </div>

    <!-- User Controls -->
    <div class="relative flex items-center gap-3 ml-3">
        
        <!-- Notifications -->
        <button id="notif-btn"
                class="relative w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition">
            <span class="material-icons text-gray-600 text-[20px]">notifications</span>
            <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-bold px-1.5 rounded-full">
                3
            </span>
        </button>

        <!-- User Dropdown -->
        <div class="relative">
            <div class="flex items-center cursor-pointer select-none" id="user-toggle">
                <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                     class="w-8 h-8 rounded-full shadow-md object-cover" />
            </div>

            <!-- Dropdown Menu -->
            <div class="hidden absolute right-0 mt-2 w-60 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                id="user-dropdown-menu">
                <div class="py-2 text-[15px] text-gray-700 space-y-1 px-2 font-medium">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 w-full px-3 py-2 rounded hover:bg-gray-100 transition">
                        <span class="material-icons text-[#2C6E49] text-2xl">account_circle</span>
                        View Profile
                    </a>
                    <a href="{{ route('settings') }}" class="flex items-center gap-3 w-full px-3 py-2 rounded hover:bg-gray-100 transition">
                        <span class="material-icons text-gray-600 text-2xl">settings</span>
                        Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex items-center gap-3 w-full text-left px-3 py-2 rounded hover:bg-gray-100 text-red-500 transition">
                            <span class="material-icons text-red-500 text-2xl">logout</span>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification Panel -->
<div id="notif-panel" 
     class="fixed top-0 right-0 h-full w-[500px] max-w-[90%] bg-white shadow-2xl z-10 transform translate-x-full transition-transform duration-300 ease-in-out">
    <div class="flex justify-between items-center px-4 py-3 border-b">
        <h2 class="font-bold text-lg text-gray-700">Notifications</h2>
        <button id="notif-close" class="text-gray-600 hover:text-black">
            <span class="material-icons">close</span>
        </button>
    </div>
    <div class="p-4 overflow-y-auto h-[calc(100%-3rem)]">
        <p class="text-gray-600 text-sm">🔔 You have 3 new notifications.</p>
        <!-- Example notifications -->
        <div class="mt-3 space-y-2">
            <div class="p-2 bg-gray-50 rounded">New message from Admin</div>
            <div class="p-2 bg-gray-50 rounded">System update completed</div>
            <div class="p-2 bg-gray-50 rounded">Member application approved</div>
        </div>
    </div>
</div>

<!-- Styles for Responsive Behavior -->
<style>
/* 📱 Mobile: Make widget small, top-right, no bg/date */
@media (max-width: 768px) {
  #user-widget {
    position: absolute;   /* fixed inside layout, not sticky */
    top: 30px;
    right: 10px;
    width: auto;
    height: auto;
    background: transparent;
    box-shadow: none;
    padding: 0;
  }

  #user-widget:hover {
    width: auto; /* disable hover expansion */
  }

  #user-live-time {
    display: none !important;
  }
}
</style>

<!-- Scoped Script -->
<script>
(function () {
    const widget = document.getElementById('user-widget');
    if (!widget) return;

    const toggleBtn = widget.querySelector('#user-toggle');
    const dropdown = widget.querySelector('#user-dropdown-menu');
    const liveTime = document.getElementById('user-live-time');

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
    if (liveTime) {
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
        updateLiveTime();
    }

    // ✅ Notification Panel Behavior
    const notifBtn = document.getElementById('notif-btn');
    const notifPanel = document.getElementById('notif-panel');
    const notifClose = document.getElementById('notif-close');

    notifBtn.addEventListener('click', () => {
        notifPanel.classList.remove('translate-x-full');
    });

    notifClose.addEventListener('click', () => {
        notifPanel.classList.add('translate-x-full');
    });

    // Close when clicking outside panel
    window.addEventListener('click', function(e) {
        if (!notifPanel.contains(e.target) && !notifBtn.contains(e.target)) {
            notifPanel.classList.add('translate-x-full');
        }
    });
})();
</script>
