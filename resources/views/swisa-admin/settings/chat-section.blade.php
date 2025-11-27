<!-- Chat Settings -->
<div id="chat-section" class="settings-section hidden">

    <style>
        /* Modal animations + modern look */
        #qr-modal .modal-content {
            animation: fadeInScale 0.25s ease-out;
        }
        @keyframes fadeInScale {
            0% { transform: scale(0.95); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>

    <h3 class="text-2xl font-bold text-[#2C6E49] mb-4">Chat Settings</h3>
    <p class="text-gray-600 text-sm mb-6">Manage system chat options and quick replies.</p>

    <!-- Quick Replies Header -->
    <div class="flex justify-between items-center bg-white shadow-md border rounded-lg p-4 mb-4">
        <div>
            <p class="font-semibold text-gray-800">Quick Replies</p>
            <p class="text-sm text-gray-500">Create, edit, or remove predefined replies for faster responses.</p>
        </div>
        <button onclick="openAddModal()" 
            class="px-4 py-2 bg-[#4C956C] text-white font-medium rounded-lg hover:bg-[#3d7e59] transition">
            Add New
        </button>
    </div>

    <!-- Quick Replies Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#4C956C] bg-opacity-90">
                <tr>
                    <th class="px-6 py-3 text-left text-md font-medium text-white">Question</th>
                    <th class="px-6 py-3 text-left text-md font-medium text-white">Answer</th>
                    <th class="px-6 py-3 text-left text-md font-medium text-white">Role</th>
                    <th class="px-6 py-3 text-left text-md font-medium text-white">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

                @foreach($quickReplies ?? [] as $qr)
                <tr>
                    <td class="px-6 py-4">{{ $qr->question }}</td>
                    <td class="px-6 py-4 break-words max-w-xs">{{ $qr->answer }}</td>

                    <td class="px-6 py-4">{{ $qr->role?->role_name ?? 'All' }}</td>

                    <td class="px-6 py-4 flex gap-2">
                        <!-- FIXED EDIT BUTTON -->
                        <button
                            class="px-3 py-1 bg-[#4C956C] text-white rounded hover:bg-gray-200 transition"
                            data-id="{{ $qr->id }}"
                            data-question="{{ $qr->question }}"
                            data-answer="{{ $qr->answer }}"
                            data-role="{{ $qr->for_role_id }}"
                            onclick="openEditModal(this)"
                        >
                            Edit
                        </button>

                        <form action="{{ route('quickreplies.destroy', $qr->id) }}" method="POST" 
                              onsubmit="return confirm('Delete this quick reply?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <!-- Add/Edit Modal -->
    <div id="qr-modal" class="fixed inset-0 bg-black bg-opacity-40 backdrop-blur-sm flex items-center justify-center hidden z-50">

        <div class="modal-content bg-white rounded-xl shadow-2xl w-full h-[600px] max-w-3xl p-6 relative flex flex-col">

            <!-- Close Button -->
            <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <h3 class="text-2xl font-semibold mb-5 text-[#2C6E49]" id="modal-title">Add Quick Reply</h3>

            <form id="qr-form" method="POST" class="flex flex-col h-full">
                @csrf

                <!-- Question -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Question</label>
                    <input type="text" name="question" id="qr-question"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-[#4C956C] focus:border-[#4C956C]"
                        required>
                </div>

                <!-- Answer -->
                <div class="flex-1 mb-4 flex flex-col">
                    <label class="block text-sm font-medium text-gray-700">Answer</label>
                    <textarea name="answer" id="qr-answer"
                        class="mt-1 block w-full h-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-[#4C956C] focus:border-[#4C956C] resize-none overflow-y-auto"
                        placeholder="Enter the reply..."
                        required></textarea>
                </div>

                <!-- Role -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Role (optional)</label>
                    <select name="for_role_id" id="qr-role"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-[#4C956C] focus:border-[#4C956C]">
                        <option value="">All</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-[#4C956C] text-white rounded-lg hover:bg-[#3d7e59] transition"
                        id="modal-submit-btn">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>



    <script>
        function openAddModal() {
            document.getElementById('modal-title').innerText = "Add Quick Reply";
            const form = document.getElementById('qr-form');
            form.action = "{{ route('quickreplies.store') }}";
            form.method = "POST";

            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();

            document.getElementById('qr-question').value = "";
            document.getElementById('qr-answer').value = "";
            document.getElementById('qr-role').value = "";

            document.getElementById('qr-modal').classList.remove('hidden');
        }

        // 🌟 FIXED: SAFELY LOAD LONG TEXT USING data-* ATTRIBUTES
        function openEditModal(button) {
            document.getElementById('modal-title').innerText = "Edit Quick Reply";

            const id = button.dataset.id;
            const question = button.dataset.question;
            const answer = button.dataset.answer;
            const role_id = button.dataset.role;

            const form = document.getElementById('qr-form');
            form.action = "/settings/chat/quick-replies/" + id;
            form.method = "POST";

            if (!form.querySelector('input[name="_method"]')) {
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                form.appendChild(methodInput);
            }

            // Fill modal fields
            document.getElementById('qr-question').value = question;
            document.getElementById('qr-answer').value = answer;
            document.getElementById('qr-role').value = role_id ?? "";

            document.getElementById('qr-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('qr-modal').classList.add('hidden');
        }
    </script>

</div>
