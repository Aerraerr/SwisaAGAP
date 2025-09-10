<div id="assistMembershipModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 z-20 h-full w-full flex items-center justify-center overflow-y-auto">
  <div class="relative w-full max-w-4xl mx-auto p-6 border shadow-lg rounded-xl bg-white transition-transform transform scale-95 duration-300">
    
    <!-- Modal Header -->
    <div class="flex items-center justify-between pb-4 border-b">
      <div>
        <h2 class="text-2xl font-bold text-green-700">Apply Membership</h2>
        <p class="text-gray-500 mt-1">Assist a member to get started</p>
      </div>
      <button onclick="closeModal('assistMembershipModal')" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Modal Body -->
    <div class="mt-4 space-y-6 max-h-[80vh] overflow-y-auto pr-2">
      
      <!-- Personal Information -->
      <div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Personal Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
          <input type="text" name="first_name" placeholder="First Name" class="input-field">
          <input type="text" name="suffix" placeholder="Suffix" class="input-field">
          <input type="text" name="middle_name" placeholder="Middle Name" class="input-field">
          <input type="text" name="last_name" placeholder="Last Name" class="input-field">
          <select name="civil_status" class="input-field">
            <option value="">Civil Status</option>
            <option>Single</option><option>Married</option><option>Widowed</option><option>Separated</option>
          </select>
          <select name="sex" class="input-field">
            <option value="">Sex</option>
            <option>Male</option><option>Female</option>
          </select>
          <input type="date" name="dob" class="input-field">
          <input type="text" name="pob" placeholder="Place of Birth" class="input-field">
          <input type="text" name="province" placeholder="Province" class="input-field">
          <input type="text" name="city" placeholder="City/Municipality" class="input-field">
          <input type="text" name="house_no" placeholder="House No." class="input-field">
          <input type="text" name="barangay" placeholder="Street/Barangay" class="input-field">
          <input type="text" name="phone" placeholder="Phone Number" class="input-field col-span-2">
          <input type="email" name="email" placeholder="Email Address" class="input-field col-span-2">
        </div>
      </div>

      <!-- Secondary Contact -->
      <div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Secondary Contact</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
          <input type="text" name="sc_first_name" placeholder="First Name" class="input-field">
          <input type="text" name="sc_suffix" placeholder="Suffix" class="input-field">
          <input type="text" name="sc_middle_name" placeholder="Middle Name" class="input-field">
          <input type="text" name="sc_last_name" placeholder="Last Name" class="input-field">
          <input type="text" name="sc_relationship" placeholder="Relationship" class="input-field">
          <select name="sc_sex" class="input-field">
            <option value="">Sex</option>
            <option>Male</option><option>Female</option>
          </select>
          <input type="date" name="sc_dob" class="input-field">
          <input type="text" name="sc_phone" placeholder="Phone Number" class="input-field">
          <input type="email" name="sc_email" placeholder="Email Address" class="input-field col-span-2">
        </div>
      </div>

      <!-- Agriculture / Livelihood -->
      <div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Agriculture / Livelihood Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
          <select name="farmer_type" class="input-field">
            <option value="">Type of Farmer/Fisher</option>
            <option>Farmer</option><option>Fisher</option>
          </select>
          <input type="text" name="farm_location" placeholder="Farm/Lot Location" class="input-field">
          <input type="text" name="land_size" placeholder="Estimated Land Size" class="input-field">
          <input type="text" name="water_source" placeholder="Water Source" class="input-field">
        </div>
      </div>
    </div>

    <!-- Modal Footer -->
    <div class="mt-6 flex justify-end gap-3 border-t pt-4">
      <button onclick="closeModal('assistMembershipModal')" type="button" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg">Cancel</button>
      <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">Submit</button>
    </div>
  </div>
</div>

