<section id="engagement" class="report-section">
    <h2 class="text-xl font-bold text-[#2C6E49] mb-4">Engagement Reports</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-2xl shadow p-4">
            <h3 class="text-gray-600">Average Event Attendance</h3>
            <p id="avgAttendance" class="text-3xl font-bold text-blue-600 mt-2">--%</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-4">
            <h3 class="text-gray-600">Total Registered Participants</h3>
            <p id="totalParticipants" class="text-3xl font-bold text-indigo-600 mt-2">--</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-4">
            <h3 class="text-gray-600">Total Checked-In Attendees</h3>
            <p id="totalCheckedIn" class="text-3xl font-bold text-green-600 mt-2">--</p>
        </div>

        <div class="bg-white rounded-2xl shadow p-4">
            <h3 class="text-gray-600">Most Attended Training</h3>
            <p id="topTrainingTitle" class="text-xl font-bold text-orange-600 mt-2">--</p>
            <p id="topTrainingCount" class="text-md text-gray-700"></p>
        </div>
    </div>
</section>

<script>
async function loadEngagementReports() {
    try {
        const response = await fetch('/reports/engagement');
        const data = await response.json();

        document.getElementById("avgAttendance").textContent = data.average_attendance + "%";
        document.getElementById("totalParticipants").textContent = data.total_participants;
        document.getElementById("totalCheckedIn").textContent = data.total_checked_in;

        if (data.top_training) {
            document.getElementById("topTrainingTitle").textContent = data.top_training.title;
            document.getElementById("topTrainingCount").textContent =
                data.top_training.participants + " attendees";
        } else {
            document.getElementById("topTrainingTitle").textContent = "No data";
            document.getElementById("topTrainingCount").textContent = "";
        }

        console.log(data.training_breakdown); // You can use this for detailed tables

    } catch (error) {
        console.error("Failed to load engagement reports:", error);
    }
}

// Call when section is visible
loadEngagementReports();
</script>
