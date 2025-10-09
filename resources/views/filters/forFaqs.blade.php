<!-- FAQ Management Controls -->

<div class="mb-4 pb-4 border-b border-gray-100">
    <div class="flex justify-end items-center gap-3">

        <!-- Search Bar -->
        <div class="relative w-full sm:w-96">
            <input type="text" id="faq-search" placeholder="Search FAQs..." 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary text-sm sm:text-base">
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-3.85z"/>
            </svg>
        </div>


<!-- Add FAQ Button -->
<button id="add-faq-button" 
    class="px-4 py-2 bg-btncolor text-white font-medium rounded-lg shadow-md hover:bg-green-400 transition duration-150 flex items-center text-sm sm:text-base
    {{ Auth::user()->role_id == 2 ? 'opacity-50 cursor-not-allowed hover:bg-btncolor' : '' }}">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
    </svg>
    Add New FAQ
</button>

    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", () => {
    const addBtn = document.getElementById("add-faq-button");
    const adminModal = document.getElementById("admin-only-modal");
    const closeBtns = [document.getElementById("close-admin-modal"), document.getElementById("close-admin-modal-2")];
    const faqModal = document.getElementById("faq-modal");
    const cancelFaqBtn = document.getElementById("cancel-faq-button");

    addBtn.addEventListener("click", () => {
        @if(Auth::user()->role_id == 2)
            // Show "only admins" modal for support staff
            adminModal.classList.remove("hidden");
        @else
            // Show actual Add FAQ modal for admins
            faqModal.classList.remove("hidden");
        @endif
    });

    // Close admin modal
    closeBtns.forEach(btn => {
        btn.addEventListener("click", () => adminModal.classList.add("hidden"));
    });

    // Close FAQ modal
    cancelFaqBtn.addEventListener("click", () => faqModal.classList.add("hidden"));
    faqModal.addEventListener("click", (e) => {
        if (e.target === faqModal) faqModal.classList.add("hidden");
    });
});
</script>