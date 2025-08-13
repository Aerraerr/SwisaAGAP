<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SwisaAGAP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/forsidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<!-- Hamburger -->
<button class="hamburger sidebar-closebtn" id="toggleButton" onclick="toggleSidebar()">‹</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header mb-5">
        <img class="sidebar-logo" src="{{ asset('images/swisalogo.png') }}" alt="swisalogo">
        <span class="brand-title ">SwisaAGAP</span>
    </div>

    <!-- Scrollable Menu Section -->
    <div class=" sidebar-menu">
        <div class="managesec" style="">
            <span class="text-sm ml-5">MAIN MENU</span>
        </div>
        <div class="menu-item dropdown-toggle" onclick="toggleSidebarDropdown(this)">
            <i class="material-icons">dashboard</i>
            <span class="menu-text ">Dashboard</span>
            <i class="material-icons dropdown-icon">expand_more</i>
        </div>
        <div class="submenu">
            <a class="submenu-item" href="{{ route('dashboard') }}">Overview</a>
            <a class="submenu-item" href="#">Reports</a>
        </div>

        <div class="menu-item dropdown-toggle" onclick="toggleSidebarDropdown(this)">
            <i class="material-icons">person</i>
            <span class="menu-text">Members</span>
            <i class="material-icons dropdown-icon">expand_more</i>
        </div>
        <div class="submenu">
            <a class="submenu-item" href="{{ route('members') }}">List of Members</a>
            <a class="submenu-item" href="#">Add Member</a>
        </div>

        <div class="menu-item dropdown-toggle" onclick="toggleSidebarDropdown(this)">
            <i class="material-icons">inventory</i>
            <span class="menu-text">Grant & Equipment</span>
            <i class="material-icons dropdown-icon">expand_more</i>
        </div>
        <div class="submenu">
            <a class="submenu-item" href="{{ route('grantsNequipment') }}">View Grants</a>
            <a class="submenu-item" href="#">Add Equipment</a>
        </div>

        <div class="menu-item dropdown-toggle" onclick="toggleSidebarDropdown(this)">
            <i class="material-icons">school</i>
            <span class="menu-text">Training</span>
            <i class="material-icons dropdown-icon">expand_more</i>
        </div>
        <div class="submenu">
            <a class="submenu-item" href="#">Schedule</a>
            <a class="submenu-item" href="#">Past Training</a>
        </div>

        <div class="menu-item dropdown-toggle" onclick="toggleSidebarDropdown(this)">
            <i class="material-icons">campaign</i>
            <span class="menu-text">Announcements</span>
            <i class="material-icons dropdown-icon">expand_more</i>
        </div>
        <div class="submenu">
            <a class="submenu-item" href="#">Post Announcement</a>
            <a class="submenu-item" href="#">All Announcements</a>
        </div>

        <div class="managesec mt-3" style="opacity: 0.5; cursor: default;">
            <span class="text-sm ml-5">MANAGEMENT SECTION</span>
        </div>

        <a class="menu-item"><i class="material-icons">folder</i><span class="menu-text">Requests</span></a>
        <a class="menu-item"><i class="material-icons">app_registration</i><span class="menu-text">Applications</span></a>
        <a class="menu-item">
            <i class="material-icons">email</i>
            <span class="menu-text">Messages</span>
            <span class="material-icons ml-[-5px]" style="color:red; font-size: 14px;">fiber_manual_record</span>
        </a>
        <a class="menu-item"><i class="material-icons">settings</i><span class="menu-text">Settings</span></a>
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

<!-- Main Content -->
<div class="main-content bg-mainbg">
    @yield('content')
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const toggleButton = document.getElementById("toggleButton");
        const isCollapsed = sidebar.classList.toggle("collapsed");

        toggleButton.innerText = isCollapsed ? "☰" : "‹";
        if (isCollapsed) {
            toggleButton.classList.add("active-bg");
        } else {
            toggleButton.classList.remove("active-bg");
        }

        // Collapse all dropdowns
        if (isCollapsed) {
            document.querySelectorAll('.submenu').forEach(menu => {
                menu.style.display = 'none';
            });
            document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                toggle.classList.remove('open');
            });
        }
    }

    // Sidebar submenu toggle
    function toggleSidebarDropdown(element) {
        const sidebar = document.getElementById("sidebar");
        if (sidebar.classList.contains("collapsed")) return;

        const submenu = element.nextElementSibling;
        const isOpen = submenu.style.display === "flex";

        document.querySelectorAll('.submenu').forEach(menu => {
            menu.style.display = 'none';
        });
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.classList.remove('open');
        });

        if (!isOpen) {
            submenu.style.display = "flex";
            element.classList.add('open');
        }
    }

    // Profile dropdown toggle (renamed)
    function toggleProfileDropdown() {
        const menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
    }

    // Optional: close profile dropdown if clicked outside
    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('dropdownMenu');
        if (!dropdown) return; // safety check
        const trigger = dropdown.previousElementSibling;
        if (!dropdown.contains(e.target) && !trigger.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>



</body>
</html>
