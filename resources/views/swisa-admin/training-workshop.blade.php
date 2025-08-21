@extends('layouts.sidebar')
@section('content')
<body class="bg-mainbg px-2">
    <div class="text-customIT text-2xl flex justify-between items-center mb-4">
        <h1 class="font-bold">Available Trainings & Workshops</h1>
        <h1>Monday, 00 Month 2025</h1>
    </div>

        <div class="flex mb-2 gap-1">
            <button onclick="toggleModal('upload-modal')" class="active:bg-btncolor active:text-white active:shadow hover:bg-btncolor hover:text-white w-[80px] text-xs text-btncolor font-semibold rounded-[3px] p-1">Grid</button>
            <button onclick="toggleModal('upload-modal')" class="active:bg-btncolor active:text-white active:shadow hover:bg-btncolor hover:text-white w-[80px] text-xs text-btncolor font-semibold rounded-[3px] p-1">List</button>
            <button onclick="toggleModal('upload-modal')" class="bg-btncolor w-[50px] text-white border rounded-[3px] ml-[38%] p-1">&#43;</button>
            <div class="relative w-[180px]">
                <select id="#" class=" h-9 pl-3 w-full text-xs text-white bg-btncolor border rounded-[3px]">
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Sort</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Sort</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Sort</option>
                </select>
                <div class=" justify-between pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                    <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.05 6.884 4.636 8.3L9.293 12.95z" />
                    </svg>
                </div>
            </div>
            <div class="relative w-[180px]">
                <select id="#" class="h-9 pl-3 w-full text-xs text-white bg-btncolor border rounded-[3px]">
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                    <option class="bg-white text-gray-800 hover:bg-gray-200" value="">Category</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 6.05 6.884 4.636 8.3L9.293 12.95z" />
                </svg>
                </div>
            </div>
            <div class="relative flex-grow flex items-center shadow-lg rounded-lg">
                <input type="text" placeholder="Search here" class="w-full h-9 bg-white text-xs text-gray-700 px-4 border-1.5 rounded-l-[3px] focus:outline-none">
                <button class="bg-btncolor text-white p-2 rounded-r-lg hover:bg-customIT transition duration-300 ease-in-out h-9 w-9">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.35-1.42 1.42-5.35-5.35zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                </svg>
                </button>
            </div>
        </div>

    <!-- Example of using the reusable component -->
    <div class="pt-2 bg-gray-100 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
        <!-- Card with specific data -->
        <x-training-card
            title="Pangkagkag ni Peter"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            description="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            attendees="24"
        />
        <x-training-card
            title="Pangkagkag ni Peter"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            description="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            attendees="24"
        />
        <x-training-card
            title="Pangkagkag ni Peter"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            description="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            attendees="24"
        />
        <x-training-card
            title="Pangkagkag ni Peter"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            description="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            attendees="24"
        />
        <x-training-card
            title="Pangkagkag ni Peter"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            description="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            attendees="24"
        />
        <x-training-card
            title="Pangkagkag ni Peter"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            description="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            attendees="24"
        />
        <x-training-card
            title="Pangkagkag ni Peter"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            description="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            attendees="24"
        />
        <x-training-card
            title="Pangkagkag ni Peter"
            category="farmvile"
            date="sept 20, 2025"
            time="9:00 am"
            description="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
            attendees="24"
        />

        
    </div>

</body>
@endsection
