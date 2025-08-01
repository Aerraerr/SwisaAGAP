<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SwisaAGAP</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/forsidebar.css') }}">
</head>
<body>

<!-- Hamburger -->
<button class="hamburger" id="toggleButton" onclick="toggleSidebar()">«</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <img src="https://via.placeholder.com/30" alt="" style="margin-right:10px;">
        <span class="brand-title">SwisaAGAP</span>
    </div>

    <!-- Dashboard Dropdown -->
    <div class="menu-item dropdown-toggle" onclick="toggleDropdown(this)">
        <i class="material-icons">dashboard</i>
        <span class="menu-text">Dashboard</span>
        <i class="material-icons dropdown-icon">expand_more</i>
    </div>
    <div class="submenu">
        <a class="submenu-item" href="#">Overview</a>
        <a class="submenu-item" href="#">Reports</a>
    </div>

    <!-- Members Dropdown -->
    <div class="menu-item dropdown-toggle" onclick="toggleDropdown(this)">
        <i class="material-icons">person</i>
        <span class="menu-text">Members</span>
        <i class="material-icons dropdown-icon">expand_more</i>
    </div>
    <div class="submenu">
        <a class="submenu-item" href="#">List of Members</a>
        <a class="submenu-item" href="#">Add Member</a>
    </div>

    <!-- Grant & Equipment Dropdown -->
    <div class="menu-item dropdown-toggle" onclick="toggleDropdown(this)">
        <i class="material-icons">inventory</i>
        <span class="menu-text">Grant & Equipment</span>
        <i class="material-icons dropdown-icon">expand_more</i>
    </div>
    <div class="submenu">
        <a class="submenu-item" href="#">View Grants</a>
        <a class="submenu-item" href="#">Add Equipment</a>
    </div>

    <!-- Training Dropdown -->
    <div class="menu-item dropdown-toggle" onclick="toggleDropdown(this)">
        <i class="material-icons">school</i>
        <span class="menu-text">Training</span>
        <i class="material-icons dropdown-icon">expand_more</i>
    </div>
    <div class="submenu">
        <a class="submenu-item" href="#">Schedule</a>
        <a class="submenu-item" href="#">Past Training</a>
    </div>

    <!-- Announcements Dropdown -->
    <div class="menu-item dropdown-toggle" onclick="toggleDropdown(this)">
        <i class="material-icons">campaign</i>
        <span class="menu-text">Announcements</span>
        <i class="material-icons dropdown-icon">expand_more</i>
    </div>
    <div class="submenu">
        <a class="submenu-item" href="#">Post Announcement</a>
        <a class="submenu-item" href="#">All Announcements</a>
    </div>

    <div class="menu-item" style="opacity: 0.5; cursor: default;">
        <span class="menu-text">Management Section</span>
    </div>
    <a class="menu-item"><i class="material-icons">folder</i><span class="menu-text">Requests</span></a>
    <a class="menu-item"><i class="material-icons">app_registration</i><span class="menu-text">Applications</span></a>
    <a class="menu-item">
        <i class="material-icons">email</i>
        <span class="menu-text">Messages</span>
        <span class="material-icons" style="color:red; font-size: 14px;">fiber_manual_record</span>
    </a>
    <a class="menu-item"><i class="material-icons">settings</i><span class="menu-text">Settings</span></a>

    <!-- User Section -->
    <div class="user-section">
        <img src="https://via.placeholder.com/50" class="user-avatar">
        <div class="user-name menu-text">{{ auth()->user()->name ?? 'User Admin' }}</div>
        <div class="admin-role menu-text" style="font-size:12px; color:gray;">Admin Acc</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout">
                <span class="material-icons">logout</span>
            </button>
        </form>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    @yield('content')
</div>

<!-- Scripts -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const toggleButton = document.getElementById("toggleButton");
        sidebar.classList.toggle("collapsed");

        toggleButton.innerText = sidebar.classList.contains("collapsed") ? "☰" : "«";
    }

    function toggleDropdown(element) {
        const submenu = element.nextElementSibling;
        const isOpen = submenu.style.display === "flex";

        document.querySelectorAll('.submenu').forEach(menu => menu.style.display = 'none');
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => toggle.classList.remove('open'));

        if (!isOpen) {
            submenu.style.display = "flex";
            element.classList.add('open');
        }
    }
</script>

</body>
</html>
