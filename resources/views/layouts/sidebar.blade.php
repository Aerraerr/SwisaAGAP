<!-- Hamburger -->
<button class="hamburger sidebar-closebtn" id="toggleButton" onclick="toggleSidebar()">☰</button>

<!-- Sidebar (default collapsed) -->
<div class="sidebar z-500 collapsed" id="sidebar">
    <div class="sidebar-header mb-5">
        <img class="sidebar-logo" src="{{ asset('images/swisa-agap4.png') }}" alt="Swisa AGAP Logo">
    </div>

    <!-- Scrollable Menu Section -->
    <div class="sidebar-menu">
        <div class="managesec"><span class="text-sm ml-5">MAIN MENU</span></div>

        <!-- Dashboard -->
        <a class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
           href="{{ route('dashboard') }}">
           <i class="material-icons">dashboard</i>
           <span class="menu-text">Dashboard</span>
        </a>

        <!-- Members -->
        <a class="menu-item {{ request()->routeIs('members') ? 'active' : '' }}" 
           href="{{ route('members') }}">
           <i class="material-icons">person</i>
           <span class="menu-text">Registered Members</span>
        </a>

        <!-- Grant & Equipment -->
        <a class="menu-item {{ request()->routeIs('grantsNequipment') ? 'active' : '' }}" 
           href="{{ route('grantsNequipment') }}">
           <i class="material-icons">inventory</i>
           <span class="menu-text">Grant & Equipment</span>
        </a>

        <!-- Initiatives & Events -->
        <a class="menu-item {{ request()->routeIs('training-workshop') ? 'active' : '' }}" 
           href="{{ route('training-workshop') }}">
           <i class="material-icons">school</i>
           <span class="menu-text">Initiatives & Events</span>
        </a>

        <!-- Announcements -->
        <a class="menu-item {{ request()->routeIs('announcements') ? 'active' : '' }}" 
           href="{{ route('announcements') }}">
           <i class="material-icons">campaign</i>
           <span class="menu-text">Announcements</span>
        </a>

        <div class="managesec mt-3" style="opacity: 0.5; cursor: default;">
            <span class="text-sm ml-5">MANAGEMENT SECTION</span>
        </div>

        <a class="menu-item {{ request()->routeIs('grant-request') ? 'active' : '' }}" 
           href="{{ route('grant-request') }}">
           <i class="material-icons">folder</i>
           <span class="menu-text">Requests</span>
        </a>

        <a class="menu-item {{ request()->routeIs('member-application') ? 'active' : '' }}" 
           href="{{ route('member-application') }}">
           <i class="material-icons">app_registration</i>
           <span class="menu-text">Applications</span>
        </a>

        <a class="menu-item {{ request()->routeIs('logs') ? 'active' : '' }}" 
           href="{{ route('logs') }}">
           <i class="material-icons">history</i>
           <span class="menu-text">Activity Logs</span>
        </a>

        <a class="menu-item {{ request()->routeIs('admin-reports') ? 'active' : '' }}" 
           href="{{ route('admin-reports') }}">
           <i class="material-icons">bar_chart</i>
           <span class="menu-text">Reports</span>
        </a>

        <a class="menu-item {{ request()->routeIs('messages') ? 'active' : '' }}" 
           href="{{ route('messages')}}">
           <i class="material-icons">email</i>
           <span class="menu-text">Messages</span>
           <span class="material-icons ml-[-10px]" style="color:red; font-size: 14px;">fiber_manual_record</span>
        </a>
        
        <a class="menu-item {{ request()->routeIs('settings') ? 'active' : '' }}"
           href="{{ route('settings') }}">
           <i class="material-icons">settings</i>
           <span class="menu-text">Settings</span>
        </a>
    </div>

    <!-- Fixed User Section -->
    <div class="user-section">
        <a href="{{ route('profile.edit') }}">
            <img src="{{ asset('images/profile-user.png') }}" class="user-avatar" alt="User Avatar">
        </a>
        <div class="user-name menu-text">{{ auth()->user()->name ?? 'User Admin' }}</div>
        <div class="admin-role menu-text text-xs text-gray-500">Admin Acc</div>
    </div>
</div>
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
<script>
// FOR SIDEBAR BEHAV
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const toggleButton = document.getElementById("toggleButton");

    if (window.innerWidth <= 768) {
        // 📱 Mobile: slide in/out full sidebar
        sidebar.classList.toggle("show");
        const isShown = sidebar.classList.contains("show");
        toggleButton.innerText = isShown ? "‹" : "☰";

        localStorage.setItem("mobileSidebarShown", isShown ? "true" : "false");
    } else {
        // 💻 Desktop: collapse/expand
        const isCollapsed = sidebar.classList.toggle("collapsed");
        toggleButton.innerText = isCollapsed ? "☰" : "‹";
        toggleButton.classList.toggle("active-bg", isCollapsed);

        localStorage.setItem("sidebarCollapsed", isCollapsed ? "true" : "false");
    }
}

function restoreSidebarState() {
    const sidebar = document.getElementById("sidebar");
    const toggleButton = document.getElementById("toggleButton");

    if (window.innerWidth <= 768) {
        // 📱 Mobile: always default to HAMBURGER (hidden)
        sidebar.classList.remove("show");
        toggleButton.innerText = "☰";
        localStorage.setItem("mobileSidebarShown", "false");
    } else {
        // 💻 Desktop: restore last state
        let isCollapsed = localStorage.getItem("sidebarCollapsed");
        if (isCollapsed === "true") {
            sidebar.classList.add("collapsed");
            toggleButton.innerText = "☰";
            toggleButton.classList.add("active-bg");
        } else {
            sidebar.classList.remove("collapsed");
            toggleButton.innerText = "‹";
            toggleButton.classList.remove("active-bg");
        }
    }
}

document.addEventListener("DOMContentLoaded", restoreSidebarState);
window.addEventListener("resize", restoreSidebarState);


// FOR TOGGLE
function toggleSidebarDropdown(element) {
    const sidebar = document.getElementById("sidebar");
    if (sidebar.classList.contains("collapsed")) return;

    const submenu = element.nextElementSibling;
    const isOpen = submenu.classList.contains("show");

    document.querySelectorAll('.submenu').forEach(menu => menu.classList.remove('show'));
    document.querySelectorAll('.dropdown-toggle').forEach(toggle => toggle.classList.remove('open'));

    if (!isOpen) {
        submenu.classList.add("show");
        element.classList.add('open');
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggleButton = document.getElementById("toggleButton");

    // ✅ Force default to collapsed if no preference is saved
    let isCollapsed = localStorage.getItem("sidebarCollapsed");
    if (isCollapsed === null) {
        isCollapsed = "true"; 
        localStorage.setItem("sidebarCollapsed", "true");
    }

    if (isCollapsed === "true") {
        sidebar.classList.add("collapsed");
        toggleButton.innerText = "☰";
        toggleButton.classList.add("active-bg");
    } else {
        sidebar.classList.remove("collapsed");
        toggleButton.innerText = "‹";
        toggleButton.classList.remove("active-bg");
    }
});

if (window.$ && $.pjax) {
    $(document).pjax('.sidebar a', '#pjax-container');
    $(document).on('pjax:click', function(event) {
        $('.menu-item, .submenu-item').removeClass('active');
        $(event.target).closest('a').addClass('active');
    });
}
</script>
