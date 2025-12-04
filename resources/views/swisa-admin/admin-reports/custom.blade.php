<section id="custom" class="report-section hidden">
    <h2 class="text-xl font-bold text-[#2C6E49] mb-4">Custom Reports</h2>
    <div class="bg-white rounded-2xl shadow p-4">
        <p class="text-gray-600 mb-4">Generate your own custom report by selecting filters and exporting the data.</p>

        <!-- Report Options -->
        <form id="customReportForm" class="space-y-3">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="reports" value="membership" class="h-4 w-4 text-green-600">
                <span>Membership Report</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="reports" value="requests" class="h-4 w-4 text-green-600">
                <span>Requests Report</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="reports" value="financial" class="h-4 w-4 text-green-600">
                <span>Financial Report</span>
            </label>
           {{-- <label class="flex items-center space-x-2">
                <input type="checkbox" name="reports" value="communication" class="h-4 w-4 text-green-600">
                <span>Communication Report</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="reports" value="engagement" class="h-4 w-4 text-green-600">
                <span>Engagement Report</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="reports" value="performance" class="h-4 w-4 text-green-600">
                <span>Performance Report</span>
            </label>--}}
        </form>

        <!-- Button -->
        <button 
            onclick="generateCustomReport()" 
            class="bg-btncolor hover:bg-green-700 text-white px-4 py-2 rounded mt-4 w-full">
            Generate Report
        </button>
    </div>
</section>

<script>
function generateCustomReport() {
    const selected = Array.from(document.querySelectorAll('#customReportForm input[name="reports"]:checked'))
                          .map(el => el.value);

    if (selected.length === 0) {
        alert("Please select at least one report to generate.");
        return;
    }

    // Example: display selected reports
    alert("Generating report(s) for: " + selected.join(", "));

    // You can replace this with your export/download logic
    console.log("Selected Reports:", selected);
}
</script>
