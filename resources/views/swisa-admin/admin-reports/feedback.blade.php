<section id="feedback" class="report-section hidden" x-data="{ visible: 5 }">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <div>
            <h2 class="text-2xl font-bold text-[#2C6E49]">Customer Reviews</h2>
            <p class="text-gray-500 text-sm">See what customers are saying about your work</p>
        </div>
    </div>

    <!-- 3-COLUMN LAYOUT -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

        <!-- LEFT SIDE -->
        <div class="space-y-10">

            <!-- 2×2 STAT CARDS WITH MEMBERSHIP THEME -->
            <div class="grid grid-cols-2 gap-6">
                <!-- Avg Rating -->
                <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
                    <h3 class="text-[#2C6E49] font-bold">Average Rating</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ number_format($averageRating ?? 0, 1) }}</p>
                    <p class="text-xs text-gray-400 mt-1">Based on {{ $totalRatings }} reviews</p>
                </div>

                <!-- Total Reviews -->
                <div class="bg-white rounded-xl shadow p-4 border-t-4 border-yellow-500">
                    <h3 class="text-[#2C6E49] font-bold">Total Reviews</h3>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $totalRatings ?? 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">All submitted feedback</p>
                </div>

                <!-- 5-Star Reviews -->
                <div class="bg-white rounded-xl shadow p-4 border-t-4 border-blue-600">
                    @php
                        $fiveStarPercent = $totalRatings ? number_format(($starCounts[5] / $totalRatings) * 100, 0) : 0;
                    @endphp
                    <h3 class="text-[#2C6E49] font-bold">5-Star Reviews</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $fiveStarPercent }}%</p>
                    <p class="text-xs text-gray-400 mt-1">Percentage of 5-star ratings</p>
                </div>

                <!-- This Month -->
                <div class="bg-white rounded-xl shadow p-4 border-t-4 border-indigo-600">
                    <h3 class="text-[#2C6E49] font-bold">This Month</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">{{ number_format($averageRating, 1) }}</p>
                    <p class="text-xs text-gray-400 mt-1">Average rating this month</p>
                </div>
            </div>

            <!-- RATINGS BREAKDOWN -->
            <div class="bg-white rounded-xl shadow p-4 border-t-4 border-green-600">
                <h3 class="text-lg font-semibold text-[#2C6E49] mb-4">Ratings Breakdown</h3>

                @foreach (range(5,1) as $star)
                    @php
                        $percent = $totalRatings ? round(($starCounts[$star] / $totalRatings) * 100) : 0;
                    @endphp
                    <div class="flex items-center mb-3">
                        <span class="w-5 font-medium">{{ $star }}</span>
                        <svg class="w-4 h-4 text-yellow-400 mx-1" fill="currentColor">
                            <path d="M9.049 2.927c...z" />
                        </svg>
                        <div class="flex-1 h-3 bg-gray-200 rounded-full mx-3 overflow-hidden">
                            <div class="h-full bg-green-600 rounded-full" style="width: {{ $percent }}%"></div>
                        </div>
                        <span class="text-gray-700 text-sm">{{ $percent }}%</span>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- RIGHT SIDE (REVIEWS) -->
        <div class="md:col-span-2 space-y-4">

            @foreach ($feedbackList as $index => $fb)
            <div 
                class="bg-white rounded-xl shadow p-6 border-l-4 border-gray-300 transform transition-all duration-500 ease-out"
                x-show="visible > {{ $index }}"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-2 scale-95"
            >

                <!-- Header -->
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center font-bold text-green-700">
                        {{ strtoupper(substr($fb['user'], 0, 2)) }}
                    </div>

                    <div>
                        <p class="font-semibold text-gray-900 text-lg">{{ $fb['user'] }}</p>
                        <p class="text-xs text-gray-500">{{ $fb['date'] }}</p>
                    </div>
                </div>

                <!-- Rating -->
                <div class="flex mt-2 text-yellow-400">
                    @for ($i = 1; $i <= $fb['rating']; $i++)
                        <svg class="w-5 h-5" fill="currentColor">
                            <path d="M9.049 2.927c...z" />
                        </svg>
                    @endfor
                </div>

                <!-- Feedback -->
                <p class="text-gray-700 leading-relaxed">
                    {{ $fb['feedback'] }}
                </p>

            </div>
            @endforeach

            <!-- Load More Button -->
            <div class="text-center mt-4" x-show="visible < {{ count($feedbackList) }}">
                <button 
                    @click="visible += 5"
                    class="bg-btncolor text-white px-6 py-2 rounded-lg hover:bg-gray-300 transition"
                >
                    Load More
                </button>
            </div>

        </div>

    </div>

</section>

<!-- Alpine.js for interactivity -->
<script src="//unpkg.com/alpinejs" defer></script>
