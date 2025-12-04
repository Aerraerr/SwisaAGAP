<style>
    @font-face {
      font-family: 'Product Sans';
      src: url("../fonts/ProductSans-Regular.ttf") format("truetype");
      font-weight: normal;
      font-style: normal;
    }

    @font-face {
      font-family: 'Rubik';
      src: url('../fonts/Rubik1/Rubik-Bold.ttf') format('truetype');
      font-weight: bold;
      font-style: normal;
    }

    @font-face {
      font-family: 'Poppins';
      src: url('../fonts/poppins/Poppins-Regular.ttf') format('truetype');
      font-weight: 400;
      font-style: normal;
    }

    @font-face {
      font-family: 'Poppins';
      src: url('../fonts/poppins/Poppins-Medium.ttf') format('truetype');
      font-weight: 500;
      font-style: normal;
    }

    @font-face {
      font-family: 'Poppins';
      src: url('../fonts/poppins/Poppins-Bold.ttf') format('truetype');
      font-weight: 700;
      font-style: normal;
    }

    :root {
      --primary-green: #2C6E49;
      --unselect-green: #697a8d;
      --accent-green: #2f8f4e;
      --hover-green: #D0E9D4;
      --light-bg: #eaf4ec;
      --icon-color: #68B2AB;
    }

    body {
      margin: 0;
      display: flex;
      background-color: white;
      font-family: 'Poppins', sans-serif;
      font-weight: 400;
    }

    .brand-title {
      font-family: 'Rubik', sans-serif;
      font-weight: 700;
      font-size: 22px;
      letter-spacing: 1px;
      color: var(--primary-green);
      margin-left: -45px;
    }

    /* Sidebar styles */
    .sidebar {
      display: flex;
      flex-direction: column;
      width: 270px;
      background-color: #E8F6EF;
      height: 100%;
      position: fixed;
      left: 0;
      top: 0;
      bottom: 0;
      transition: width 0.3s ease;
      box-shadow: 2px 0 2px rgba(0, 0, 0, 0.1);
      color: var(--primary-green);
      overflow: hidden;
      padding-left: 10px;
      padding-right: 10px;
      z-index: 20;
    }

    .managesec {
      opacity: 0.5;
      cursor: default;
      color: var(--unselect-green);
    }

    .sidebar.collapsed {
      width: 70px;
    }

    .sidebar-header {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      padding: 15px;
      color: var(--primary-green);
    }

    .sidebar-logo {
      height: 70px;
      width: 180px;
      object-fit: contain;
      margin-left: 10px;
      margin-top: -5px;
    }

    .sidebar.collapsed .sidebar-header {
      justify-content: center;
    }

    .sidebar.collapsed .brand-title,
    .sidebar.collapsed .menu-text,
    .sidebar.collapsed .managesec,
    .sidebar.collapsed .sidebar-logo,
    .sidebar.collapsed #sidebarToggleImg {
      display: none !important;
    }

    .sidebar-menu {
      flex: 1;
      overflow-y: auto;
      padding-bottom: 5px;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .sidebar.collapsed .sidebar-menu {
      overflow: hidden;
      padding-top: 50px;
    }

    .sidebar .menu-item {
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 10px 20px;
      color: var(--icon-color);
      text-decoration: none;
      font-family: 'Poppins', sans-serif;
      transition: all 0.5s ease;
      border-radius: 5px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .menu-item:hover {
      background-color: var(--hover-green);
      border-right: 4px solid var(--primary-green);
      font-weight: bold;
      border-radius: 5px;
    }

    .menu-item i {
      font-size: 20px;
      color: #68B2AB;
      flex-shrink: 0;
    }

    .menu-text {
      flex: 1;
      word-break: break-word;
    }

    .sidebar.collapsed .menu-item {
      justify-content: center;
      padding: 15px 0;
      margin: 0 auto;
      width: 100%;
      height: 50px;
    }

    .sidebar.collapsed .menu-item i {
      font-size: 26px;
      text-align: center;
      margin-bottom: 2px;
    }

    .user-section {
      padding: 10px 0;
      width: 80%;
      margin: 0 auto;
      text-align: center;
      border-top: 1px solid #ccc;
      font-family: 'Poppins', sans-serif;
    }

    .user-avatar {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      display: block;
      margin: 0 auto;
    }

    .user-name {
      font-weight: bold;
      font-family: 'Poppins', sans-serif;
    }

    .logout {
      margin-top: 10px;
      background-color: var(--accent-green);
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      width: 75%;
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
    }

    .sidebar.collapsed .logout {
      width: 40px;
      height: 40px;
      padding: 5px;
    }

    .main-content {
      margin-left: 250px;
      padding: 20px;
      transition: margin-left 0.5s ease;
      width: 100%;
      font-family: 'Poppins', sans-serif;
    }

    .sidebar.collapsed ~ .main-content {
      margin-left: 70px;
    }

    .menu-item.active {
      background-color: var(--hover-green) !important;
      border-right: 4px solid var(--primary-green);
      color: var(--primary-green) !important;
      font-weight: bold;
      border-radius: 5px;
      margin: 0;
      padding-left: 20px;
      box-sizing: border-box;
    }

    .menu-item.active i {
      color: var(--primary-green) !important;
    }

    .sidebar.collapsed .menu-item.active {
      justify-content: center;
      margin-bottom: 0px;
      border-radius: 5px;
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
    }

    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
        width: 250px;
        transition: transform 0.5s ease;
        z-index: 20; 
      }
      .sidebar.collapsed .menu-item.active {
        justify-content: center;
        margin-bottom: 0px;
        border-radius: 5px;
        width: 250px;
        height: 50px;
        display: flex;
        align-items: center;
          background-color: var(--hover-green);
        border-right: 4px solid var(--primary-green);
        font-weight: bold;
        border-radius: 5px;

      }
      .menu-item.active{

      }

      .sidebar.show {
        transform: translateX(0);
      }

      .sidebar.collapsed {
        width: 250px;
      }

      .sidebar.collapsed .menu-text,
      .sidebar.collapsed .managesec,
      .sidebar.collapsed .sidebar-logo,
      .sidebar.collapsed .user-section {
        display: block !important;
      }

      .main-content {
        margin-left: 0 !important;
      }
    }

    /* ✅ Toggle Button Image */
    #sidebarToggleImg {
      width: 45px;
      height: 45px;
      object-fit: contain;
      cursor: pointer;
      position: fixed;
      top: 10px;
      left: 10px;
      z-index: 20;
      transition: transform 0.3s ease;
          display: none;
    }
