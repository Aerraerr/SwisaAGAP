            <!-- 1ST CHARTS -->
            @include('charts.request-management')

            <div class="col-span-12 lg:col-span-3 lg:col-start-10 bg-white rounded-md shadow py-3 px-5">
                <h2 class="text-customIT text-md font-bold">Request Status Overview</h2>
                <div class="my-2">
                    <h2 class="font-semibold text-gray-600 text-xs">Cumulative Completed Request</h2>
                    <p class="font-semibold text-btncolor text-xl">1,000</p>
                </div>
                <div class="my-2">
                    <h2 class="font-semibold text-gray-600 text-xs">Cumulative Pending Request</h2>
                    <p class="font-semibold text-btncolor text-xl">1,000</p>
                </div>
                <div class="my-2">
                    <h2 class="font-semibold text-gray-600 text-xs">Cumulative Denied Request</h2>
                    <p class="font-semibold text-btncolor text-xl">1,000</p>
                </div>
                <hr class="mx-2 my-3">
                <div class="font-semibold text-btncolor text-center text-xs">
                    <a href="{{ route('logs')}}">View All Request Logs</a>
                </div>
            </div>