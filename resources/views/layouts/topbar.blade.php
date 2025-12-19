<style>
/* 🟩 Topbar Base (Desktop) */
.topbar {
  position: fixed;
  top: 0;
  left: 270px;
  right: 0;
  height: 60px;
  background-color: #fff;
  border-bottom: 1px solid #e0e0e0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 15px;
  z-index: 200;
  transition: left 0.3s ease;
}

/* 🔄 Adjust when sidebar collapsed */
.sidebar.collapsed ~ .topbar {
  left: 70px;
}

/* 🟡 Main content offset below topbar */
.main-content {
  margin-top: 60px;
}

/* 📱 Mobile Responsive */
@media (max-width: 768px) {
  .topbar {
    display: none;
  }

  .mobile-topbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 60px;
    background-color: #fff;
    border-bottom: 1px solid #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 0 10px;
    z-index: 300;
  }

  .mobile-topbar button {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: transparent;
    transition: background 0.2s;
  }

  .mobile-topbar button:hover {
    background: #f3f3f3;
  }

  #user-live-time {
    display: none;
  }

  #sidebarToggleImg {
    display: none !important;
  }

  .main-content {
    margin-top: 60px;
  }
}

/* 🧭 Logo Sidebar Toggle Image (Desktop only) */
#sidebarToggleImg {
  width: 45px;
  height: 45px;
  object-fit: contain;
  cursor: pointer;
  position: fixed;
  top: 10px;
  left: 10px;
  z-index: 600;
  transition: transform 0.3s ease;
  display: none;
}
</style>

<!-- 🟩 Desktop Topbar -->
<div class="topbar">
  <div class="topbar-left flex items-center gap-1 text-[#2C6E49] font-bold">
    <button id="toggleButton" onclick="toggleSidebar()" 
      class="p-2 rounded hover:bg-gray-100 transition text-[#2C6E49] flex items-center justify-center">
      <!-- Open Icon -->
      <svg id="sidebarOpenIcon" class="w-7 h-7 text-gray-800 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <path stroke="#2C6E49" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 10 1.99994 1.9999-1.99994 2M11 5v14m-7 0h16c.5523 0 1-.4477 1-1V6c0-.55228-.4477-1-1-1H4c-.55228 0-1 .44772-1 1v12c0 .5523.44772 1 1 1Z"/>
      </svg>
      <!-- Close Icon -->
      <svg id="sidebarCloseIcon" class="w-7 h-7 text-gray-800 dark:text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <path stroke="#2C6E49" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.99994 10 6 11.9999l1.99994 2M11 5v14m-7 0h16c.5523 0 1-.4477 1-1V6c0-.55228-.4477-1-1-1H4c-.55228 0-1 .44772-1 1v12c0 .5523.44772 1 1 1Z"/>
      </svg>
    </button>
  </div>

  <!-- Right: Widgets -->
  <div id="user-widget" class="flex justify-between items-center gap-4 px-3 py-1 bg-white rounded-lg transition-all duration-300 ease-in-out relative">
    <!-- Live Clock -->
    <div id="user-live-time" class="hidden md:block text-sm font-bold text-[#2C6E49] whitespace-nowrap">
      <!-- JS will populate -->
    </div>

    <!-- Notifications -->
    <button id="notifButton" class="relative w-9 h-9 flex items-center justify-center rounded-full hover:bg-gray-100 transition">
      <span class="material-icons text-gray-600">notifications</span>
      <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1.5 rounded-full">3</span>
    </button>

    <!-- Avatar -->
    <div class="relative">
      <div id="user-toggle" class="flex items-center cursor-pointer select-none">
        <img src="{{ asset('images/profile-user.png') }}" alt="Profile" class="w-8 h-8 rounded-full shadow-md object-cover" />
      </div>
      <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 w-60 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
        <div class="py-2 text-[15px] text-gray-700 space-y-1 px-2 font-medium">
          <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 w-full px-3 py-2 rounded hover:bg-gray-100 transition">
            <span class="material-icons text-[#2C6E49] text-2xl">account_circle</span> View Profile
          </a>
          <a href="{{ route('settings') }}" class="flex items-center gap-3 w-full px-3 py-2 rounded hover:bg-gray-100 transition">
            <span class="material-icons text-gray-600 text-2xl">settings</span> Settings
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full text-left px-3 py-2 rounded hover:bg-gray-100 text-red-500 transition">
              <span class="material-icons text-red-500 text-2xl">logout</span> Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 📱 Mobile Topbar -->
