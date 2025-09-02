<!-- Hamburger -->
<button class="hamburger sidebar-closebtn" id="toggleButton" onclick="toggleSidebar()">‹</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header mb-5">
        <img class="sidebar-logo" src="{{ asset('images/swisa-agap4.png') }}" alt="Swisa AGAP Logo">
    </div>

    <!-- Scrollable Menu Section -->
    <div class="sidebar-menu">
        <div class="managesec"><span class="text-sm ml-5">MAIN MENU</span></div>

        <!-- Dashboard -->
        <div class="menu-item dropdown-toggle {{ request()->routeIs('dashboard*') ? 'active open' : '' }}"
             onclick="toggleSidebarDropdown(this)">
            <i class="material-icons">dashboard</i>
            <span class="menu-text">Dashboard</span>
            <i class="material-icons dropdown-icon">expand_more</i>
        </div>
        <div class="submenu {{ request()->routeIs('dashboard*') ? 'show' : '' }}">
            <a class="submenu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
               href="{{ route('dashboard') }}">Overview</a>
            <a class="submenu-item" href="#">Reports</a>
        </div>

        <!-- Members -->
        <div class="menu-item dropdown-toggle {{ request()->routeIs('members*') ? 'active open' : '' }}"
             onclick="toggleSidebarDropdown(this)">
            <i class="material-icons">person</i>
            <span class="menu-text">Members</span>
            <i class="material-icons dropdown-icon">expand_more</i>
        </div>
        <div class="submenu {{ request()->routeIs('members*') ? 'show' : '' }}">
            <a class="submenu-item {{ request()->routeIs('members') ? 'active' : '' }}" 
               href="{{ route('members') }}">List of Members</a>
            <a class="submenu-item" href="#">Add Member</a>
        </div>

        <!-- Grant & Equipment -->
        <div class="menu-item dropdown-toggle {{ request()->routeIs('grantsNequipment*') ? 'active open' : '' }}"
             onclick="toggleSidebarDropdown(this)">
            <i class="material-icons">inventory</i>
            <span class="menu-text">Grant & Equipment</span>
            <i class="material-icons dropdown-icon">expand_more</i>
        </div>
        <div class="submenu {{ request()->routeIs('grantsNequipment*') ? 'show' : '' }}">
            <a class="submenu-item {{ request()->routeIs('grantsNequipment') ? 'active' : '' }}" 
               href="{{ route('grantsNequipment') }}">View Grants</a>
            <a class="submenu-item" href="#">Add Equipment</a>
        </div>

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

        <a class="menu-item {{ request()->routeIs('grant-request') ? 'active' : '' }}" href="{{ route('grant-request') }}"><i class="material-icons">folder</i><span class="menu-text">Requests</span></a>
        <a class="menu-item {{ request()->routeIs('member-application') ? 'active' : '' }}" href="{{ route('member-application') }}"><i class="material-icons">app_registration</i><span class="menu-text">Applications</span></a>
        <a class="menu-item {{ request()->routeIs('messages') ? 'active' : '' }}" href="{{ route('messages')}}">
            <i class="material-icons">email</i>
            <span class="menu-text">Messages</span>
            <span class="material-icons ml-[-10px]" style="color:red; font-size: 14px;">fiber_manual_record</span>
        </a>
        <a class="menu-item {{ request()->routeIs('logs') ? 'active' : '' }}" 
        href="{{ route('logs') }}">
            <i class="material-icons ">history</i>
            <span class="menu-text">Activity Logs</span>
        </a>


        <a class="menu-item {{ request()->routeIs('settings') ? 'active' : '' }}"
        href="{{ route('settings') }}"><i class="material-icons">settings</i><span class="menu-text">Settings</span>
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
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const toggleButton = document.getElementById("toggleButton");
        const isCollapsed = sidebar.classList.toggle("collapsed");

        toggleButton.innerText = isCollapsed ? "☰" : "‹";
        toggleButton.classList.toggle("active-bg", isCollapsed);

        if (isCollapsed) {
            document.querySelectorAll('.submenu').forEach(menu => menu.style.display = 'none');
            document.querySelectorAll('.dropdown-toggle').forEach(toggle => toggle.classList.remove('open'));
        }
    }

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
</script>
