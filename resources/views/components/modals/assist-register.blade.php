<div id="assistRegisterModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto z-50 h-full w-full flex items-center justify-center">
    <div class="relative w-full max-w-2xl mx-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
        <!-- Modal Header -->
        <div class="flex items-center justify-between pb-2">
            <div class="items-center">
                <h2 class="text-3xl font-bold text-customIT">Create Account</h2>
                <p class="text-gray-500 mt-1">Assist a member to get started</p>
            </div>
            <div>
                <button onclick="closeModal('assistRegisterModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>


        <!-- Modal Body: Activity Log Entries -->
        <div class="mt-4 m-8 overflow-auto h-[75vh]">

        <form action="{{ route('assistRegister.store')}}" method="POST" class="space-y-4">
            @csrf
            <!-- Warning Note -->
            <div class="bg-gray-200 text-sm text-custom-dark-gray rounded-lg p-3 mb-6">
                note: Don't share your account credentials to anyone even the staff that is assisting you.
            </div>

            <!-- Form Fields -->
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="First Name" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
            </div>
            <div>
                <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
            </div>
            <div>
              <label for="suffix" class="block text-sm font-medium text-gray-700">Suffix</label>
              <select name="suffix" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                <option value="">Suffix</option>
                @foreach(\App\Models\UserInfo::Suffix as $suffix)
                  <option value="{{ $suffix }}"
                  {{ (isset($member->user_info->suffix) && $member->user_info->suffix == $suffix) ? 'selected' : '' }}
                  >{{ $suffix }}</option>
                @endforeach
              </Select>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address or Phone Number</label>
                <input type="email" name="email" id="email" placeholder="Name@email.com" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
            </div>
            <div x-data="{ show: false }" class="relative">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input :type="show ? 'text' : 'password'" type="password" name="password" id="password" placeholder="********" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$"
                    title="Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number."
                    class="peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                
                <!-- eye togglable for vision -->
                <span @click="show = !show" class="absolute right-3 top-9 text-gray-400 cursor-pointer">
                    <!-- Eye Icon (when hidden) -->
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <!-- Eye Slash Icon (when visible) -->
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </span>
                <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Password must be at least 8 chars, include uppercase, lowercase, and number.
                </span>
            </div>
            <div x-data="{ show: false, match: true }" x-init="$watch('document.getElementById(`confirm_password`).value', () => {});" class="relative">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input :type="show ? 'text' : 'password'" type="password" name="password_confirmation" id="confirm_password" placeholder="********" 
                    x-on:input="match = $el.value === document.getElementById('password').value;
                                $el.setCustomValidity(match ? '' : 'Passwords do not match');"
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30"
                    :class="!match ? 'border-red-500' : 'border-gray-300'" required>
                <!-- eye togglable for vision -->
                <span @click="show = !show" class="absolute right-3 top-9 text-gray-400 cursor-pointer">
                   <!-- Eye Icon (when hidden) -->
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    
                    <!-- Eye Slash Icon (when visible) -->
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </span>
                <span x-show="!match" class="mt-2 text-sm text-red-500 block">
                    Passwords do not match.
                </span>
            </div>

            <!-- Checkbox for Terms -->
            <div class="flex items-center space-x-2 pt-4">
                <input type="checkbox" id="terms" class="peer h-5 w-5 appearance-none rounded-md border border-gray-300 bg-white transition-colors duration-200 checked:bg-btncolor checked:border-btncolor" />
                <label for="terms" class="text-gray-700 select-none">I've read and agree with the <a href="#" class="text-custom-green font-medium">Terms and Conditions</a> and the <a href="#" class="text-custom-green font-medium">Privacy Policy</a>.</label>
            </div>
            
        </div>

        <!-- modal footer -->
        <div class="text-right px-4 py-3">
            <button type="button" onclick="closeModal('assistRegisterModal')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
                Cancel
            </button>
            <button type="submit" class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
                Register
            </button>
        </div>
        </form>
    </div>
</div>
