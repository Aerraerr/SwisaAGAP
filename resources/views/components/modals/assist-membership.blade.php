<div id="assistMembershipModal-{{ $member->id}}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-30 h-full w-full flex items-center justify-center">
  <div x-data="{ isChecked: false }" class="relative w-7xl max-w-7xl mx-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
    
    <!-- Modal Header -->
    <div class="flex items-center justify-between pb-2 border-b">
      <div>
        <h2 class="text-2xl font-bold text-customIT">Membership Application</h2>
        <p class="text-sm text-gray-500 mt-1">Membership Application Assistance</p>
      </div>
      <button onclick="closeModal('assistMembershipModal-{{ $member->id}}')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>


    <!-- Modal Body -->
    <div class="max-h-[85vh] overflow-y-auto px-6">
      <form action="{{ route('assistMembershipApplication.store', $member->id)}}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
      <!-- Personal Information -->
        <fieldset class="border border-gray-300 p-4 mt-4 rounded-md">
          <legend class="text-2xl font-semibold text-customIT mb-2">Personal Information</legend>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="fname" class="block text-sm font-medium text-gray-700">First Name</label>
              <input type="text" name="fname" value="{{ old('first_name', $member->first_name ?? 'first name')}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
            </div>
            <div>
              <label for="mname" class="block text-sm font-medium text-gray-700">Middle Name</label>
              <input type="text" name="mname" value="{{ old('middle_name', $member->middle_name ?? 'middle name') }}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
            </div>
            <div>
                <label for="lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="lname" value="{{ old('last_name', $member->last_name ?? 'last name') }}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
            </div>
            <div>
              <label for="suffix" class="block text-sm font-medium text-gray-700">Suffix</label>
              <select name="suffix" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                <option value="">Suffix</option>
                @foreach(\App\Models\UserInfo::Suffix as $suffix)
                  <option value="{{ $suffix }}"
                  {{ (isset($member->suffix) && $member->suffix == $suffix) ? 'selected' : '' }}
                  >{{ $suffix }}</option>
                @endforeach
              </Select>
            </div>
            <div>
              <label for="birthdate" class="block text-sm font-medium text-gray-700">Date of Birth</label>
              <input type="date" name="birthdate" value="{{ $member->user_info->birthdate?? 'birthdate' }}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
            </div> 
            <div>
              <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status</label>
                <select name="civil_status" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                  <option value="">Civil Status</option>
                  @foreach(\App\Models\UserInfo::Cvl_Stats as $cvl)
                    <option value="{{ $cvl }}" 
                    {{ (isset($member->user_info->civil_status) && $member->user_info->civil_status == $cvl) ? 'selected' : '' }}
                    >{{ $cvl }}</option>
                  @endforeach
                </select>
            </div>
            <div>
              <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
              <select name="sex" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                <option value="">Sex</option>
                  @foreach(\App\Models\UserInfo::Sexes as $sex)
                    <option value="{{ $sex }}" 
                    {{ (isset($member->user_info->gender) && $member->user_info->gender == $sex) ? 'selected' : '' }}
                    >{{ $sex }}</option>
                  @endforeach
              </select>
            </div>
                <div>
                  <label for="purok" class="block text-sm font-medium text-gray-700">Purok</label>
                  <input type="text" name="purok" value="{{ $member->user_info->zone ?? 'purok'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                </div>
                <div>
                  <label for="barangay" class="block text-sm font-medium text-gray-700">Barangay</label>
                  <input type="text"  name="barangay" value="{{ $member->user_info->barangay ?? 'barangay'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                </div>
                <div>
                  <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                  <input type="text"  name="city" value="{{ $member->user_info->city ?? 'city'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                </div>
                <div>
                  <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                  <input type="text" name="province" value="{{ $member->user_info->province ?? 'province'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                </div>
                <div>
                  <label for="phone" class="block text-sm font-medium text-gray-700">Contact No.</label>
                  <input type="text" name="phone" placeholder="09XXXXXXXXX" value="{{ $member->phone_number ?? 'contact no.'}}" pattern="09[0-9]{9}" title="Phone number must start with 09 and be 11 digits long" class="peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                  <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Please enter a valid phone number (starts with 09, 11 digits total).
                  </span>
                </div>
                <div>
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input type="email" name="email" value="{{ $member->email ?? 'email address'}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                  <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Please enter a valid email address
                  </span>
                </div>
          </div>
        </fieldset>

        <!-- Secondary Contact -->
        <fieldset class="border border-gray-300 p-4 mt-4 rounded-md">
          <legend class="text-2xl font-semibold text-customIT mb-2">Secondary Contact</legend>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
              <label for="sc_fname" class="block text-sm font-medium text-gray-700">First Name</label>
              <input type="text" name="sc_fname" value="{{ $member->user_info->sc_fname ?? 'first name'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
            </div>
            <div>
                  <label for="sc_mname" class="block text-sm font-medium text-gray-700">Middle Name</label>
                  <input type="text" name="sc_mname" value="{{ $member->user_info->sc_mname ?? 'middle name'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                </div>
                <div>
                  <label for="sc_lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                  <input type="text" name="sc_lname" value="{{ $member->user_info->sc_lname ?? 'last name'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                </div>
                <div>
                  <label for="sc_suffix" class="block text-sm font-medium text-gray-700">Suffix</label>
                  <select name="sc_suffix" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                      <option value="">Suffix</option>
                        @foreach(\App\Models\UserInfo::Suffix as $suffix)
                          <option value="{{ $suffix }}"
                          {{ (isset($member->user_info->suffix) && $member->user_info->suffix == $suffix) ? 'selected' : '' }}
                          >{{ $suffix }}</option>
                        @endforeach
                  </select>
                </div>
                <div>
                  <label for="sc_purok" class="block text-sm font-medium text-gray-700">Purok</label>
                  <input type="text" name="sc_purok" value="{{ $member->user_info->sc_zone ?? 'purok'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                </div>
                <div>
                  <label for="sc_barangay" class="block text-sm font-medium text-gray-700">Barangay</label>
                  <input type="text" name="sc_barangay" value="{{ $member->user_info->sc_barangay ?? 'barangay'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                </div>
                <div>
                  <label for="sc_city" class="block text-sm font-medium text-gray-700">City</label>
                  <input type="text" name="sc_city" value="{{ $member->user_info->sc_city ?? 'city'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                </div>
                <div>
                  <label for="sc_province" class="block text-sm font-medium text-gray-700">Province</label>
                  <input type="text" name="sc_province" value="{{ $member->user_info->sc_province ?? 'province'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>

                </div>
                <div>
                  <label for="sc_phone" class="block text-sm font-medium text-gray-700">Contact No.</label>
                  <input type="text" name="sc_phone" placeholder="09XXXXXXXXX" value="{{ $member->user_info->sc_phone_no ?? 'contact no.'}}" pattern="09[0-9]{9}" title="Phone number must start with 09 and be 11 digits long" class="peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                  <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Please enter a valid phone number (starts with 09, 11 digits total).
                  </span>
                </div>
                <div>
                  <label for="sc_email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input type="email" name="sc_email" value="{{ $member->user_info->sc_email ?? 'email'}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-red-500 w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                  <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Please enter a valid email address
                  </span>
                </div>
                <div>
                  <label for="sc_sex" class="block text-sm font-medium text-gray-700">Sex</label>
                  <select name="sc_sex" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                      <option value="">Sex</option>
                        @foreach(\App\Models\UserInfo::Sexes as $sex)
                          <option value="{{ $sex }}"
                          {{ (isset($member->user_info->gender) && $member->user_info->gender == $sex) ? 'selected' : '' }}
                          >{{ $sex }}</option>
                        @endforeach
                  </select>
                </div>
                <div>
                  <label for="relationship" class="block text-sm font-medium text-gray-700">Relationship</label>
                  <select name="relationship" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                      <option value="">Relationship</option>
                        @foreach(\App\Models\UserInfo::Relation as $relation)
                          <option value="{{ $relation }}"
                          {{ (isset($member->user_info->relationship) && $member->user_info->relationship == $relation) ? 'selected' : '' }}
                          >{{ $relation }}</option>
                        @endforeach
                  </select>
                </div>
          </div>
        </fieldset>

        <!-- Agriculture / Livelihood -->
        <fieldset class="border border-gray-300 p-4 mt-4 rounded-md">
          <legend class="text-2xl font-semibold text-customIT mb-2">Agriculture / Livelihood Information</legend>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                  <label for="sector" class="block text-sm font-medium text-gray-700">Sector</label>
                  <select name="sector" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                      <option value="" disabled selected>Select type</option>
                        @foreach($sectors as $sector)
                            <option value="{{ $sector->id }}"
                             {{ (isset($member->user_info->sector_id) && $member->user_info->sector_id == $sector->id) ? 'selected' : '' }}
                            >{{ $sector->sector_name }}</option>
                        @endforeach
                  </select>
                </div>
                <div>
                  <label for="farm_location" class="block text-sm font-medium text-gray-700">Farm Location</label>
                  <input type="text" name="farm_location" value="{{ $member->user_info->farm_location ?? 'location'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                </div>
                <div>
                  <label for="land_size" class="block text-sm font-medium text-gray-700">Land Size</label>
                  <input type="text" name="land_size" value="{{ $member->user_info->land_size ?? 'estimated land size'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                </div>
                <div>
                  <label for="water_source" class="block text-sm font-medium text-gray-700">Water Source</label>
                  <input type="text" name="water_source" value="{{ $member->user_info->water_source ?? 'water source'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                </div>
          </div>
        </fieldset>

        <!-- Purpose -->
        <fieldset class="border border-gray-300 p-4 mt-4 mt-2 rounded-md">
          <legend class="text-2xl font-semibold text-customIT mb-2">Purpose for Applying</legend>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
              <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
              <select name="purpose" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" required>
                <option value="">Select purpose for applying</option>
                <option>Access to Programs & Assistance</option>
                <option>Equipment Support</option>
                <option>Agribusiness Owner</option>
                <option>Trainings & Capacity Buildings</option>
                <option>Community Engagement</option>
              </select>
            </div>
            <div>
              <label for="other_purpose" class="block text-sm font-medium text-gray-700">Other</label>
              <input type="text" name="other_purpose" placeholder="other answer" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
            </div>
          </div>
        </fieldset>

        <!--Requirements Checklist -->
        <fieldset class="grid grid-cols-1 border border-gray-300 p-4 mt-4 rounded-md">
          <legend class="text-2xl font-semibold text-customIT mb-4">Requirements Checklist</legend>

          @foreach($membershipRequirements as $req)
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border border-gray-200 rounded-lg p-3 mb-3 shadow-sm">
              <span class="text-sm font-medium text-gray-800 sm:w-1/2">{{ $req->requirement_name }}</span>

              <div class="mt-2 sm:mt-0 sm:w-1/2">
                <input type="file" name="documents[{{ $req->id }}]" class="w-full text-sm border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-btncolor focus:border-btncolor transition" required>
              </div>
            </div>
          @endforeach
        </fieldset>

        <!--Checkit -->
        <div class="pt-4">
          <label>
            <input type="checkbox" x-model="isChecked" class="input-field rounded-[4px] border-btncolor text-customIT mr-2">
            <span class="text-bsctxt text-sm font-medium">I hereby certify that the information I provided above is true and correct to the best of my knowledge. I understand that any false statement or misrepresentation shall be grounds for disqualification or termination of membership in SWISA-AGAP</span>
          </label>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="text-right px-4 py-3">
          <button type="button" onclick="closeModal('assistMembershipModal-{{ $member->id}}')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
              Cancel
          </button>
          <button type="submit" :disabled="!isChecked" 
              :class="{ 'opacity-50 cursor-not-allowed': !isChecked }" class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
              Submit
          </button>
      </div>
    </form>
  </div>
</div>