<div class="mobile-topbar md:hidden">
  <button id="notifButtonMobile" class="relative">
    <span class="material-icons text-gray-600">notifications</span>
    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1.5 rounded-full">3</span>
  </button>
  <button id="mobileUserToggle" class="relative ml-2">
    <img src="{{ asset('images/profile-user.png') }}" alt="Profile" class="w-8 h-8 rounded-full shadow-md object-cover" />
  </button>
  <button id="mobileSidebarToggle" class="ml-2">
    <span class="material-icons text-[#2C6E49]">menu</span>
  </button>
</div>

<!-- 🔔 Notification Panel -->
<div id="notifPanel" class="fixed top-12 mt-3 right-0 h-full w-[500px] max-w-[90%] bg-white shadow-2xl z-10 transform translate-x-full transition-transform duration-300 ease-in-out">
  <div class="flex justify-between items-center px-4 py-3 border-b">
    <h2 class="font-bold text-lg text-gray-700">Notifications</h2>
    <button id="notif-close" class="text-gray-600 hover:text-black">
    </button>
  </div>
  <div class="p-4 overflow-y-auto h-[calc(100%-3rem)]">
    <p class="text-gray-600 text-sm">🔔 You have 3 new notifications.</p>
    <div class="mt-3 space-y-2">
      <div class="p-2 bg-gray-50 rounded">New message from Admin</div>
      <div class="p-2 bg-gray-50 rounded">System update completed</div>
      <div class="p-2 bg-gray-50 rounded">Member application approved</div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  // 🕒 Live Clock
  function updateTime() {
    const timeEl = document.getElementById("user-live-time");
    const now = new Date();
    const options = { month:'long', day:'2-digit', year:'numeric', hour:'2-digit', minute:'2-digit', second:'2-digit', hour12:true };
    timeEl.textContent = now.toLocaleString('en-US', options).replace(',', ' -');
  }
  updateTime();
  setInterval(updateTime, 1000);

  // Sidebar & notifications (same as previous)
  const sidebar = document.getElementById("sidebar");
  const toggleImg = document.getElementById("sidebarToggleImg");
  const openIcon = document.getElementById("sidebarOpenIcon");
  const closeIcon = document.getElementById("sidebarCloseIcon");
  const notifPanel = document.getElementById("notifPanel");
  const userDropdown = document.getElementById("user-dropdown-menu");
  const isMobile = window.innerWidth <= 768;

  // Restore sidebar state
  const savedState = localStorage.getItem("sidebarState");
  if (!isMobile && savedState === "collapsed") {
    sidebar.classList.add("collapsed");
    openIcon.classList.remove("hidden");
    closeIcon.classList.add("hidden");
    if (toggleImg) toggleImg.style.display = "block";
  }

  // Notification buttons
  [document.getElementById("notifButton"), document.getElementById("notifButtonMobile")].forEach(btn => {
    if (btn) btn.addEventListener("click", e => {
      e.stopPropagation();
      notifPanel.classList.toggle("translate-x-full");
    });
  });
  document.getElementById("notif-close").addEventListener("click", () => {
    notifPanel.classList.add("translate-x-full");
  });

  // User dropdown
  [document.getElementById("user-toggle"), document.getElementById("mobileUserToggle")].forEach(btn => {
    if (btn) btn.addEventListener("click", e => {
      e.stopPropagation();
      userDropdown.classList.toggle("hidden");
    });
  });

  document.addEventListener("click", e => {
    if (!userDropdown.contains(e.target)) userDropdown.classList.add("hidden");
    if (!notifPanel.contains(e.target)) notifPanel.classList.add("translate-x-full");
  });

  // Mobile sidebar
  document.getElementById("mobileSidebarToggle").addEventListener("click", toggleSidebar);
});

function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const toggleImg = document.getElementById("sidebarToggleImg");
  const openIcon = document.getElementById("sidebarOpenIcon");
  const closeIcon = document.getElementById("sidebarCloseIcon");
  const isMobile = window.innerWidth <= 768;

  if (isMobile) {
    sidebar.classList.toggle("show");
    localStorage.setItem("sidebarState", sidebar.classList.contains("show") ? "open" : "closed");
  } else {
    const collapsed = sidebar.classList.toggle("collapsed");
    if (collapsed) {
      openIcon.classList.remove("hidden");
      closeIcon.classList.add("hidden");
      if (toggleImg) toggleImg.style.display = "block";
      localStorage.setItem("sidebarState", "collapsed");
    } else {
      openIcon.classList.add("hidden");
      closeIcon.classList.remove("hidden");
      if (toggleImg) toggleImg.style.display = "none";
      localStorage.setItem("sidebarState", "expanded");
    }
  }
}
</script>
