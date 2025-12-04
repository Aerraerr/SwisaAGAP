<x-guest-layout>
    <style>
        body {
            background: linear-gradient(-45deg, #2C6E49, #e0f2f1, #B2D6D3, #2f8f4e);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
            margin: 0;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .curved-bg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 200px;
            background: rgba(255, 255, 255, 0.6);
            border-top-left-radius: 50% 150px;
            border-top-right-radius: 50% 150px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(15px);
            z-index: 0;
        }

        @media (min-width: 640px) {
            .curved-bg {
                height: 300px;
                border-top-left-radius: 50% 250px;
                border-top-right-radius: 50% 250px;
            }
        }

        .page-content {
            animation: fadeSlideUp 0.8s ease-out forwards;
        }

        .swisa-logo {
            animation: popUp 0.9s ease-out forwards;
        }

        @keyframes fadeSlideUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes popUp {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>

    <div class="relative min-h-screen flex flex-col items-center justify-center bg-light-green p-4 sm:p-6">

        <!-- SWISA Main Logo -->
        <div class="absolute -top-2 flex justify-center w-full z-20">
            <img src="{{ asset('images/swisamain.png') }}" alt="SWISA Main Logo" 
                 class="w-[110px] h-[110px] sm:w-[120px] sm:h-[120px] object-contain">
        </div>

        <div class="curved-bg"></div>

        <!-- Verification Card -->
        <div class="z-10 w-full max-w-md bg-white shadow-xl rounded-xl overflow-hidden page-content p-6">
            
            <!-- Logo -->
            <div class="flex justify-center mt-6 swisa-logo">
                <div class="w-[100px] h-[100px] sm:w-[120px] sm:h-[120px]">
                    <img src="{{ asset('images/swisa-logo2.png') }}" alt="SWISA Logo" 
                         class="w-full h-full object-contain rounded-full">
                </div>
            </div>

            <!-- Header -->
            <div class="text-center -mt-3 sm:-mt-5 mb-4">
                <h1 class="font-poppins text-[#2C6E49] text-xl sm:text-2xl font-bold">Verify Your Email</h1>
                <p class="font-poppins text-[#2C6E49] text-sm">
                    Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed you. 
                    If you didn’t receive the email, we will gladly send you another.
                </p>
            </div>

            <!-- Status -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            <!-- Centered Button -->
            <div class="mt-6 flex justify-center">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="bg-[#2f8f4e] hover:bg-green-accent-green text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                        Resend Verification Email
                    </x-primary-button>
                </form>
            </div>
            <div class="mt-6 flex justify-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                        class="w-full sm:w-auto underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Quit
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
