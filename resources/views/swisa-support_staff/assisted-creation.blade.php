@extends('layouts.app')
@section('content')
<div class="p-4">
    <div class="bg-mainbg px-2">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
        <div class="text-customIT flex flex-col">
            <h2 class="text-[20px] sm:text-[25px] font-bold text-custom">Assist Member</h2>
        </div>
        @include('components.UserTab')
    </div>

    <div class="grid grid-cols-12 gap-2">
        <div class="col-span-9 flex bg-white shadow-lg rounded-md h-[30vh] p-3">
            <div class="bg-gray-200 h-[25vh] w-1/5">
                <p class="text-white text-center py-16">Image</p>
            </div>
            <div class="w-4/5 p-4">
                <p class="text-md text-bsctxt font-medium">“The Assisted Registration feature allows Support Staff to create member accounts on behalf of individuals who do not have access to devices, ensuring that every farmer can participate in the system.”</p>
            </div>
        </div>
        <div class="col-span-3 bg-white shadow-lg rounded-md p-3 text-center">
            <div class="p-4 mb-2">
                <p class="text-md text-bsctxt font-medium">“Assist those who don't have any device”</p>
            </div>
            <button onclick="openModal('assistRegisterModal')" class="bg-white border border-btncolor rounded-md shadow hover:bg-btncolor hover:text-white py-1 px-8">Create</button>
            <hr class="font-light my-2">
            <p class="text-xs text-bsctxt font-light">Got any questions? <a href="#" class="hover:text-customIT">click here</a></p>
        </div>
    </div>
    
    <div x-data="{ activeTab: 'list' }" class="mt-4">

        @include('components.filters')

        {{--<div x-show="activeTab === 'grid'" class="pt-2 bg-gray-100 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
            <!-- Card with specific data -->
            @for($i = 0; $i < 10; $i++)
                <x-cards.giveback-card
                name="Pangkagkag ni Peter"
                role="Machinery"
                cont_type="090909090"
                cont_quantity="To be review"
                cont_source="Ron Peter Mortega"
                cont_date="24 July 2025"
                status="24 Aug 2025"
            />
            @endfor
        </div>--}}

        <!-- for table/list front -->
        <div x-show="activeTab === 'list'" class="tab-pane">
                <div class="overflow-auto h-auto shadow-lg">
                    <table class="min-w-full bg-white border-spacing-y-1">
                    <thead class="bg-snbg border border-gray-100 px-8">
                        <tr class="text-customIT text-left ">
                            <th class="px-4 py-3 text-xs font-medium">NAME</th>
                            <th class="px-4 py-3 text-xs font-medium">NUMBER</th>
                            <th class="px-4 py-3 text-xs font-medium">EMAIL</th>
                            <th class="px-4 py-3 text-xs font-medium">DATE CREATED</th>
                            <th class="px-4 py-3 text-xs font-medium">MEMBER TYPE</th>
                            <th class="px-4 py-3 text-xs font-medium">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i <= 10; $i++): ?>
                        <tr class="border border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">Ron Peter Mortega</td>
                            <td class="px-4 py-2 text-sm text-gray-700">0909090090090</td>
                            <td class="px-4 py-2 text-sm text-gray-700">rpm@gmail.com</td>
                            <td class="px-4 py-2 text-sm text-gray-700">25 Aug 2025</td>
                            <td class="px-4 py-2 text-sm text-gray-700">New: Basic</td>
                            <td class="pl-4 py-2 text-sm">
                                <div class="relative" x-data="{ show: false }" @click.away="show = false">
                                    <button @click="show = !show"  class="border border-gray-300 rounded-sm pl-2">
                                        <img src="{{ asset('images/dot-menu.svg') }}"
                                        class="w-5 h-5 rounded-sm mr-2"/>
                                    </button>
                                    <!-- The Popover Menu, controlled by Alpine.js -->
                                    <div x-show="show" 
                                    class="absolute top-full right-0 z-10 w-56 bg-white rounded-lg shadow-xl p-4 border border-gray-200 origin-top-right">
                                        <h3 class="text-md font-bold text-customIT mb-2">
                                            Choose an Action
                                        </h3>
                                        <p class="text-xs font-light text-bsctxt">Select an option to assist member</p>
                                        <div class="border-t border-gray-200 py-2">
                                            <ul class="space-y-2">
                                                <li>
                                                    <button onclick="openModal('assistGrantRequestModal')"class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-gray-600 font-medium">Assisted Grant Request</button>
                                                </li>
                                                <li>
                                                    <button onclick="openModal('assistMembershipModal')" class="block px-4 py-2 text-xs rounded-md hover:bg-gray-100 transition-colors duration-200 text-gray-600 font-medium">Assisted Membership Application</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                    </table>
                </div>
        </div>
        @include('components.pagination')
    </div>
    @include('components.modals.assist-register')
    @include('components.modals.assist-membership')
    @include('components.modals.assist-grant-request')
</div>
</div>
@endsection
