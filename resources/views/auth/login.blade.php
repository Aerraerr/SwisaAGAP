<x-guest-layout>
    <style>
        .bg-light-green {
            background-color: #e0f2f1;
        }
        .curved-bg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 200px; /* smaller height for mobile */
            background-color: white;
            border-top-left-radius: 50% 150px;
            border-top-right-radius: 50% 150px;
            z-index: 0;
        }

        @media (min-width: 640px) {
            .curved-bg {
                height: 300px; /* bigger height on larger screens */
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

        .page-content { animation: fadeSlideUp 0.8s ease-out forwards; }
        .swisa-logo { animation: popUp 0.8s ease-out forwards; }

        input::placeholder { color: #9CA3AF; opacity: 1; }
        input.not-empty { border-color: #2f8f4e !important; box-shadow: 0 0 0 1px #2f8f4e; }
    </style>

    <div class="relative min-h-screen flex flex-col items-center justify-center bg-light-green p-4 sm:p-6">
        <!-- Curved background -->
        <div class="curved-bg"></div>

        <!-- Login card -->
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
                <h1 class="font-poppins text-[#2C6E49] text-xl sm:text-2xl font-bold">Welcome Back</h1>
                <p class="font-poppins text-[#2C6E49] text-sm">Log in to access your account</p>
            </div>

            <!-- Form -->
            <div class="p-6">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <label for="email" class="block mb-2 text-sm font-medium text-[#2C6E49]">Email</label>
                    <div class="relative mb-4">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <!-- Email Icon -->
                            <svg class="w-4 h-4 text-[#2f8f4e]" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                               class="border border-gray text-[#2C6E49] text-sm rounded-lg focus:ring-[#2f8f4e] focus:border-[#2f8f4e] block w-full ps-10 p-2.5 bg-transparent"
                               placeholder="name@example.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />

                    <!-- Password -->
                    <label for="password" class="block mb-2 text-sm font-medium text-[#2C6E49]">Password</label>
                    <div class="relative mb-4">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <!-- Lock Icon -->
                            <svg class="w-4 h-4 text-[#2f8f4e]" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v2H5a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2v-8a2 2 0 00-2-2h-1V6a4 4 0 00-4-4zm-2 6V6a2 2 0 114 0v2H8zm2 4a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="border border-gray text-[#2C6E49] text-sm rounded-lg focus:ring-[#2f8f4e] focus:border-[#2f8f4e] block w-full ps-10 pr-10 p-2.5 bg-transparent"
                            placeholder="••••••••">

                        <!-- Toggle eye -->
                        <button type="button" onclick="togglePassword()" 
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-[#2f8f4e] focus:outline-none">
                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.445-4.362m3.254-2.52A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.04 5.362M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"/>
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />

                    <!-- Remember / Forgot -->
                    <div class="flex flex-col sm:flex-row items-center justify-between mb-5 gap-3 sm:gap-0">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#2f8f4e] shadow-sm focus:ring-[#2f8f4e]" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-[#2f8f4e] hover:text-green-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <div>
                        <x-primary-button 
                            class="w-full justify-center bg-[#2f8f4e] hover:bg-green-accent-green text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="bg-green-50 py-3 px-6 text-center text-sm text-gray-500">
                Don’t have an account?
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-[#2f8f4e] font-semibold hover:underline">Sign up</a>
                @endif
            </div>
        </div>
    </div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const eyeOpen = document.getElementById("eyeOpen");
    const eyeClosed = document.getElementById("eyeClosed");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeOpen.classList.add("hidden");
        eyeClosed.classList.remove("hidden");
    } else {
        passwordInput.type = "password";
        eyeOpen.classList.remove("hidden");
        eyeClosed.classList.add("hidden");
    }
}

// Keep border color if input has value
document.querySelectorAll("input").forEach(input => {
    input.addEventListener("input", () => {
        if (input.value.trim() !== "") {
            input.classList.add("not-empty");
        } else {
            input.classList.remove("not-empty");
        }
    });
    if (input.value.trim() !== "") {
        input.classList.add("not-empty");
    }
});
</script>
</x-guest-layout>
