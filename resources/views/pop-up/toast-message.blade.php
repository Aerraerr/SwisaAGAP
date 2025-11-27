<!-- Toast Notification -->
<div id="toastMessage" 
     class="hidden fixed top-6 left-1/2 transform -translate-x-1/2 
            px-8 py-4 rounded-xl shadow-lg text-white text-lg font-bold 
            z-[2147483647] transition-all duration-500 opacity-0 scale-90">
</div>

<script>
    // Toast function (global so you can call it anywhere)
    function showToast(message, bgColor) {
        const toast = document.getElementById("toastMessage");
        toast.textContent = message;
        toast.classList.remove("hidden", "opacity-0", "scale-90");
        toast.classList.add(bgColor, "opacity-100", "scale-100");

        setTimeout(() => {
            toast.classList.add("opacity-0", "scale-90");
            setTimeout(() => {
                toast.classList.add("hidden");
                toast.classList.remove(bgColor); // reset bg color
            }, 500); // wait for transition to finish
        }, 2000); // visible for 2 seconds
    }
</script>
