@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')
    <!-- Page Header -->
    <div class="pt-4">
        <div class="w-full bg-mainbg px-4 min-h-screen">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
                <!-- Left side -->
                <div class="text-customIT flex flex-col">
                    <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Settings</h2>
                    <p class="text-sm text-gray-600">Manage system preferences and configurations</p>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 text-medium">
                <!-- Sidebar -->
                <aside class="bg-white rounded-xl shadow p-4 h-[500px] overflow-y-">
                    <ul class="space-y-1">
                        <li>
                            <button onclick="showSection('general', this)" 
                                class="nav-btn w-full text-left py-2 px-3 rounded-lg hover:bg-hover-green transition">
                                General
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('users', this)" 
                                class="nav-btn w-full text-left py-2 px-3 rounded-lg hover:bg-hover-green transition">
                                User Management
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('notifications', this)" 
                                class="nav-btn w-full text-left py-2 px-3 rounded-lg hover:bg-hover-green transition">
                                Notifications
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('preferences', this)" 
                                class="nav-btn w-full text-left py-2 px-3 rounded-lg hover:bg-hover-green transition">
                                System Preferences
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('organization', this)" 
                                class="nav-btn w-full text-left py-2 px-3 rounded-lg hover:bg-hover-green transition">
                                SWISA Organization
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('chat', this)" 
                                class="nav-btn w-full text-left py-2 px-3 rounded-lg hover:bg-hover-green transition">
                                Chat Settings
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('modules', this)" 
                                class="nav-btn w-full text-left py-2 px-3 rounded-lg hover:bg-hover-green transition">
                                Modules Control
                            </button>
                        </li>

                        <li>
                            <button onclick="showSection('backup', this)" 
                                class="nav-btn w-full text-left py-2 px-3 rounded-lg hover:bg-hover-green transition">
                                Data & Backup
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('integrations', this)" 
                                class="nav-btn w-full text-left py-2 px-3 rounded-lg hover:bg-hover-green transition">
                                Integrations / Developer
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('security', this)" 
                                class="nav-btn w-full text-left py-2 px-3 rounded-lg hover:bg-hover-green transition text-red-500">
                                Security
                            </button>
                        </li>
                    </ul>
                </aside>

                <!-- Main Settings Panel -->
                <main class="lg:col-span-4 bg-white rounded-xl shadow p-6">
                    
                    <!-- General Settings -->
                    <div id="general-section" class="settings-section">
                        <h3 class="text-xl text-[#2C6E49] font-semibold mb-4">General Settings</h3>
                        <form action="#" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <label for="systemName" class="block text-sm font-medium text-gray-700">System Name</label>
                                <input readonly type="text" id="systemName" name="systemName" value="SwisaAgap"
                                    class="mt-1 block w-full h-11 p-3 rounded-lg border-gray-300 shadow-sm focus:border-accent-green focus:ring-accent-green sm:text-sm">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Admin Email</label>
                                <input readonly type="email" id="email" name="email" value="admin@swisaagap.com"
                                    class="mt-1 block w-full h-11 p-3 rounded-lg border-gray-300 shadow-sm focus:border-accent-green focus:ring-accent-green sm:text-sm">
                            </div>

                            <div>
                                <label for="timezone" class="block text-sm font-medium text-gray-700">Timezone</label>
                                <select id="timezone" name="timezone"
                                    class="mt-1 block w-full h-11 p-3 rounded-lg border-gray-300 shadow-sm focus:border-accent-green focus:ring-accent-green sm:text-sm">
                                    <option>Asia/Manila</option>
                                    <option>Asia/Singapore</option>
                                    <option>Asia/Tokyo</option>
                                    <option>America/New_York</option>
                                </select>
                            </div>

                            <div>
                                <label for="logo" class="block text-sm font-medium text-gray-700">System Logo</label>
                                <input type="file" id="logo" name="logo"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent-green file:text-white hover:file:bg-primary-green">
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-5 py-2 bg-accent-green text-white rounded-lg shadow hover:bg-primary-green transition">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- USER MANAGEMENT -->
                    @include('swisa-admin.settings.user-management')

                    <!-- Notifications -->
                    <div id="notifications-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-[#2C6E49] mb-4">Notification Settings</h3>
                        <p class="text-gray-600 text-sm">Configure how users receive alerts and updates.</p>
                        <div class="space-y-4 mt-4">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" checked class="rounded text-accent-green focus:ring-accent-green">
                                <span>Email Notifications</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" class="rounded text-accent-green focus:ring-accent-green">
                                <span>SMS Alerts</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" class="rounded text-accent-green focus:ring-accent-green">
                                <span>System Popups</span>
                            </label>
                        </div>
                    </div>

                    <!-- System Preferences -->
                    <div id="preferences-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-[#2C6E49] mb-4">System Preferences</h3>
                        <p class="text-gray-600 text-sm">Adjust system-wide configurations and defaults.</p>
                        <div class="space-y-4 mt-4">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" checked class="rounded text-accent-green focus:ring-accent-green">
                                <span>Enable Dark Mode</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" class="rounded text-accent-green focus:ring-accent-green">
                                <span>Auto Backup</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" checked class="rounded text-accent-green focus:ring-accent-green">
                                <span>Enable Multi-language Support</span>
                            </label>
                        </div>
                    </div>

                    <!-- SWISA ORGANIZATION SETTINGS -->
                    <div id="organization-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-[#2C6E49] mb-4">SWISA Organization Settings</h3>
                        <p class="text-gray-600 text-sm mb-4">Manage information about SWISA groups, categories, and programs.</p>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Default SWISA Region</label>
                                <input type="text" value="Region V - Sorsogon" class="mt-1 block w-full p-3 rounded-lg border-gray-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Program Categories</label>
                                <input type="text" placeholder="e.g., Farmers, Fisherfolk, Equipment Lending..." class="mt-1 block w-full p-3 rounded-lg border-gray-300">
                            </div>
                            <button class="mt-2 px-4 py-2 bg-accent-green text-white rounded-lg hover:bg-primary-green">Update Organization Settings</button>
                        </div>
                    </div>

                    <!-- CHAT SETTINGS -->
                    <div id="chat-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-[#2C6E49] mb-4">💬 Chat Settings</h3>
                        <p class="text-gray-600 text-sm mb-4">Manage system chat options and quick replies.</p>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center border p-4 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-800">Quick Replies</p>
                                    <p class="text-sm text-gray-500">Create, edit, or remove predefined replies for faster responses.</p>
                                </div>
                                <a class="px-4 py-2 bg-accent-green text-white rounded-lg hover:bg-primary-green transition">
                                    Manage
                                </a>
                            </div>

                            <div class="flex justify-between items-center border p-4 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-800">Auto Greeting Message</p>
                                    <p class="text-sm text-gray-500">Set a default message when users open the chat.</p>
                                </div>
                                <button class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- MODULES CONTROL -->
                    <div id="modules-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-[#2C6E49] mb-4">Modules Control</h3>
                        <p class="text-gray-600 text-sm mb-4">Enable or disable system modules.</p>
                        <div class="space-y-3">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" checked> <span>Credit Endorsement Module</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" checked> <span>Equipment Borrowing</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox"> <span>Training Programs</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox"> <span>Learning Resources</span>
                            </label>
                        </div>
                    </div>

                    <!-- DATA & BACKUP -->
                    <div id="backup-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-[#2C6E49] mb-4">Data & Backup</h3>
                        <p class="text-gray-600 text-sm mb-4">Manage data backups and restoration.</p>
                        <div class="space-y-4">
                            <button class="px-4 py-2 bg-accent-green text-white rounded-lg hover:bg-primary-green">Manual Backup</button>
                            <button class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Restore Backup</button>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" checked> <span>Enable Scheduled Daily Backups</span>
                            </label>
                        </div>
                    </div>

                    <!-- INTEGRATIONS / DEVELOPER -->
                    <div id="integrations-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-[#2C6E49] mb-4">Integration & Developer Settings</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">API Key</label>
                                <input type="text" value="*************************" class="mt-1 block w-full p-3 rounded-lg border-gray-300">
                            </div>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox"> <span>Enable Maintenance Mode</span>
                            </label>
                        </div>
                    </div>

                    <!-- SECURITY -->
                    <div id="security-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-red-500 mb-4">Security Settings</h3>
                        <p class="text-gray-600 text-sm">Manage passwords, 2FA, and account safety.</p>
                        <div class="space-y-4 mt-4">
                            <button class="px-4 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">
                                Change Admin Password
                            </button>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" checked class="rounded text-accent-green focus:ring-accent-green">
                                <span>Enable Two-Factor Authentication</span>
                            </label>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- JS for Tabs -->
    <script>
        function showSection(section, btn) {
            document.querySelectorAll('.settings-section').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.nav-btn').forEach(el => el.classList.remove('bg-hover-green', 'font-semibold', 'text-custom'));

            document.getElementById(section + '-section').classList.remove('hidden');
            btn.classList.add('bg-hover-green', 'font-semibold', 'text-custom');
        }
    </script>
@endsection