</style>

<!-- 🟢 Sidebar Toggle Image -->
<img id="sidebarToggleImg" 
     src="{{ asset('images/swisa1.png') }}" 
     alt="Toggle Sidebar" 
     onclick="toggleSidebar()" />

<!-- Sidebar -->
<div class="sidebar collapsed" id="sidebar">
    <div class="sidebar-header mb-5">
        <img class="sidebar-logo" src="{{ asset('images/swisa-agap4.png') }}" alt="Swisa AGAP Logo">
    </div>

    <div class="sidebar-menu">
        <div class="managesec"><span class="text-sm ml-5">MAIN MENU</span></div>

        <a class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
           href="{{ route('dashboard') }}">
           <i class="material-icons">dashboard</i>
           <span class="menu-text">Dashboard</span>
        </a>

        @if(Auth::user()->role_id == 3)
            <a class="menu-item {{ request()->routeIs('members') ? 'active' : '' }}" 
            href="{{ route('members') }}">
            <i class="material-icons">person</i>
            <span class="menu-text">Registered Members</span>
            </a>
        
            <a class="menu-item {{ request()->routeIs('grantsNequipment') ? 'active' : '' }}" 
            href="{{ route('grantsNequipment') }}">
            <i class="material-icons">inventory</i>
            <span class="menu-text">Grant & Equipment</span>
            </a>
        @endif

        @if(Auth::user()->role_id == 2)
            <a class="menu-item {{ request()->routeIs('giveback') ? 'active' : '' }}" 
            href="{{ route('giveback') }}">
            <i class="material-icons">inventory</i>
            <span class="menu-text">Giveback</span>
            </a>
        @endif

        <a class="menu-item {{ request()->routeIs('training-workshop') ? 'active' : '' }}" 
           href="{{ route('training-workshop') }}">
           <i class="material-icons">school</i>
           <span class="menu-text">Initiatives & Events</span>
        </a>

        <a class="menu-item {{ request()->routeIs('announcements') ? 'active' : '' }}" 
           href="{{ route('announcements') }}">
           <i class="material-icons">campaign</i>
           <span class="menu-text">Announcements</span>
        </a>

        <div class="managesec mt-3">
            <span class="text-sm ml-5">MANAGEMENT SECTION</span>
        </div>

        @if(Auth::user()->role_id == 2)
            <a class="menu-item {{ request()->routeIs('assisted-creation') ? 'active' : '' }}" 
            href="{{ route('assisted-creation') }}">
            <i class="material-icons">folder</i>
            <span class="menu-text">Assisted Creation</span>
            </a>
        @endif

        <a class="menu-item {{ request()->routeIs('grant-request') ? 'active' : '' }}" 
           href="{{ route('grant-request') }}">
           <i class="material-icons">folder</i>
           <span class="menu-text">Requests</span>
        </a>

        

        @if(Auth::user()->role_id == 3)
          <a class="menu-item {{ request()->routeIs('member-application') ? 'active' : '' }}" 
            href="{{ route('member-application') }}">
            <i class="material-icons">app_registration</i>
            <span class="menu-text">Applications</span>
          </a>
          
           
            <a class="menu-item {{ request()->routeIs('logs.index') ? 'active' : '' }}" 
              href="{{ route('logs.index') }}">
                <i class="material-icons">history</i>
                <span class="menu-text">Activity Logs</span>
            </a>

            <a class="menu-item {{ request()->routeIs('admin-reports') ? 'active' : '' }}" 
            href="{{ route('admin-reports') }}">
            <i class="material-icons">bar_chart</i>
            <span class="menu-text">Reports</span>
            </a>
        @endif

        <a class="menu-item {{ request()->routeIs('chat.index') || request()->routeIs('chat.show') ? 'active' : '' }}" 
        href="{{ route('chat.index') }}">
        <i class="material-icons">email</i>
        <span class="menu-text">Messages</span>
        <span class="material-icons ml-[-10px]" style="color:red; font-size: 14px;">fiber_manual_record</span>
        </a>

        <a class="menu-item {{ request()->routeIs('faqs.index') ? 'active' : '' }}"
        href="{{ route('faqs.index') }}">
            <i class="material-icons">help_outline</i>
            <span class="menu-text">FAQs</span>
        </a>

        <a class="menu-item {{ request()->routeIs('settings') ? 'active' : '' }}"
           href="{{ route('settings') }}">
           <i class="material-icons">settings</i>
           <span class="menu-text">Settings</span>
        </a>
    </div>

    <div class="user-section">
        <a href="{{ route('profile.edit') }}">
            <img src="{{ asset('images/profile-user.png') }}" class="user-avatar" alt="User Avatar">
        </a>
        <div class="user-name menu-text">{{ auth()->user()->name ?? 'User Admin' }}</div>
        <div class="admin-role menu-text text-xs text-gray-500">Admin Acc</div>
    </div>
</div>
<script>
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const toggleImg = document.getElementById("sidebarToggleImg");

    
    const isMobile = window.innerWidth <= 768;

    if (isMobile) {
        sidebar.classList.toggle("show");
    } else {
        sidebar.classList.toggle("collapsed");
        toggleImg.classList.toggle("rotate");
        localStorage.setItem("sidebarCollapsed", sidebar.classList.contains("collapsed"));
    }
}

// Restore state
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggleImg = document.getElementById("sidebarToggleImg");
    let isCollapsed = localStorage.getItem("sidebarCollapsed");
    if (isCollapsed === "true") {
        sidebar.classList.add("collapsed");
    } else {
        sidebar.classList.remove("collapsed");
        toggleImg.classList.add("rotate");
    }
});

// Window resize handler
window.addEventListener("resize", function () {
    const sidebar = document.getElementById("sidebar");
    if (window.innerWidth <= 768) {
        sidebar.classList.add("collapsed");
    }
});
</script>
