<!-- User Management -->
<div id="users-section" class="settings-section hidden">

    <!-- Header with Search & Filter -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-3 md:space-y-0">
        <h3 class="text-xl font-semibold text-[#2C6E49]">User Management</h3>

        <div class="flex items-center space-x-3">
            <!-- Search -->
            <input type="text" id="userSearch" placeholder="Search user..."
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#2C6E49] focus:border-[#2C6E49] w-44 md:w-60">

            <!-- Filter -->
            <select id="roleFilter"
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#2C6E49] focus:border-[#2C6E49]">
                <option value="">All Roles</option>
                <option value="1">Member</option>
                <option value="2">Support Staff</option>
                <option value="3">Admin</option>
            </select>

            <!-- Pagination per page -->
            <select id="perPage"
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-[#2C6E49] focus:border-[#2C6E49]">
                <option value="10">10</option>
                <option value="30">30</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

            <!-- Add Button -->
            <button id="openAddUserModal"
                class="flex items-center space-x-2 cursor-pointer hover:text-[#2C6E49] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-gray-800 font-medium">Add Profile</span>
            </button>
        </div>
    </div>

    <!-- Logged In User -->
    <p class="text-sm font-medium text-gray-600 mb-2">Logged In as</p>
    <div
        class="bg-white p-4 rounded-lg shadow-md mb-8 flex flex-col md:flex-row items-center md:items-start space-y-3 md:space-y-0 md:space-x-5 border border-gray-300">
        <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
            class="w-20 h-20 rounded-full border border-gray-400">
        <div class="flex-grow text-center md:text-left">
            <h2 class="text-lg font-semibold text-gray-800">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
            <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
            <div class="flex items-center justify-center md:justify-start space-x-2 mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span class="text-green-600 font-medium text-sm">Sync is on</span>
            </div>
        </div>
        <div class="flex items-center space-x-2 mt-2 md:mt-0">
            <button class="p-2 border rounded-full hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </button>
            <button class="px-3 py-1 border rounded-lg hover:bg-gray-100 text-sm transition">Sign out</button>
        </div>
    </div>

    <!-- Other Accounts -->
    <p class="text-sm font-medium text-gray-600 mb-3">Other Swisa Accounts</p>

    <div id="userList">
        @foreach($users as $user)
            <div
                class="user-card bg-white p-4 rounded-lg shadow-sm mb-3 flex flex-col md:flex-row items-center md:items-start space-y-3 md:space-y-0 md:space-x-5 border border-gray-300 transition">
                <img src="{{ asset('images/profile-user.png') }}" alt="Profile"
                    class="w-16 h-16 rounded-full border border-gray-400">
                <div class="flex-grow text-center md:text-left">
                    <h2 class="text-base font-semibold text-gray-800">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </h2>
                    <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                    <p class="text-xs text-[#2C6E49] mt-1 role-label" data-role="{{ $user->role_id }}">
                        @if($user->role_id == 3)
                            Super Admin
                        @elseif($user->role_id == 2)
                            Support Staff
                        @else
                            Member
                        @endif
                    </p>
                </div>
                <div class="flex items-center space-x-2 mt-2 md:mt-0">
                    <button class="p-2 border rounded-full hover:bg-gray-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button class="p-2 border rounded-full hover:bg-gray-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Controls -->
    <div id="paginationControls" class="flex justify-center items-center space-x-2 mt-4">
        <button id="prevPage" class="px-3 py-1 border rounded hover:bg-gray-100 text-sm">Previous</button>
        <span id="pageInfo" class="text-sm text-gray-700"></span>
        <button id="nextPage" class="px-3 py-1 border rounded hover:bg-gray-100 text-sm">Next</button>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="fixed z-1000 inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white w-full max-w-2xl rounded-xl shadow-lg p-8 relative">

            <h2 class="text-2xl font-semibold text-[#2C6E49] mb-6">Add New User</h2>

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Role -->
                    <div class="col-span-2">
                        <label class="block text-sm text-gray-700 font-medium" id="firstNameLabel">First Name</label>
                        <select name="role_id" id="role_id"
                            class="w-full border rounded-lg px-3 py-3 focus:ring-[#2C6E49] focus:border-[#2C6E49]">
                            <option value="1" selected>Member</option>
                            <option value="2">Support Staff</option>
                            <option value="3">Admin</option>
                        </select>
                    </div>

                    <!-- First Name -->
                    <div>
                        <label class="block text-sm text-gray-700 font-medium" id="firstNameLabel">First Name</label>
                        <input type="text" name="first_name" required
                            class="w-full border rounded-lg px-3 py-3 focus:ring-[#2C6E49] focus:border-[#2C6E49]">
                    </div>

                    <!-- Last Name / Location -->
                    <div>
                        <label class="block text-sm text-gray-700 font-medium" id="lastNameLabel">Last Name</label>
                        <input type="text" name="last_name" required
                            class="w-full border rounded-lg px-3 py-3 focus:ring-[#2C6E49] focus:border-[#2C6E49]">
                        <p class="text-xs text-gray-500 hidden" id="locationHint">Enter address, barangay, or location.</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm text-gray-700 font-medium">Email</label>
                        <input type="email" name="email" required
                            class="w-full border rounded-lg px-3 py-3 focus:ring-[#2C6E49] focus:border-[#2C6E49]">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label class="block text-sm text-gray-700 font-medium">Phone Number</label>
                        <input type="text" name="phone_number"
                            class="w-full border rounded-lg px-3 py-3 focus:ring-[#2C6E49] focus:border-[#2C6E49]">
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm text-gray-700 font-medium">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                class="w-full border rounded-lg px-3 py-3 pr-3 focus:ring-[#2C6E49] focus:border-[#2C6E49]">
                            <button type="button" onclick="togglePassword('password', this)"
                                class="absolute inset-y-0 right-2 flex items-center text-gray-600">👁️</button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm text-gray-700 font-medium">Confirm Password</label>
                        <div class="relative">
                            <input type="password" id="confirm_password" name="password_confirmation" required
                                class="w-full border rounded-lg px-3 py-3 pr-3 focus:ring-[#2C6E49] focus:border-[#2C6E49]">

                            <button type="button" onclick="togglePassword('confirm_password', this)"
                                class="absolute inset-y-0 right-2 flex items-center text-gray-600">👁️</button>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end space-x-3 mt-8">
                    <button type="button" id="closeAddUserModal"
                        class="px-5 py-2 rounded-lg border border-gray-400 hover:bg-gray-100">Cancel</button>

                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-[#2C6E49] text-white hover:bg-[#245a3b]">Create</button>
                </div>

            </form>

            <button id="closeModalBtn" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800 text-lg">✕</button>

        </div>
    </div>

</div>

<script>
    function togglePassword(id, btn) {
        const field = document.getElementById(id);
        field.type = field.type === 'password' ? 'text' : 'password';
    }

    // Modal logic
    document.getElementById('openAddUserModal').addEventListener('click', () =>
        document.getElementById('addUserModal').classList.remove('hidden')
    );
    document.getElementById('closeAddUserModal').addEventListener('click', () =>
        document.getElementById('addUserModal').classList.add('hidden')
    );
    document.getElementById('closeModalBtn').addEventListener('click', () =>
        document.getElementById('addUserModal').classList.add('hidden')
    );

    // Search, Filter & Pagination logic
    const searchInput = document.getElementById('userSearch');
    const roleFilter = document.getElementById('roleFilter');
    const perPageSelect = document.getElementById('perPage');
    const userCards = Array.from(document.querySelectorAll('.user-card'));
    const prevBtn = document.getElementById('prevPage');
    const nextBtn = document.getElementById('nextPage');
    const pageInfo = document.getElementById('pageInfo');

    let currentPage = 1;
    let filteredUsers = [...userCards];

    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRole = roleFilter.value;

        filteredUsers = userCards.filter(card => {
            const name = card.querySelector('h2').textContent.toLowerCase();
            const role = card.querySelector('.role-label').dataset.role;
            const matchName = name.includes(searchTerm);
            const matchRole = selectedRole === '' || selectedRole === role;
            return matchName && matchRole;
        });

        currentPage = 1;
        renderUsers();
    }

    function renderUsers() {
        const perPage = parseInt(perPageSelect.value);
        const totalUsers = filteredUsers.length;
        const totalPages = Math.ceil(totalUsers / perPage);

        userCards.forEach(card => card.style.display = 'none');
        const start = (currentPage - 1) * perPage;
        const end = start + perPage;
        filteredUsers.slice(start, end).forEach(card => card.style.display = 'flex');

        pageInfo.textContent = `Page ${currentPage} of ${totalPages || 1}`;
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages || totalPages === 0;
    }

    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderUsers();
        }
    });

    nextBtn.addEventListener('click', () => {
        const perPage = parseInt(perPageSelect.value);
        const totalPages = Math.ceil(filteredUsers.length / perPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderUsers();
        }
    });

    searchInput.addEventListener('input', filterUsers);
    roleFilter.addEventListener('change', filterUsers);
    perPageSelect.addEventListener('change', () => {
        currentPage = 1;
        renderUsers();
    });

    // Initialize
    filterUsers();

    // Dynamic label logic
    document.getElementById('role_id').addEventListener('change', function () {
        const firstNameLabel = document.getElementById('firstNameLabel');
        const lastNameLabel = document.getElementById('lastNameLabel');
        const locationHint = document.getElementById('locationHint');

        if (this.value == '2') { // Support Staff
            firstNameLabel.textContent = 'Name / Details';
            lastNameLabel.textContent = 'Location';
            locationHint.classList.remove('hidden');
        } else {
            firstNameLabel.textContent = 'First Name';
            lastNameLabel.textContent = 'Last Name';
            locationHint.classList.add('hidden');
        }
    });
</script>
