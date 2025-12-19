
@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')

<style>
    /* Accordion Styles */
    .accordion-header {
        cursor: pointer;
        transition: background-color 0.2s ease;
        position: relative;
    }
    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease, padding 0.3s ease;
    }
    .accordion-open .accordion-content {
        padding-top: 1rem;
    }
    .accordion-icon {
        transition: transform 0.4s ease;
    }
    .accordion-open .accordion-icon {
        transform: rotate(180deg);
    }
    .shadow-soft {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    }
</style>

<!-- Page Wrapper -->
<div class="p-4 -mt-2">
    <div class="bg-mainbg px-4 min-h-screen w-full">
        
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">

        </div>
        @include('filters.forFaqs')
        <!-- Intro Header -->
        <header class="text-center py-12 mb-10 bg-gradient-to-r from-green-300 via-white to-green-300 rounded-xl shadow-md">
            <h1 class="text-4xl md:text-5xl font-extrabold text-green-800 tracking-tight">
                SWISA-AGAP Frequently Asked Questions
            </h1>
            <p class="mt-3 text-lg md:text-xl text-gray-700 max-w-2xl mx-auto">
                Find answers to common questions.
            </p>
        </header>

        <!-- =================================== -->
        <!-- ADMIN FAQ Grid -->
        <!-- =================================== --> 
        <div class="grid grid-cols-1 lg:grid-cols-10 gap-2">
            @if(Auth::user()->role_id == 3)
            <!-- Admin FAQs -->
            <div class="lg:col-span-4">
                <div class="bg-white p-6 rounded-xl shadow-lg h-full border-t-4 border-green-600">
                    <h2 class="text-2xl font-bold text-customIT mb-6 flex items-center">
                        <span class="material-icons text-secondary mr-3 text-[28px]">manage_accounts</span>
                        Admin FAQs
                    </h2>

                    @php $groupedFaqs = $adminFaqs->groupBy('type'); @endphp

                    @foreach($groupedFaqs as $type => $faqs)
                        <h3 class="text-lg font-semibold text-gray-700 mt-10 mb-3">{{ $type }}</h3>
                        <div class="space-y-6">
                            @foreach($faqs as $faq)
                                <div class="accordion bg-gray-50 rounded-lg overflow-hidden shadow-soft">
                                    <div class="accordion-header flex justify-between items-center p-4 bg-green-100 text-green-800 font-semibold hover:bg-green-200 transition-colors">
                                        <span>{{ $faq->question }}</span>
                                        <div class="flex items-center space-x-1">
                                            <!-- Edit Button -->
                                            <button class="edit-faq-btn w-5 h-5 text-gray-400 hover:text-gray-800"
                                                data-id="{{ $faq->id }}"
                                                data-question="{{ $faq->question }}"
                                                data-answer="{{ $faq->answer }}"
                                                data-type="{{ $faq->type }}"
                                                data-audience="{{ $faq->target_audience }}"
                                                title="Edit FAQ">
                                                <span class="material-icons text-[20px]">edit</span>
                                            </button>

                                            <!-- Delete Button -->
                                            <button type="button" 
                                                class="delete-faq-btn w-5 h-5 text-red-400 hover:text-red-800"
                                                data-id="{{ $faq->id }}"
                                                title="Delete FAQ">
                                                <span class="material-icons text-[20px]">delete</span>
                                            </button>

                                            <!-- Accordion Icon -->
                                            <svg class="accordion-icon w-5 h-5 text-secondary cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="accordion-content px-4 text-gray-600 bg-white">
                                        <p class="pb-4">{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Support Staff FAQs -->
            <div class="lg:col-span-3">
                <div class="bg-white p-6 rounded-xl shadow-lg h-auto border-t-4 border-yellow-500">
                    <h2 class="text-2xl font-bold text-yellow-600 mb-6 flex items-center">
                        <span class="material-icons text-secondary mr-3 text-[28px]">engineering</span>
                        Support Staff FAQs
                    </h2>

                    @php $groupedSupportFaqs = $supportFaqs->groupBy('type'); @endphp

                    @foreach($groupedSupportFaqs as $type => $faqs)
                        <h3 class="text-lg font-semibold text-gray-700 mt-10 mb-3">{{ $type }}</h3>
                        <div class="space-y-3">
                            @foreach($faqs as $faq)
                                <div class="accordion bg-gray-50 rounded-lg overflow-hidden shadow-soft">
                                    <div class="accordion-header flex justify-between items-center p-4 text-gray-800 font-semibold bg-yellow-100 hover:bg-yellow-200 transition-colors">
                                        <span>{{ $faq->question }}</span>
                                        <div class="flex items-center space-x-1">
                                            <!-- Edit Button -->
                                            <button class="edit-faq-btn w-5 h-5 text-gray-400 hover:text-gray-800"
                                                data-id="{{ $faq->id }}"
                                                data-question="{{ $faq->question }}"
                                                data-answer="{{ $faq->answer }}"
                                                data-type="{{ $faq->type }}"
                                                data-audience="{{ $faq->target_audience }}"
                                                title="Edit FAQ">
                                                <span class="material-icons text-[20px]">edit</span>
                                            </button>
                                            <!-- Delete Button -->
                                            <button type="button" 
                                                class="delete-faq-btn w-5 h-5 text-red-400 hover:text-red-800"
                                                data-id="{{ $faq->id }}"
                                                title="Delete FAQ">
                                                <span class="material-icons text-[20px]">delete</span>
                                            </button>
                                            <!-- Accordion Icon -->
                                            <svg class="accordion-icon w-5 h-5 text-secondary cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="accordion-content px-4 text-gray-600 bg-white">
                                        <p class="pb-4">{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- User FAQs -->
            <div class="lg:col-span-3">
                <div class="bg-white p-6 rounded-xl shadow-lg h-auto border-t-4 border-blue-500">
                    <h2 class="text-2xl font-bold text-blue-600 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        User FAQs
                    </h2>

                    @php $groupedUserFaqs = $userFaqs->groupBy('type'); @endphp

                    @foreach($groupedUserFaqs as $type => $faqs)
                        <h3 class="text-lg font-semibold text-gray-700 mt-10 mb-3">{{ $type }}</h3>
                        <div class="space-y-6">
                            @foreach($faqs as $faq)
                                <div class="accordion bg-gray-50 rounded-lg overflow-hidden shadow-soft">
                                    <div class="accordion-header flex justify-between items-center p-4 text-gray-800 font-semibold bg-blue-100 hover:bg-blue-200 transition-colors">
                                        <span>{{ $faq->question }}</span>
                                        <div class="flex items-center space-x-1">
                                            <!-- Edit Button -->
                                            <button class="edit-faq-btn w-5 h-5 text-gray-400 hover:text-gray-800"
                                                data-id="{{ $faq->id }}"
                                                data-question="{{ $faq->question }}"
                                                data-answer="{{ $faq->answer }}"
                                                data-type="{{ $faq->type }}"
                                                data-audience="{{ $faq->target_audience }}"
                                                title="Edit FAQ">
                                                <span class="material-icons text-[20px]">edit</span>
                                            </button>
                                            <!-- Delete Button -->
                                            <button type="button" 
                                                class="delete-faq-btn w-5 h-5 text-red-400 hover:text-red-800"
                                                data-id="{{ $faq->id }}"
                                                title="Delete FAQ">
                                                <span class="material-icons text-[20px]">delete</span>
                                            </button>
                                            <!-- Accordion Icon -->
                                            <svg class="accordion-icon w-5 h-5 text-secondary cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="accordion-content px-4 text-gray-600 bg-white">
                                        <p class="pb-4">{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>


        <!-- =================================== -->
        <!-- SUPPORT STAFF FAQ Grid -->
        <!-- =================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-2">
            {{-- Only show supp FAQs if user is admin --}}
            @if(Auth::user()->role_id == 2)
            <!-- Support-Staff FAQs -->
            <div class="lg:col-span-3">
                <div class="bg-white p-6 rounded-xl shadow-lg h-auto border-t-4 border-yellow-500">
                    <h2 class="text-2xl font-bold text-yellow-600 mb-6 flex items-center">
                        <span class="material-icons text-secondary mr-3 text-[28px]">engineering</span>
                        Support Staff FAQs
                    </h2>

                    @php
                        $groupedSupportFaqs = $supportFaqs->groupBy('type');
                    @endphp

                    @foreach($groupedSupportFaqs as $type => $faqs)
                        <h3 class="text-lg font-semibold text-gray-700 mt-10 mb-3">{{ $type }}</h3>
                        <div class="space-y-3">
                            @foreach($faqs as $faq)
                                <div class="accordion bg-gray-50 rounded-lg overflow-hidden shadow-soft">
                                    <div class="accordion-header flex justify-between items-center p-4 text-gray-800 font-semibold bg-yellow-100 hover:bg-yellow-200 transition-colors">
                                        <span>{{ $faq->question }}</span>
                                        <div class="flex items-center space-x-1">

                                            <svg class="accordion-icon w-5 h-5 text-secondary cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="accordion-content px-4 text-gray-600 bg-white">
                                        <p class="pb-4">{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- =================================== -->
        <!-- USER FAQ Grid -->
        <!-- =================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-10 gap-2">
            {{-- Only show Admin FAQs if user is admin --}}
            @if(Auth::user()->role_id == 1)

            <!-- User FAQs -->
            <div class="lg:col-span-3">
                <div class="bg-white p-6 rounded-xl shadow-lg h-auto border-t-4 border-blue-500">
                    <h2 class="text-2xl font-bold text-blue-500 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        User FAQs
                    </h2>
                    @php
                        $groupedFaqs = $userFaqs->groupBy('type');
                    @endphp

                    @foreach($groupedFaqs as $type => $faqs)
                        <h3 class="text-lg font-semibold text-gray-700 mt-10 mb-3">{{ $type }}</h3>
                            <div class="space-y-6">
                            @foreach($userFaqs as $faq)
                                <div class="accordion bg-gray-50 rounded-lg overflow-hidden shadow-soft">
                                    <div class="accordion-header flex justify-between items-center p-4 text-gray-800 font-semibold bg-blue-100 hover:bg-blue-200 transition-colors">
                                        <span>{{ $faq->question }}</span>
                                        <!-- Action + Dropdown Icons -->
                                        <div class="flex items-center space-x-1">

                                            <!-- Dropdown Icon -->
                                            <svg class="accordion-icon w-5 h-5 text-secondary cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="accordion-content px-4 text-gray-600 bg-white">
                                        <p class="pb-4">{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>


    </div>
</div>

<!-- ============================================================================================ -->
<!-- Edit FAQ Modal -->
<div id="edit-faq-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center p-6">
    <div class="bg-white rounded-xl w-full max-w-2xl shadow-2xl p-8 animate__animated animate__fadeIn">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-3xl font-bold text-customIT">Edit FAQ</h3>
            <button type="button" id="cancel-edit-faq-btn" class="text-gray-500 hover:text-gray-800 text-3xl font-bold">&times;</button>
        </div>

        <form id="edit-faq-form" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" id="edit-faq-id" name="id">

            <div>
                <label class="block text-base font-medium text-gray-700">Intended for</label>
                <select id="edit-faq-audience" name="target_audience" required class="mt-2 block w-full rounded-lg border-gray-300 p-3">
                    <option value="admin">Admin</option>
                    <option value="support-staff">Support Staff</option>
                    <option value="user">User</option>
                </select>
            </div>

            <div>
                <label class="block text-base font-medium text-gray-700">Category</label>
                <select id="edit-faq-type" name="type" required class="mt-2 block w-full rounded-lg border-gray-300 p-3">
                    <option value="General">General</option>
                    <option value="System Management">System Management</option>
                    <option value="Content Management">Content Management</option>
                    <option value="System Features">System Features</option>
                    <option value="Support & Troubleshooting">Support & Troubleshooting</option>
                    <option value="Policy & Guidelines">Policy & Guidelines</option>
                    <option value="Training & Knowledge">Training & Knowledge</option>
                </select>
            </div>

            <div>
                <label class="block text-base font-medium text-gray-700">Question</label>
                <input type="text" id="edit-faq-question" name="question" required class="mt-2 block w-full rounded-lg border-gray-300 p-3">
            </div>

            <div>
                <label class="block text-base font-medium text-gray-700">Answer</label>
                <textarea id="edit-faq-answer" name="answer" rows="6" required class="mt-2 block w-full rounded-lg border-gray-300 p-3"></textarea>
            </div>

            <div class="flex justify-end space-x-4 pt-3">
                <button type="button" id="cancel-edit-faq-btn-2" class="px-5 py-3 bg-gray-200 rounded-lg hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-5 py-3 bg-secondary text-gray-900 rounded-lg hover:bg-secondary/80 shadow-md">Update FAQ</button>
            </div>
        </form>
    </div>
</div>


<!-- ============================================================================================ -->

<!-- ============================================================================================ -->
<!-- Delete FAQ Modal -->
<div id="delete-faq-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center p-6">
    <div class="bg-white rounded-xl w-full max-w-lg shadow-2xl p-8 animate__animated animate__fadeIn">

        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-3xl font-bold text-customIT">Delete FAQ</h3>
            <button type="button" id="cancel-delete-faq" class="text-gray-500 hover:text-gray-800 text-3xl font-bold">&times;</button>
        </div>

        <!-- Confirmation Text -->
        <p class="text-gray-700 mb-6 text-base">
            Are you sure you want to delete this FAQ?
        </p>
        <p class="font-medium text-gray-900 mb-6">
            <span id="delete-faq-question" class="italic"></span>
        </p>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <button type="button" id="cancel-delete-faq-2" 
                class="px-5 py-3 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition duration-150 font-medium text-base">
                Cancel
            </button>
            <form id="delete-faq-form" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete-faq-id" name="id">
                <button type="submit" 
                    class="px-5 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-150 font-medium shadow-md text-base">
                    Delete FAQ
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================================================ -->
<!-- Add FAQ Modal -->
<div id="faq-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center p-6">
    <div class="bg-white rounded-xl w-full max-w-2xl shadow-2xl p-8 animate__animated animate__fadeIn">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-3xl font-bold text-customIT">Add New FAQ</h3>
            <button type="button" id="cancel-faq-button" class="text-gray-500 hover:text-gray-800 text-3xl font-bold">&times;</button>
        </div>

        <form id="faq-form" method="POST" action="{{ route('faqs.store') }}" class="space-y-5">
            @csrf

            <!-- Target Audience -->
            <div>
                <label class="block text-base font-medium text-gray-700">Intended for</label>
                <select name="target_audience" required class="mt-2 block w-full rounded-lg border-gray-300 p-3">
                    <option value="">Select Audience</option>
                    <option value="admin">Admin</option>
                    <option value="support-staff">Support Staff</option>
                    <option value="user">User</option>
                </select>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-base font-medium text-gray-700">Category</label>
                <select name="type" required class="mt-2 block w-full rounded-lg border-gray-300 p-3">
                    <option value="">Select Category</option>
                    <option value="General">General</option>
                    <option value="System Management">System Management</option>
                    <option value="Content Management">Content Management</option>
                    <option value="System Features">System Features</option>
                    <option value="Support & Troubleshooting">Support & Troubleshooting</option>
                    <option value="Policy & Guidelines">Policy & Guidelines</option>
                    <option value="Training & Knowledge">Training & Knowledge</option>
                </select>
            </div>

            <!-- Question -->
            <div>
                <label class="block text-base font-medium text-gray-700">Question</label>
                <input type="text" name="question" required class="mt-2 block w-full rounded-lg border-gray-300 p-3" placeholder="Enter the FAQ question">
            </div>

            <!-- Answer -->
            <div>
                <label class="block text-base font-medium text-gray-700">Answer</label>
                <textarea name="answer" rows="6" required class="mt-2 block w-full rounded-lg border-gray-300 p-3" placeholder="Provide the detailed answer"></textarea>
            </div>

            <div class="flex justify-end space-x-4 pt-3">
                <button type="button" id="cancel-faq-button-2" class="px-5 py-3 bg-gray-200 rounded-lg hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-5 py-3 bg-secondary text-gray-900 rounded-lg hover:bg-secondary/80 shadow-md">Save FAQ</button>
            </div>
        </form>
    </div>
</div>
<!-- ============================================================================================ -->

<!-- Admin Only Modal -->
<div id="admin-only-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl w-full max-w-sm shadow-2xl p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Access Denied</h3>
            <button id="close-admin-modal" class="text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</button>
        </div>
        <p class="text-gray-700">Only administrators can manage FAQs.</p>
        <div class="flex justify-end mt-4">
            <button id="close-admin-modal-2" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500">OK</button>
        </div>
    </div>
</div>


<!-- FOR EDIT FAQs -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const editModal = document.getElementById("edit-faq-modal");
    const editForm = document.getElementById("edit-faq-form");
    const cancelBtns = [
        document.getElementById("cancel-edit-faq-btn"),
        document.getElementById("cancel-edit-faq-btn-2")
    ];

    // Open Edit Modal and populate data
    document.querySelectorAll(".edit-faq-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const question = btn.dataset.question;
            const answer = btn.dataset.answer;
            const type = btn.dataset.type || "General";
            const audience = btn.dataset.audience || "admin";

            document.getElementById("edit-faq-id").value = id;
            document.getElementById("edit-faq-question").value = question;
            document.getElementById("edit-faq-answer").value = answer;
            document.getElementById("edit-faq-type").value = type;
            document.getElementById("edit-faq-audience").value = audience;

            editModal.classList.remove("hidden");
        });
    });

    // Close modal
    cancelBtns.forEach(btn => btn.addEventListener("click", () => editModal.classList.add("hidden")));

    // Close when clicking outside
    editModal.addEventListener("click", e => {
        if (e.target === editModal) editModal.classList.add("hidden");
    });

    // Submit form
    editForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const faqId = document.getElementById("edit-faq-id").value;
        const formData = new FormData(editForm);
        formData.append('_method', 'PUT'); // method spoofing

        fetch(`/faq/${faqId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(res => res.ok ? location.reload() : alert('Failed to update FAQ'))
        .catch(err => console.error(err));
    });
});
</script>
<!-- FOR DELETE FAQs -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("delete-faq-modal");
    const cancelBtn1 = document.getElementById("cancel-delete-faq");
    const cancelBtn2 = document.getElementById("cancel-delete-faq-2");
    const deleteFaqQuestion = document.getElementById("delete-faq-question");
    const deleteFaqId = document.getElementById("delete-faq-id");
    const deleteForm = document.getElementById("delete-faq-form");

    document.querySelectorAll(".delete-faq-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            deleteFaqId.value = btn.dataset.id;
            deleteFaqQuestion.textContent = btn.dataset.question;
            deleteForm.action = `/faq/${btn.dataset.id}`; // make sure your route is correct

            modal.classList.remove("hidden");
        });
    });

    cancelBtn1.addEventListener("click", () => modal.classList.add("hidden"));
    cancelBtn2.addEventListener("click", () => modal.classList.add("hidden"));
});
</script>

<!-- FOR DROPDOWN ANNIMATION -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const accordions = document.querySelectorAll(".accordion");

        accordions.forEach((accordion) => {
            const header = accordion.querySelector(".accordion-header");
            const content = accordion.querySelector(".accordion-content");

            header.addEventListener("click", (e) => {
                // Prevent edit/delete buttons from toggling accordion
                if (e.target.closest("button")) return;

                if (accordion.classList.contains("accordion-open")) {
                    // Close smoothly
                    content.style.maxHeight = content.scrollHeight + "px"; // set to current height
                    requestAnimationFrame(() => {
                        content.style.maxHeight = "0";
                    });
                    accordion.classList.remove("accordion-open");
                } else {
                    // Open smoothly
                    content.style.maxHeight = content.scrollHeight + "px";
                    accordion.classList.add("accordion-open");

                    // Remove max-height after transition so content can resize naturally
                    content.addEventListener(
                        "transitionend",
                        () => {
                            if (accordion.classList.contains("accordion-open")) {
                                content.style.maxHeight = "none";
                            }
                        },
                        { once: true }
                    );
                }
            });
        });
    });
</script>
<!-- AJAX SUBMISSION - WARA LOADING -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const faqModal = document.getElementById("faq-modal");
    const cancelBtns = [document.getElementById("cancel-faq-button"), document.getElementById("cancel-faq-button-2")];

    // Example: open modal with a button
    document.getElementById("add-faq-button")?.addEventListener("click", () => {
        faqModal.classList.remove("hidden");
    });

    cancelBtns.forEach(btn => btn.addEventListener("click", () => {
        faqModal.classList.add("hidden");
    }));

    // Close when clicking outside
    faqModal.addEventListener("click", e => {
        if (e.target === faqModal) faqModal.classList.add("hidden");
    });
});

</script>
@endsection
