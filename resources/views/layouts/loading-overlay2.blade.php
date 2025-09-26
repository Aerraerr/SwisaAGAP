<!-- Loading Overlay for Button Click -->
<div id="loadingOverlayBtn" class="fixed inset-0 bg-white bg-opacity-100 z-[9999] flex items-center justify-center hidden">
    <div class="flex flex-col items-center">
        <svg class="animate-spin h-10 w-10 text-[#2C6E49]" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
        <p class="mt-3 text-[#2C6E49] font-semibold text-lg">Loading...</p>
    </div>
</div>
<script>
    function showLoadingOverlayBtn() {
        document.getElementById("loadingOverlayBtn").classList.remove("hidden");

        // Auto hide after 1s (optional)
        setTimeout(() => {
            hideLoadingOverlayBtn();
        }, 1000);
    }

    function hideLoadingOverlayBtn() {
        document.getElementById("loadingOverlayBtn").classList.add("hidden");
    }
</script>
