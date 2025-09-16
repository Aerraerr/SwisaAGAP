<div id="assistGrantRequestModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-20 h-full w-full flex items-center justify-center overflow-y-auto">
  <div class="relative w-auto max-w-4xl mx-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
    
    <!-- Modal Header -->
    <div class="flex items-center justify-between pb-4 shadow-b">
      <div>
        <h2 class="text-2xl font-bold text-customIT">Grant Request Application</h2>
        <p class="text-sm text-gray-500 mt-1">Grant Request Application Assistance</p>
      </div>
      <button onclick="closeModal('assistGrantRequestModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>


    <!-- Modal Body -->
    <div class="mt-4 space-y-6 max-h-[80vh] overflow-y-auto px-4">
      
      <!-- Personal Information -->
        <div>
            <h3 class="text-md font-semibold text-customIT mb-2">Personal Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                <input type="text" name="first_name" placeholder="First Name" class="input-field rounded-md border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="middle_name" placeholder="Middle Name" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="last_name" placeholder="last Name" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="suffix" placeholder="Suffix" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">

                <input type="text" name="pob" placeholder="Place of Birth" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="date" name="dob" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <select name="civil_status" class="input-field rounded-[4px] border-btncolor text-customIT px-3 focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                    <option value="">Civil Status</option>
                    <option>Single</option><option>Married</option>
                    <option>Widowed</option><option>Separated</option>
                </select>
                <select name="sex" class="input-field rounded-[4px] border-btncolor text-customIT px-3 focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                    <option value="">Sex</option>
                    <option>Male</option><option>Female</option>
                </select>

                <input type="text" name="purok" placeholder="Purok/Zone" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="barangay" placeholder="Street/Barangay" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="city" placeholder="City/Municipality" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="province" placeholder="Province" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">

                <input type="text" name="phone" placeholder="Phone Number" class="input-field col-span-2 rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="email" name="email" placeholder="Email Address" class="input-field col-span-2 rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
            </div>
        </div>

      <!-- Secondary Contact -->
        <div>
            <h3 class="text-md font-semibold text-customIT mb-2">Secondary Contact</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                <input type="text" name="sc_first_name" placeholder="First Name" class="input-field rounded-md border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="sc_middle_name" placeholder="Middle Name" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="sc_last_name" placeholder="last Name" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="sc_suffix" placeholder="Suffix" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">

                <input type="text" name="sc_purok" placeholder="Purok/Zone" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="sc_barangay" placeholder="Street/Barangay" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="sc_city" placeholder="City/Municipality" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="sc_province" placeholder="Province" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">

                <input type="text" name="sc_phone" placeholder="Phone Number" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="email" name="sc_email" placeholder="Email Address" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <select name="sc_sex" class="input-field rounded-[4px] border-btncolor text-customIT px-3 focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                    <option value="">Sex</option>
                    <option>Male</option><option>Female</option>
                </select>
                <select name="relationship" class="input-field rounded-[4px] border-btncolor text-customIT px-3 focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                    <option value="">Relationship</option>
                    <option>Parents</option><option>Sibling</option>
                    <option>Wife</option><option>Husband</option>
                </select>
            </div>
        </div>

      <!-- Agriculture / Livelihood -->
        <div>
            <h3 class="text-md font-semibold text-customIT mb-2">Agriculture / Livelihood Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <select name="Sector" class="input-field rounded-[4px] border-btncolor text-customIT px-3 focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                    <option value="">Type of Farmer/Fisher</option>
                    <option>Farmer</option><option>Fisher</option>
                </select>
                <input type="text" name="farm_location" placeholder="Farm/Lot Location" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="land_size" placeholder="Estimated Land Size" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                <input type="text" name="water_source" placeholder="Water Source" class="input-field rounded-[4px] border-btncolor text-customIT focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
            </div>
        </div>

      <!-- Available Grants & Equipments -->
        <div>
            <h3 class="text-md font-semibold text-customIT mb-2">Available Grants & Equipments</h3>
            <div class="grid grid-cols-2">
                <select name="Sector" class="input-field col-span-2 rounded-[4px] border-btncolor text-customIT py-2 px-3 focus:border-btncolor focus:ring focus:ring-btncolor focus:ring-opacity-30">
                    <option value="">Select</option>
                    <option>Machine: Tracktor</option>
                    <option>Shovel</option>
                    <option>Fertilizer</option>
                </select>
            </div> 
        </div>

      <!--Requirements Checklist -->
      <div class="grid grid-cols-4">
        <h3 class="text-md font-semibold text-customIT mb-2">Requirements Checklist</h3>
          <label class="col-start-1">
            <input type="checkbox" class="input-field rounded-[4px] border-btncolor text-customIT mr-2">
            <span class="text-bsctxt text-sm font-medium">Requirement 1</span>
          </label>
          <label class="col-start-1">
            <input type="checkbox" class="input-field rounded-[4px] border-btncolor text-customIT mr-2">
            <span class="text-bsctxt text-sm font-medium">Requirement 2</span>
          </label>
          <label class="col-start-1">
            <input type="checkbox" class="input-field rounded-[4px] border-btncolor text-customIT mr-2">
            <span class="text-bsctxt text-sm font-medium">Requirement 3</span>
          </label>
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
        <button onclick="closeModal('assistGrantRequestModal')" class="w-1/3 px-4 py-2 bg-cancel text-gray-500 rounded-md hover:bg-gray-400 hover:text-white">
            Cancel
        </button>
        <button class="w-1/3 px-4 py-2 bg-btncolor text-white rounded-md hover:bg-customIT">
            Approved
        </button>
    </div>
  </div>
</div>

