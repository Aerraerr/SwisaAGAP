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
                <aside class="bg-white rounded-xl shadow p-4">
                    <h3 class="font-semibold text-custom mb-3V text-[#2C6E49]">Navigation</h3>
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
                        <h3 class="text-xl text-[#2C6E49] font-semibold text-custom mb-4">General Settings</h3>
 
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

                    <!-- User Management -->
                    <div id="users-section" class="settings-section hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-semibold text-custom text-[#2C6E49]">User Management</h3>
                            <button class="px-4 py-2 bg-accent-green text-white rounded-lg hover:bg-primary-green transition">
                                + Add User
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full border rounded-lg">
                                <thead class="bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Name</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Email</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Role</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-t">
                                        <td class="px-4 py-2">John Doe</td>
                                        <td class="px-4 py-2">john@example.com</td>
                                        <td class="px-4 py-2">Admin</td>
                                        <td class="px-4 py-2">
                                            <button class="text-blue-500 hover:underline">Edit</button> |
                                            <button class="text-red-500 hover:underline">Delete</button>
                                        </td>
                                    </tr>
                                    <tr class="border-t">
                                        <td class="px-4 py-2">Jane Smith</td>
                                        <td class="px-4 py-2">jane@example.com</td>
                                        <td class="px-4 py-2">User</td>
                                        <td class="px-4 py-2">
                                            <button class="text-blue-500 hover:underline">Edit</button> |
                                            <button class="text-red-500 hover:underline">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div id="notifications-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-custom mb-4 text-[#2C6E49]">Notification Settings</h3>
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
                        <h3 class="text-xl font-semibold text-custom mb-4 text-[#2C6E49]">System Preferences</h3>
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

                    <!-- Security -->
                    <div id="security-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-red-500 mb-4 text-[#2C6E49]">Security Settings</h3>
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
