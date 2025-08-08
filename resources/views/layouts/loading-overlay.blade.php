<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-30 z-[9999] flex items-center justify-center">
    <div class="flex flex-col items-center">
        <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
            </path>
        </svg>
        <p class="mt-3 text-white font-semibold text-lg">Loading...</p>
    </div>
</div>

<script>
    function showLoadingOverlay() {
        document.getElementById("loadingOverlay").style.display = "flex";
    }

    function hideLoadingOverlay() {
        document.getElementById("loadingOverlay").style.display = "none";
    }

    // Show immediately on DOM load
    document.addEventListener("DOMContentLoaded", function () {
        showLoadingOverlay();
    });

    // Hide 3 seconds AFTER the page fully loads
    window.addEventListener("load", function () {
        setTimeout(function () {
            hideLoadingOverlay();
        }, 3000); // 3000ms = 3 seconds
    });
</script>
