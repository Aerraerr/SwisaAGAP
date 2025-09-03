@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class=" w-full pt-4">
        <div class="w-full bg-mainbg px-4 min-h-screen">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
                <!-- Left side -->
                <div class="text-customIT flex flex-col">
                    <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Settings</h2>
                    <p class="text-lg text-gray-600">Manage system preferences and configurations</p>
                </div>

                <!-- Right side -->
                @include('components.UserTab')
            </div>

            <!-- Settings Content -->
            <div class=" grid grid-cols-1 lg:grid-cols-5 gap-2 text-medium">
                <!-- Sidebar -->
                <div class="lg:grid-cols-1  rounded-2xl  ">
                    <h3 class="font-semibold text-custom mb-4">Navigation</h3>
                    <ul class="space-y-3">
                        <li>
                            <button onclick="showSection('general')" 
                                class="w-full text-left  py-1 rounded-lg hover:bg-gray-100 font-medium">
                                General
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('users')" 
                                class="w-full text-left  py-1 rounded-lg hover:bg-gray-100 font-medium">
                                User Management
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('notifications')" 
                                class="w-full text-left  py-1 rounded-lg hover:bg-gray-100 font-medium">
                                Notifications
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('preferences')" 
                                class="w-full text-left  py-1 rounded-lg hover:bg-gray-100 font-medium">
                                System Preferences
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('security')" 
                                class="w-full text-left  py-1 rounded-lg hover:bg-gray-100 font-medium text-red-500">
                                Security
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Main Settings Panel -->
                <div class="lg:col-span-4 bg-white rounded-lg shadow p-6">
                    
                    <!-- General Settings -->
                    <div id="general-section" class="settings-section">
                        <h3 class="text-xl font-semibold text-custom mb-4">General Settings</h3>

                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="systemName" class="block text-lg font-medium text-gray-700">System Name</label>
                                <input type="text" id="systemName" name="systemName" value="SwisaAgap"
                                    class="h-12 p-3 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-custom focus:ring-custom sm:text-lg">
                            </div>

                            <div>
                                <label for="email" class="block text-lg font-medium text-gray-700">Admin Email</label>
                                <input type="email" id="email" name="email" value="admin@swisaagap.com"
                                    class="h-12 p-3 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-custom focus:ring-custom sm:text-lg">
                            </div>

                            <div>
                                <label for="timezone" class="block text-lg font-medium text-gray-700">Timezone</label>
                                <select id="timezone" name="timezone"
                                    class="h-12 p-3 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-custom focus:ring-custom sm:text-lg">
                                    <option>Asia/Manila</option>
                                    <option>Asia/Singapore</option>
                                    <option>Asia/Tokyo</option>
                                    <option>America/New_York</option>
                                </select>
                            </div>

                            <div>
                                <label for="logo" class="block text-lg font-medium text-gray-700">System Logo</label>
                                <input type="file" id="logo" name="logo"
                                    class="mt-1 block w-full text-lg text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-lg file:font-semibold file:bg-custom file:text-white hover:file:bg-custom/80">
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2 bg-custom text-white rounded-lg shadow hover:bg-custom/90 transition">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- User Management -->
                    <div id="users-section" class="settings-section hidden">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-semibold text-custom">User Management</h3>
                            <button class="px-4 py-2 bg-custom text-white rounded-lg hover:bg-custom/90 transition">
                                + Add User
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full border rounded-lg">
                                <thead class="bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-lg font-semibold">Name</th>
                                        <th class="px-4 py-2 text-left text-lg font-semibold">Email</th>
                                        <th class="px-4 py-2 text-left text-lg font-semibold">Role</th>
                                        <th class="px-4 py-2 text-left text-lg font-semibold">Actions</th>
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
                        <h3 class="text-xl font-semibold text-custom mb-4">Notification Settings</h3>

                        <form action="#" method="POST" class="space-y-6">
                            @csrf

                            <!-- Email Notifications -->
                            <div>
                                <label class="block text-lg font-medium text-gray-700 mb-2">Email Notifications</label>
                                <div class="space-y-2">
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="email_new_user" class="rounded text-custom focus:ring-custom">
                                        <span class="text-lg text-gray-700">Notify me when a new user registers</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="email_system_updates" class="rounded text-custom focus:ring-custom">
                                        <span class="text-lg text-gray-700">System updates and maintenance alerts</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="email_security_alerts" class="rounded text-custom focus:ring-custom">
                                        <span class="text-lg text-gray-700">Critical security alerts</span>
                                    </label>
                                </div>
                            </div>

                            <!-- In-App Notifications -->
                            <div>
                                <label class="block text-lg font-medium text-gray-700 mb-2">In-App Notifications</label>
                                <div class="space-y-2">
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="inapp_new_messages" class="rounded text-custom focus:ring-custom">
                                        <span class="text-lg text-gray-700">New messages</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="inapp_activity" class="rounded text-custom focus:ring-custom">
                                        <span class="text-lg text-gray-700">User activity updates</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="inapp_announcements" class="rounded text-custom focus:ring-custom">
                                        <span class="text-lg text-gray-700">System announcements</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Push Notifications -->
                            <div>
                                <label class="block text-lg font-medium text-gray-700 mb-2">Push Notifications</label>
                                <div class="space-y-2">
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="push_enabled" class="rounded text-custom focus:ring-custom">
                                        <span class="text-lg text-gray-700">Enable push notifications</span>
                                    </label>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2 bg-custom text-white rounded-lg shadow hover:bg-custom/90 transition">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- System Preferences -->
                    <div id="preferences-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-custom mb-4">System Preferences</h3>

                        <form action="#" method="POST" class="space-y-6">
                            @csrf

                            <!-- Language -->
                            <div>
                                <label for="language" class="block text-lg font-medium text-gray-700">Default Language</label>
                                <select id="language" name="language"
                                    class="h-12 p-3 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-custom focus:ring-custom sm:text-lg">
                                    <option value="en" selected>English</option>
                                    <option value="fil">Filipino</option>
                                    <option value="jp">Japanese</option>
                                    <option value="es">Spanish</option>
                                </select>
                            </div>

                            <!-- Date Format -->
                            <div>
                                <label for="date_format" class="block text-lg font-medium text-gray-700">Date Format</label>
                                <select id="date_format" name="date_format"
                                    class="h-12 p-3 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-custom focus:ring-custom sm:text-lg">
                                    <option value="Y-m-d">YYYY-MM-DD (2025-08-30)</option>
                                    <option value="d-m-Y">DD-MM-YYYY (30-08-2025)</option>
                                    <option value="m/d/Y">MM/DD/YYYY (08/30/2025)</option>
                                </select>
                            </div>

                            <!-- Time Format -->
                            <div>
                                <label for="time_format" class="block text-lg font-medium text-gray-700">Time Format</label>
                                <select id="time_format" name="time_format"
                                    class="h-12 p-3 mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-custom focus:ring-custom sm:text-lg">
                                    <option value="24">24-hour (14:30)</option>
                                    <option value="12">12-hour (2:30 PM)</option>
                                </select>
                            </div>

                            <!-- Theme -->
                            <div>
                                <label class="block text-lg font-medium text-gray-700 mb-2">Theme</label>
                                <div class="space-y-2">
                                    <label class="flex items-center space-x-3">
                                        <input type="radio" name="theme" value="light" class="text-custom focus:ring-custom">
                                        <span class="text-lg text-gray-700">Light</span>
                                    </label>
                                    <label class="flex items-center space-x-3">
                                        <input type="radio" name="theme" value="dark" class="text-custom focus:ring-custom">
                                        <span class="text-lg text-gray-700">Dark</span>
                                    </label>
                                    <label class="flex items-center space-x-3">
                                        <input type="radio" name="theme" value="system" class="text-custom focus:ring-custom" checked>
                                        <span class="text-lg text-gray-700">Match System</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Pagination -->
                            <div>
                                <label for="pagination" class="h-12 p-3 block text-lg font-medium text-gray-700">Items per Page</label>
                                <select id="pagination" name="pagination"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-custom focus:ring-custom sm:text-lg">
                                    <option value="10">10 items</option>
                                    <option value="20" selected>20 items</option>
                                    <option value="50">50 items</option>
                                    <option value="100">100 items</option>
                                </select>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2 bg-custom text-white rounded-lg shadow hover:bg-custom/90 transition">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Security -->
                    <div id="security-section" class="settings-section hidden">
                        <h3 class="text-xl font-semibold text-red-500 mb-4">Security Settings</h3>

                        <form action="#" method="POST" class="space-y-6">
                            @csrf

                            <!-- Change Password -->
                            <div class="border-b pb-4">
                                <h4 class="text-lg font-semibold text-gray-800 mb-3">Change Password</h4>
                                <div class="space-y-3">
                                    <div>
                                        <label for="current_password" class="block text-lg font-medium text-gray-700">Current Password</label>
                                        <input type="password" id="current_password" name="current_password"
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-lg">
                                    </div>

                                    <div>
                                        <label for="new_password" class="block text-lg font-medium text-gray-700">New Password</label>
                                        <input type="password" id="new_password" name="new_password"
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-lg">
                                    </div>

                                    <div>
                                        <label for="confirm_password" class="block text-lg font-medium text-gray-700">Confirm New Password</label>
                                        <input type="password" id="confirm_password" name="confirm_password"
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-lg">
                                    </div>
                                </div>
                            </div>

                            <!-- Two-Factor Authentication -->
                            <div class="border-b pb-4">
                                <h4 class="text-lg font-semibold text-gray-800 mb-3">Two-Factor Authentication (2FA)</h4>
                                <p class="text-lg text-gray-600 mb-3">Enhance account security by requiring a verification code when signing in.</p>

                                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                                    <span class="text-lg text-gray-700">Enable 2FA</span>
                                    <label class="inline-flex relative items-center cursor-pointer">
                                        <input type="checkbox" name="two_factor" class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-red-500 peer-focus:ring-2 peer-focus:ring-red-400 transition"></div>
                                        <span class="ml-3 text-lg text-gray-500">Off / On</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Login Activity -->
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-3">Recent Login Activity</h4>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full border rounded-lg text-lg">
                                        <thead class="bg-gray-100 text-gray-700">
                                            <tr>
                                                <th class="px-4 py-2 text-left">Device</th>
                                                <th class="px-4 py-2 text-left">Location</th>
                                                <th class="px-4 py-2 text-left">IP Address</th>
                                                <th class="px-4 py-2 text-left">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-t">
                                                <td class="px-4 py-2">Chrome - Windows</td>
                                                <td class="px-4 py-2">Manila, PH</td>
                                                <td class="px-4 py-2">192.168.1.10</td>
                                                <td class="px-4 py-2">2025-08-29 09:15</td>
                                            </tr>
                                            <tr class="border-t">
                                                <td class="px-4 py-2">Safari - iPhone</td>
                                                <td class="px-4 py-2">Quezon City, PH</td>
                                                <td class="px-4 py-2">10.0.0.55</td>
                                                <td class="px-4 py-2">2025-08-28 20:47</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <div class="flex justify-end pt-4">
                                <button type="submit"
                                    class="px-6 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">
                                    Save Security Settings
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Other sections can be added here -->
                </div>
            </div>
        </div>
    </div>

    <!-- JS for Tabs -->
    <script>
        function showSection(section) {
            // Hide all sections
            document.querySelectorAll('.settings-section').forEach(el => el.classList.add('hidden'));

            // Show the clicked section
            document.getElementById(section + '-section').classList.remove('hidden');
        }
    </script>
@endsection
