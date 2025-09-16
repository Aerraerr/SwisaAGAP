        <!-- Top Stats + Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-5 md:grid-cols-5 gap-2 mb-3">
            <!-- Stats Cards -->
            <div class="flex flex-col gap-2 lg:col-span-1">
                <!-- Total Session -->
                <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
                    <!-- Icon -->
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke-width="1.5" 
                            stroke="currentColor" 
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M6.75 3v2.25M17.25 3v2.25M3 8.25h18M4.5 
                                21h15a1.5 1.5 0 001.5-1.5V7.5a1.5 1.5 
                                0 00-1.5-1.5h-15A1.5 1.5 0 003 
                                7.5v12a1.5 1.5 0 001.5 1.5z" />
                        </svg>
                    </div>
                    <!-- Text -->
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Total Session</p>
                        <h3 class="text-xl font-bold text-customIT">123</h3>
                    </div>
                </div>
                
                <!-- Total Participants -->
                <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
                    <!-- Icon -->
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            viewBox="0 0 24 24" 
                            fill="currentColor" 
                            class="w-6 h-6">
                            <path fill-rule="evenodd" 
                                d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" 
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <!-- Text -->
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Total Participants</p>
                        <h3 class="text-xl font-bold text-customIT">123</h3>
                    </div>
                </div>

                <!-- Upcoming -->
                <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
                    <!-- Icon -->
                    <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke-width="1.5" 
                            stroke="currentColor" 
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M12 6v6l3 3m6-3a9 9 0 
                                11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <!-- Text -->
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Upcoming</p>
                        <h3 class="text-xl font-bold text-customIT">123</h3>
                    </div>
                    
                </div>

                <!-- dat btn ini -->
                <div class="bg-white shadow rounded-lg p-4 flex items-center gap-4">
                    <!-- Icon -->
                    <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke-width="1.5" 
                            stroke="currentColor" 
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M12 6v6l3 3m6-3a9 9 0 
                                11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <!-- Text -->
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Upcoming</p>
                        <h3 class="text-xl font-bold text-customIT">123</h3>
                    </div>
                    
                </div>
        </div>


        <!-- Charts -->
        <div class="lg:col-span-4 grid grid-cols-1 md:grid-cols-4 gap-2">
            <div class=" w-full bg-white shadow rounded-lg p-4 md:col-span-3 lg:grid-cols-3">
                <!-- Icon + Label -->
                <div class="flex items-center gap-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18M9 17V9m4 8v-4m4 4V5" />
                    </svg>
                    <h3 class="text-md font-semibold text-gray-700">Member Participation</h3>
                </div>

                                <!-- Chart -->
                <div class=" w-full">
                    <canvas id="memberParticipationChart" class="w-full h-[280px]"></canvas>
                </div>
            </div>




            <div class="bg-white shadow rounded-lg p-4 md:col-span-1 lg:grid-cols-1">
                <h3 class="text-md font-semibold mb-2 text-gray-700">Upcoming By Category</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-500">Organization Meeting</p>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-btncolor h-2 rounded-full" style="width:25%"></div>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Title 2</p>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-btncolor h-2 rounded-full" style="width:50%"></div>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Title 3</p>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-btncolor h-2 rounded-full" style="width:75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>