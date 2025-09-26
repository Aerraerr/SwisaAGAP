<div id="editAnnouncementModal-{{ $announcement->id}}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto z-20 h-full w-full flex items-center justify-center">
    <div class="relative w-full max-w-2xl mx-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <div class="items-center">
                <h2 class="text-3xl font-bold text-customIT">Edit Announcement</h2>
            </div>
            <div>
                <button onclick="closeModal('editAnnouncementModal-{{ $announcement->id}}')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>


        <!-- Modal Body: Add Announcement -->
         <!-- Add Form Fields -->
        <form action="{{ route('announcement.update', $announcement->id)}}" method="POST" 
            enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                        <label for="announcement_title" class="text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="announcement_title" id="announcement_title" value="{{ $announcement->title }}" class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent" required>
                    </div>

                    <div class="mb-4">
                        <label for="announcement_content" class="text-sm font-medium text-gray-700">Content</label>
                        <textarea name="announcement_content" id="announcement_content" rows="4" class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent" required>{{ $announcement->message }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="announcement_files" class="text-sm font-medium text-gray-700">Attach Files / Images</label>
                        <div class="flex space-x-2">
                            @if($announcement->documents->first())
                            <img src="{{ asset('storage/' . $announcement->documents->first()->file_path) }}" 
                                class="w-32 h-32 object-cover rounded-md mb-2">
                            @endif
                            <div class="w-full">
                                <input type="file" name="announcement_files" accept="image/*"
                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                                <p class="text-right text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG (Max 10MB)</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="announcement_audience" class="text-sm font-medium text-gray-700">Audience</label>
                            <select name="announcement_audience" id="announcement_audience" class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent">
                                @foreach(\App\Models\Announcement::AUDIENCE as $audience)
                                    <option value="{{ $audience }}">{{ $audience }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="announcement_status" class="text-sm font-medium text-gray-700">Status</label>
                            <select name="announcement_status" id="announcement_status" class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ $announcement->status_id == $status->id ? 'selected' : '' }}>
                                        {{ $status->status_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="announcement_start" class="text-sm font-medium text-gray-700">Visible From</label>
                            <input type="date" name="announcement_start" id="announcement_start"
                            value="{{ $announcement->posted_at ? $announcement->posted_at->format('Y-m-d') : '' }}" class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent" required/>
                        </div>
                        <div>
                            <label for="announcement_end" class="text-sm font-medium text-gray-700">Visible Until</label>
                            <input type="date" name="announcement_end" id="announcement_end" class="w-full border rounded-md px-3 py-2 text-sm mt-1 focus:ring-2 focus:ring-customIT focus:border-transparent" />
                        </div>
                    </div>

            <!-- modal footer -->
            <div class="text-right px-4 py-3">
                <button type="button" onclick="closeModal('editAnnouncementModal-{{ $announcement->id}}')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
                    Cancel
                </button>
                <button type="submit" class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
