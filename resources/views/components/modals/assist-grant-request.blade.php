<div id="assistGrantRequestModal-{{ $member->id}}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-20 h-full w-full flex items-center justify-center overflow-y-auto">
  <div class="relative w-auto max-w-6xl mx-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
    
    <!-- Modal Header -->
    <div class="flex items-center justify-between pb-4 shadow-b">
      <div>
        <h2 class="text-2xl font-bold text-customIT">Grant Request Application</h2>
        <p class="text-sm text-gray-500 mt-1">Grant Request Application Assistance</p>
      </div>
      <button onclick="closeModal('assistGrantRequestModal-{{ $member->id}}')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>


    <!-- Modal Body -->
    <div class="mt-4 space-y-6 max-h-[80vh] overflow-y-auto px-4">
    <form action="{{ route('assistGrantApplication.store', $member->id)}}" method="POST" class="space-y-4" enctype="multipart/form-data">
    @csrf
      <!-- Personal Information -->
        <div>
            <h3 class="text-md font-semibold text-customIT mb-2">Personal Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
              <div>
                <label for="fname" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="fname" value="{{ old('first_name', $member->first_name ?? 'first name') }}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="mname" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" name="mname" value="{{ old('middle_name', $member->middle_name ?? 'middle name')}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">

              </div>
              <div>
                <label for="lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="lname" value="{{ old('last_name', $member->last_name ?? 'last name')}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="suffix" class="block text-sm font-medium text-gray-700">Suffix</label>
                <select name="suffix" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                  <option value="{{ $member->user_info->sc_suffix ?? ''}}">Suffix</option>
                  @foreach(\App\Models\UserInfo::Suffix as $suffix)
                    <option value="{{ $suffix }}">{{ $suffix }}</option>
                  @endforeach
                </Select>
              </div>
              <div>
                <label for="birthdate" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="birthdate" value="{{ $member->user_info->birthdate?? 'birthdate' }}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status</label>
                <select name="civil_status" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                    <option value="">Civil Status</option>
                    <option>Single</option><option>Married</option>
                    <option>Widowed</option><option>Separated</option>
                </select>
              </div>
              <div>
                <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                <select name="sex" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                  <option value="">Sex</option>
                  @foreach(\App\Models\UserInfo::Sexes as $sex)
                    <option value="{{ $sex }}">{{ $sex }}</option>
                  @endforeach
                </Select>
              </div>
              <div>
                <label for="purok" class="block text-sm font-medium text-gray-700">Purok</label>
                <input type="text" name="purok" value="{{ $member->user_info->zone ?? 'purok'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="barangay" class="block text-sm font-medium text-gray-700">Barangay</label>
                <input type="text" name="barangay" value="{{ $member->user_info->barangay ?? 'barangay'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" name="city" value="{{ $member->user_info->city ?? 'city'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                <input type="text" name="province" value="{{ $member->user_info->province ?? 'province'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" value="{{ $member->user_info->contact_no ?? 'contact no'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ $member->email ?? 'email'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
            </div>
        </div>

      <!-- Secondary Contact -->
        <div>
            <h3 class="text-md font-semibold text-customIT mb-2">Secondary Contact</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3">
              <div>
                <label for="sc_fname" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="sc_fname" value="{{ $member->user_info->sc_fname ?? 'first name'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="sc_mname" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" name="sc_mname" value="{{ $member->user_info->sc_mname ?? 'middle name'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="sc_lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="sc_lname" value="{{ $member->user_info->sc_lname ?? 'last name'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="sc_suffix" class="block text-sm font-medium text-gray-700">Suffix</label>
                <select name="sc_suffix" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                  <option value="{{ $member->user_info->sc_suffix ?? ''}}">Suffix</option>
                  @foreach(\App\Models\UserInfo::Suffix as $suffix)
                    <option value="{{ $suffix }}">{{ $suffix }}</option>
                  @endforeach
                </Select>
              </div>
              <div>
                <label for="sc_purok" class="block text-sm font-medium text-gray-700">Purok</label>
                <input type="text" name="sc_purok" value="{{ $member->user_info->sc_purok ?? 'purok'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="sc_barangay" class="block text-sm font-medium text-gray-700">Barangay</label>
                <input type="text" name="sc_barangay" value="{{ $member->user_info->sc_barangay ?? 'barangay'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="sc_city" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" name="sc_city" value="{{ $member->user_info->sc_city ?? 'city'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="sc_province" class="block text-sm font-medium text-gray-700">Province</label>
                <input type="text" name="sc_province" value="{{ $member->user_info->sc_province ?? 'province'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">

              </div>
              <div>
                <label for="sc_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="sc_phone" value="{{ $member->user_info->sc_contact_no ?? 'contact no'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                
              </div>
              <div>
                <label for="sc_email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="sc_email" value="{{ $member->user_info->sc_email ?? 'email'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                
              </div>
              <div>
                <label for="sc_sex" class="block text-sm font-medium text-gray-700">Sex</label>
                <select name="sc_sex" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                  <option value="">Sex</option>
                    @foreach(\App\Models\UserInfo::Sexes as $sex)
                      <option value="{{ $sex }}">{{ $sex }}</option>
                    @endforeach
                </select>
              </div>
              <div>
                <label for="relationship" class="block text-sm font-medium text-gray-700">Relationship</label>
                <select name="relationship" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                <option value="">Relationship</option>
                  @foreach(\App\Models\UserInfo::Relation as $relation)
                    <option value="{{ $relation }}">{{ $relation }}</option>
                  @endforeach
                </select>
              </div>
            </div>
        </div>

      <!-- Agriculture / Livelihood -->
        <div>
            <h3 class="text-md font-semibold text-customIT mb-2">Agriculture / Livelihood Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
              <div>
                <label for="Sector" class="block text-sm font-medium text-gray-700">Sector</label>
                <select name="sector" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
                  <option value="" disabled selected>Select type</option>
                  @foreach($sectors as $sector)
                    <option value="{{ $sector->id }}">{{ $sector->sector_name }}</option>
                  @endforeach
                </select>
              </div>
              <div>
                <label for="farm_location" class="block text-sm font-medium text-gray-700">Farm Location</label>
                <input type="text" name="farm_location" value="{{ $member->user_info->farm_location ?? 'farm location'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="land_size" class="block text-sm font-medium text-gray-700">Land Size</label>
                <input type="text" name="land_size" value="{{ $member->user_info->land_size ?? 'estimated land size'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
              <div>
                <label for="water_source" class="block text-sm font-medium text-gray-700">Water Source</label>
                <input type="text" name="water_source" value="{{ $member->user_info->water_source ?? 'water source'}}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              </div>
            </div>
        </div>

        <!-- Agriculture / Livelihood -->
      <div>
        <h3 class="text-md font-semibold text-customIT mb-2">Purpose for Applying</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
          <div>
            <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
            <select name="purpose" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
              <option value="">To aid cultivation of farm</option>
              <option>aid financially</option><option>to borrow machines/tools</option>
            </select>
          </div>
          <div>
            <label for="other_purpose" class="block text-sm font-medium text-gray-700">Other</label>
            <input type="text" name="other_purpose" placeholder="other answer" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
          </div>
        </div>
      </div>
    <div x-data="{
      selectedGrantId: null,
      get selectedGrant() {
        return this.grants.find(g => g.id == this.selectedGrantId);
      }, grants: @js($grants) }">

      <!-- Available Grants & Equipments -->
      <div>
          <h3 class="text-md font-semibold text-customIT mb-2">Available Grants & Equipments</h3>
          <div class="grid grid-cols-1">
              <label class="block text-sm font-medium text-gray-700">Grants</label>
              <select name="grant_id" 
                      x-model="selectedGrantId"
                      class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30" 
                      required>
                  <option value="">Select</option>
                  @foreach($grants as $grant)
                      <option value="{{ $grant->id }}">
                          {{ $grant->title }}
                      </option>
                  @endforeach
              </select>
          </div>
      </div>

      <!-- Requirements Checklist -->
      <div x-show="selectedGrant" class="grid grid-cols-4 mt-4">
        <h3 class="text-md font-semibold text-customIT mb-2 col-span-4">Requirements Checklist</h3>
        <template x-for="requirement in selectedGrant.requirements" :key="requirement.id">
            <div class="col-span-4 flex items-center gap-2">
                <span class="text-sm text-gray-800" x-text="requirement.requirement_name"></span>
            </div>
        </template>
      </div>
    </div>

       <!-- an input fiedl type file that can upload multiple files -->
      <div x-data="{ files: [] }">
          <label for="documents" class="block text-sm font-medium text-gray-700">Upload Documents</label>
          <input type="file" name="documents[]" id="documents" multiple 
                @change="files = [...files, ...Array.from($event.target.files)]"
                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-btncolor focus:border-btncolor focus:ring-opacity-30">
          <p class="text-sm text-gray-500 mt-1">You can select multiple files (PDF, JPG, PNG).</p>

          <!-- List of selected files -->
          <ul class="mt-2 text-gray-700 text-sm list-disc list-inside">
              <template x-for="(file, index) in files" :key="index">
                  <li class="flex justify-between items-center">
                      <span x-text="file.name"></span>
                      <button type="button" 
                              @click="files = files.filter((_, i) => i !== index)" 
                              class="ml-2 text-red-500 hover:text-red-700 text-xs">
                          Remove
                      </button>
                  </li>
              </template>
          </ul>
      </div>

      <!--Checkit -->
      <div>
        <label>
          <input type="checkbox" class="input-field rounded-[4px] border-btncolor text-customIT mr-2">
          <span class="text-bsctxt text-sm font-medium">The I hereby certify that the information I provided above is true and correct to the best of my knowledge. I understand that any false statement or misrepresentation shall be grounds for disqualification or termination of membership in SWISA-AGAP</span>
        </label>
      </div>
    </div>

      <!-- Modal Footer -->
      <div class="text-right px-4 py-3">
          <button type="button" onclick="closeModal('assistGrantRequestModal-{{ $member->id}}')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
              Cancel
          </button>
          <button type="submit" class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
              Submit
          </button>
      </div>
    </form>
  </div>
</div>

