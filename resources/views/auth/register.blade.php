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

    /* Curved white overlay */
.curved-bg {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 200px;
    background: rgba(255, 255, 255, 0.6); /* semi-transparent white */
    border-top-left-radius: 50% 150px;
    border-top-right-radius: 50% 150px;
    backdrop-filter: blur(10px); /* blur the background behind */
    -webkit-backdrop-filter: blur(15px); /* Safari support */
    z-index: 0;
}

    @media (min-width: 640px) {
        .curved-bg {
            height: 300px;
            border-top-left-radius: 50% 250px;
            border-top-right-radius: 50% 250px;
        }
    }

    /* Animations */
    @keyframes fadeSlideUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes popUp {
        0% { transform: scale(0.8); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    .page-content {
        animation: fadeSlideUp 0.8s ease-out forwards;
    }

    .swisa-logo {
        animation: popUp 0.9s ease-out forwards;
    }
    </style>

<div class="relative min-h-screen flex flex-col items-center justify-center bg-light-green p-4 sm:p-6">

    <!-- SWISA Main Logo outside the card -->
    <div class="absolute -top-2 flex justify-center w-full z-20">
        <img src="{{ asset('images/swisamain.png') }}" alt="SWISA Main Logo" 
             class="w-[110px] h-[110px] sm:w-[120px] sm:h-[120px] object-contain">
    </div>

        <!-- Curved background -->
        <div class="curved-bg"></div>

        <!-- Register Card -->
        <div class="z-10 w-full max-w-md bg-white shadow-xl rounded-xl overflow-hidden page-content">
            
            <!-- Logo -->
            <div class="flex justify-center mt-6 swisa-logo">
                <div class="w-[100px] h-[100px] sm:w-[120px] sm:h-[120px]">
                    <img src="{{ asset('images/swisa-logo2.png') }}" alt="SWISA Logo" 
                         class="w-full h-full object-contain rounded-full">
                </div>
            </div>

            <!-- Welcome text -->
            <div class="text-center -mt-3 sm:-mt-5 page-content">
                <h1 class="font-poppins text-[#2C6E49] text-xl sm:text-2xl font-bold">Create Account</h1>
                <p class="font-poppins text-[#2C6E49] text-sm">Join us and be part of SWISA</p>
            </div>

            <!-- Form -->
            <div class="p-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!--First Name -->
                    <label for="first_name" class="block mb-2 text-sm font-medium text-[#2C6E49]">First Name</label>
                    <input id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name"
                        class="border border-gray text-[#2C6E49] text-sm rounded-lg focus:ring-[#2f8f4e] focus:border-[#2f8f4e] block w-full p-2.5 mb-4 bg-transparent"
                        placeholder="Lebron">
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-sm text-red-500" />

                    <!--Middle Name -->
                    <label for="middle_name" class="block mb-2 text-sm font-medium text-[#2C6E49]">Middle Name</label>
                    <input id="middle_name" type="text" name="middle_name" :value="old('middle_name')" autocomplete="additional-name"
                        class="border border-gray text-[#2C6E49] text-sm rounded-lg focus:ring-[#2f8f4e] focus:border-[#2f8f4e] block w-full p-2.5 mb-4 bg-transparent"
                        placeholder="Raymon">
                    <x-input-error :messages="$errors->get('middle_name')" class="mt-2 text-sm text-red-500" />

                    <!--Last Name -->
                    <label for="last_name" class="block mb-2 text-sm font-medium text-[#2C6E49]">Last Name</label>
                    <input id="last_name" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name"
                        class="border border-gray text-[#2C6E49] text-sm rounded-lg focus:ring-[#2f8f4e] focus:border-[#2f8f4e] block w-full p-2.5 mb-4 bg-transparent"
                        placeholder="James">
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-sm text-red-500" />

                    <!--Suffix -->
                    <label for="suffix" class="block mb-2 text-sm font-medium text-[#2C6E49]">Suffix</label>
                    <input id="suffix" type="text" name="suffix" :value="old('suffix')" autocomplete="honorific-suffix"
                        class="border border-gray text-[#2C6E49] text-sm rounded-lg focus:ring-[#2f8f4e] focus:border-[#2f8f4e] block w-full p-2.5 mb-4 bg-transparent"
                        placeholder="Sr">
                    <x-input-error :messages="$errors->get('suffix')" class="mt-2 text-sm text-red-500" />

                    <!-- Email -->
                    <label for="email" class="block mb-2 text-sm font-medium text-[#2C6E49]">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                        class="border border-gray text-[#2C6E49] text-sm rounded-lg focus:ring-[#2f8f4e] focus:border-[#2f8f4e] block w-full p-2.5 mb-4 bg-transparent"
                        placeholder="name@example.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />

                    <!-- Password -->
                    <label for="password" class="block mb-2 text-sm font-medium text-[#2C6E49]">Password</label>
                    <input id="password" type="password" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$" required autocomplete="new-password"
                        class="border border-gray text-[#2C6E49] text-sm rounded-lg focus:ring-[#2f8f4e] focus:border-[#2f8f4e] block w-full p-2.5 mb-4 bg-transparent"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />

                    <!-- Confirm Password -->
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-[#2C6E49]">Confirm Password</label>
                    <input :type="show ? 'text' : 'password'" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="border border-gray text-[#2C6E49] text-sm rounded-lg focus:ring-[#2f8f4e] focus:border-[#2f8f4e] block w-full p-2.5 mb-4 bg-transparent"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />

                    <!-- Submit -->
                    <div>
                        <x-primary-button 
                            class="w-full justify-center bg-[#2f8f4e] hover:bg-green-accent-green text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="bg-green-50 py-3 px-6 text-center text-sm text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#2f8f4e] font-semibold hover:underline">Log in</a>
            </div>
        </div>
    </div>
</x-guest-layout>
