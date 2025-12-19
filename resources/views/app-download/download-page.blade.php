<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=0.9"/>
  <title>Download SWISA-AGAP</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="icon" href="{{ asset('images/swisa-logov1.png') }}" type="png">
  

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
      color: white;
      position: relative;
      overflow-x: hidden;
      overflow-y: auto;
    }

    /* Dark overlay */
    .overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.55);
      z-index: 1;
    }

    /* Video background */
    .video-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 0;
    }

    .nav-link { @apply text-white hover:text-emerald-400 font-semibold transition; }
    .active-link { @apply text-emerald-400 border-b-2 border-[#A7F3D0]; }
    .btn-primary {
      @apply inline-flex items-center justify-center px-8 py-3 bg-[#4C956C] text-white font-semibold rounded-full shadow-md transition transform hover:scale-105 hover:bg-[#3d7d5a];
    }

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.8);
      backdrop-filter: blur(5px);
    }

    .modal.show {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .modal-content {
      max-height: 85vh;
      overflow-y: auto;
      animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Custom scrollbar */
    .modal-content::-webkit-scrollbar {
      width: 8px;
    }
    .modal-content::-webkit-scrollbar-track {
      background: #e5e7eb;
      border-radius: 10px;
    }
    .modal-content::-webkit-scrollbar-thumb {
      background: #4C956C;
      border-radius: 10px;
    }
    .modal-content::-webkit-scrollbar-thumb:hover {
      background: #3d7d5a;
    }

    /* Custom checkbox */
    .custom-checkbox {
      appearance: none;
      width: 20px;
      height: 20px;
      border: 2px solid #4C956C;
      border-radius: 4px;
      cursor: pointer;
      position: relative;
      transition: all 0.3s ease;
    }

    .custom-checkbox:checked {
      background-color: #4C956C;
    }

    .custom-checkbox:checked::after {
      content: '✓';
      position: absolute;
      color: white;
      font-size: 14px;
      font-weight: bold;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .custom-checkbox:hover {
      border-color: #3d7d5a;
    }
    .faq-answer {
    opacity: 0;
    transform: translateX(-15px);
    transition: all 0.25s ease-in-out;
    }

    .faq-answer.show {
        opacity: 1;
        transform: translateX(0);
    }

  </style>
</head>
<body>

  <!-- Background Video -->
  <video autoplay muted loop playsinline class="video-bg">
    <source src="{{ asset('images/swisa-bg.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="overlay"></div>

  <!-- Top Bar -->
  <header class="py-4 relative z-10">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
      <a href="/" class="flex items-center gap-2" data-aos="fade-right">
        <img src="{{ asset('images/swisamain.png') }}" alt="Logo" class="w-[100px] md:w-[150px] h-14 object-contain">
      </a>

      <!-- Mobile menu button -->
      <button id="menu-toggle" class="text-white md:hidden focus:outline-none" aria-label="Menu">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>

      <!-- Nav links -->
      <nav id="nav-links" class="hidden md:flex gap-6" data-aos="fade-left">
        <a href="#features" class="nav-link">Features</a>
        <a href="#visit" class="nav-link">Get Started</a>
      </nav>
    </div>

    <!-- Mobile dropdown -->
    <div id="mobile-menu" class="md:hidden hidden bg-[#4C956C]/90 backdrop-blur-sm">
      <a href="#features" class="block px-6 py-3 text-white hover:bg-[#3d7d5a]">Features</a>
      <a href="#visit" class="block px-6 py-3 text-white hover:bg-[#3d7d5a]">Get Started</a>
    </div>
  </header>

<!-- Hero Section -->
<section id="download" class="h-[600px] relative overflow-hidden text-white z-10 flex flex-col items-center justify-center text-center px-6">
  <div data-aos="fade-up">
    <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-4">
      Download the <span class="text-emerald-400">SwisaAGAP</span> App
    </h1>
    <p class="text-gray-100 mb-6 max-w-2xl mx-auto">
      Streamlining membership, agricultural grant requests, and training participation for the SWISA Federation — all in one easy-to-use mobile platform.
    </p>
    <p class="text-emerald-400 font-semibold mb-2 text-lg">Now available for Android</p>

    <button id="downloadBtn1"
      class="w-[220px] inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-500 text-white font-semibold rounded-full shadow-lg hover:from-green-700 hover:to-emerald-600 transition transform hover:scale-105">
      <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
        <polyline points="7 10 12 15 17 10"/>
        <line x1="12" y1="15" x2="12" y2="3"/>
      </svg>
      Download APK
    </button>

    <a href="#" 
      class="w-[220px] mt-3 inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-gray-500 to-gray-700 text-white font-semibold rounded-full shadow-lg cursor-not-allowed opacity-70">
      <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
        <polyline points="7 10 12 15 17 10"/>
        <line x1="12" y1="15" x2="12" y2="3"/>
      </svg>
      Not Available
    </a>

    <p class="mt-4 text-sm text-gray-300">
      Compatible with Android 10+ • iOS version coming soon
    </p>
  </div>
</section>

<!-- Features Section -->
<section id="features" class="max-w-7xl mx-auto px-6 py-16 relative z-10 text-white">
  <h2 class="text-3xl md:text-4xl font-extrabold text-center mb-10 text-white" data-aos="fade-up">
    Why Choose SwisaAGAP?
  </h2>
  <div class="text-center grid gap-8 md:grid-cols-3">
    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
      <h3 class="font-bold text-lg mb-2 text-emerald-400">Membership Made Easy</h3>
      <p class="text-gray-200 text-sm">Submit applications, upload documents, and get verified with personalized QR codes — all from your phone.</p>
    </div>
    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
      <h3 class="font-bold text-lg mb-2 text-emerald-400">Grants & Equipment Requests</h3>
      <p class="text-gray-200 text-sm">View available agricultural resources, submit requests, and track approvals seamlessly through the app.</p>
    </div>
    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
      <h3 class="font-bold text-lg mb-2 text-emerald-400">Training & Community</h3>
      <p class="text-gray-200 text-sm">Register for federation programs, track participation, and stay connected with other SWISA members.</p>
    </div>
  </div>
</section>

<!-- Visit Section -->
<section id="visit" class="py-16 relative z-10 text-white text-center">
  <div class="max-w-4xl mx-auto px-6" data-aos="fade-up">
    <h2 class="text-3xl font-bold mb-4 text-white">Get Started Today</h2>
    <p class="text-gray-200 mb-6">
      Experience a digital transformation in agriculture with SWISA-AGAP. Download the app to manage membership, grants, and training — all in one platform.
    </p>
    <button id="downloadBtn2"
      class="w-[220px] mt-3 inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-500 text-white font-semibold rounded-full shadow-lg hover:from-green-700 hover:to-emerald-600 transition transform hover:scale-105">
      <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
        <polyline points="7 10 12 15 17 10"/>
        <line x1="12" y1="15" x2="12" y2="3"/>
      </svg>
      Download
    </button>
  </div>
</section>


  <!-- Footer -->
  <footer class="bg-[#043B2E] text-white py-10 relative z-10 ">
    <div class="max-w-full mx-auto px-10">

      <!-- TOP GRID -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 pb-10">

        <!-- Agency -->
        <div class="space-y-3">
          <div class="flex items-center gap-2">
                          <div class="h-[85px] w-[85px] rounded-full overflow-hidden bg-white">
                  <img src="{{ asset('images/da.png') }}" alt="Logo 2" class="h-full w-full object-cover">
              </div>
              <div class="h-[100px] w-[100px] rounded-full overflow-hidden ">
                  <img src="{{ asset('images/swisa-logo.png') }}" alt="Logo 1" class="h-full w-full object-cover">
              </div>


          </div>


          <p class="text-lg font-semibold text-white">SwisaAGAP</p>

          <p class="text-sm text-gray-300 leading-relaxed">
            Small Water Irrigation System Association<br>
            SWISA Sorsogon<br>
            Sorsogon Province, Philippines
          </p>
        </div>

        <!-- Quick Links -->
        <div class="space-y-2">
          <p class="font-bold text-white text-base">Quick Links</p>
          <ul class="space-y-1">
            <li><a href="https://www.facebook.com/profile.php?id=61584233666642" class="text-gray-300 hover:text-emerald-400 transition">Events Calendar</a></li>
          </ul>
        </div>

        <!-- Resources -->
        <div class="space-y-2">
          <p class="font-bold text-white text-base">Resources</p>
          <ul class="space-y-1">
            <li><a href="#" id="openUserManual" class="text-gray-300 hover:text-emerald-400 transition">User Manual</a></li>
            <li><a href="#" id="openFaqModal" class="text-gray-300 hover:text-emerald-400 transition">FAQs</a></li>
          </ul>
        </div>

        <!-- Contacts -->
        <div class="space-y-2">
          <p class="font-bold text-white text-base">Contacts</p>
          <a href="mailto:swisaagap2025@gmail.com" class="text-gray-300 hover:text-emerald-400 transition">
            swisaagap2025@gmail.com
          </a>

          <div class="flex items-center gap-3 pt-1">
            <a href="https://www.facebook.com/profile.php?id=61584233666642" target="_blank" class="text-gray-300 hover:text-emerald-400 transition">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2.04C6.5 2.04 2 6.54 2 12.04C2 17.04 5.71 21.36 10.74 21.92V14.28H7.93V11.23H10.74V8.89C10.74 6.03 12.43 4.41 15.01 4.41C16.27 4.41 17.39 4.61 17.65 4.64V7.59H16.03C14.73 7.59 14.47 8.35 14.47 9.21V11.23H17.51L17.01 14.28H14.47V21.92C19.5 21.36 23.21 17.04 23.21 12.04C23.21 6.54 18.71 2.04 12 2.04Z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <!-- BOTTOM FOOTER BAR -->
      <div class="flex flex-col md:flex-row items-center justify-between border-t border-white/20 pt-4">
        <p class="text-xs text-center md:text-start">
          © 2025 SWISA-AGAP.
        </p>

        <div class="flex gap-4 text-xs mt-3 md:mt-0">
          <button id="openPrivacyModal" class="text-gray-300 hover:text-emerald-400 transition cursor-pointer">Privacy Policy</button>
          <button id="openTermsModal" class="text-gray-300 hover:text-emerald-400 transition cursor-pointer">Terms and Conditions</button>
        </div>
      </div>
    </div>
  </footer>

  <!-- Download Confirmation Modal -->
  <div id="downloadModal" class="modal">
    <div class="w-full max-w-lg mx-4">
      <div class="bg-white rounded-2xl shadow-2xl p-8 relative">
        <!-- Close Button -->
        <button id="closeDownloadModal" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 transition">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

        <!-- Modal Header -->
        <div class="mb-6">
          <div class="flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-full mx-auto mb-4">
            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
            </svg>
          </div>
          <h2 class="text-2xl font-extrabold text-gray-900 text-center mb-2">Before You Download</h2>
          <p class="text-gray-600 text-sm text-center">Please confirm that you have read and agree to our policies</p>
        </div>

        <!-- Checkboxes -->
        <div class="space-y-4 mb-6">
          <label class="flex items-start gap-3 cursor-pointer group">
            <input type="checkbox" id="agreeTerms" class="custom-checkbox mt-1">
            <span class="text-gray-700 text-sm leading-relaxed group-hover:text-gray-900">
              I have read and agree to the 
              <button type="button" id="viewTermsLink" class="text-emerald-600 hover:text-emerald-700 font-semibold underline">Terms and Conditions</button>
            </span>
          </label>

          <label class="flex items-start gap-3 cursor-pointer group">
            <input type="checkbox" id="agreePrivacy" class="custom-checkbox mt-1">
            <span class="text-gray-700 text-sm leading-relaxed group-hover:text-gray-900">
              I have read and agree to the 
              <button type="button" id="viewPrivacyLink" class="text-emerald-600 hover:text-emerald-700 font-semibold underline">Privacy Policy</button>
            </span>
          </label>
        </div>

        <!-- Error Message -->
        <div id="downloadError" class="hidden mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
          <p class="text-red-700 text-sm text-center">
            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            Please agree to both Terms and Privacy Policy to continue
          </p>
        </div>

        <!-- Modal Footer -->
        <div class="flex gap-3">
          <button id="cancelDownload" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
            Cancel
          </button>
          <button id="confirmDownload" class="flex-1 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition transform hover:scale-105">
            Download Now
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Terms and Conditions Modal -->
  <div id="termsModal" class="modal">
    <div class="w-full max-w-4xl mx-4">
      <div class="modal-content bg-white rounded-2xl shadow-2xl p-8 relative">
        <!-- Close Button -->
        <button id="closeTermsModal" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 transition">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

        <!-- Modal Header -->
        <div class="mb-6">
          <h2 class="text-3xl font-extrabold text-emerald-600 mb-2">Terms and Conditions</h2>
          <p class="text-gray-500 text-sm">Last updated: December 2025</p>
        </div>

        <!-- Modal Content -->
        <div class="space-y-6 text-gray-700 text-sm leading-relaxed">
          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">1. Acceptance of Terms</h3>
            <p>By downloading, installing, or using the SWISA-AGAP mobile application, you agree to be bound by these Terms and Conditions. If you do not agree to these terms, please do not use the application.</p>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">2. Use of Application</h3>
            <p>The SWISA-AGAP app is intended for use by members of the Small Water Irrigation System Association (SWISA) and authorized personnel. You agree to use the application only for lawful purposes and in accordance with these terms.</p>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">3. User Accounts</h3>
            <p>You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. You must notify us immediately of any unauthorized use of your account.</p>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">4. Privacy and Data Collection</h3>
            <p>We collect and process personal information in accordance with our Privacy Policy. By using the application, you consent to such collection and processing. We are committed to protecting your personal data and ensuring its security.</p>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">5. Intellectual Property</h3>
            <p>All content, features, and functionality of the SWISA-AGAP application are owned by SWISA and are protected by copyright, trademark, and other intellectual property laws. You may not reproduce, distribute, or create derivative works without our express written permission.</p>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">6. Prohibited Activities</h3>
            <p>You agree not to:</p>
            <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
              <li>Use the application for any illegal purpose</li>
              <li>Attempt to gain unauthorized access to the application or its related systems</li>
              <li>Transmit viruses, malware, or other harmful code</li>
              <li>Interfere with or disrupt the application's functionality</li>
              <li>Impersonate another person or entity</li>
            </ul>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">7. Limitation of Liability</h3>
            <p>SWISA-AGAP and its affiliates shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of or inability to use the application.</p>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">8. Modifications to Terms</h3>
            <p>We reserve the right to modify these Terms and Conditions at any time. We will notify users of any significant changes. Your continued use of the application after such modifications constitutes acceptance of the updated terms.</p>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">9. Contact Information</h3>
            <p>If you have any questions about these Terms and Conditions, please contact us at:</p>
            <p class="mt-2 text-emerald-600 font-semibold">swisaagap2025@gmail.com</p>
          </section>
        </div>

        <!-- Modal Footer -->
        <div class="mt-8 flex justify-end">
          <button id="closeTermsBtn" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition transform hover:scale-105">
            I Understand
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Privacy Policy Modal -->
  <div id="privacyModal" class="modal">
    <div class="w-full max-w-4xl mx-4">
      <div class="modal-content bg-white rounded-2xl shadow-2xl p-8 relative">
        <!-- Close Button -->
        <button id="closePrivacyModal" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 transition">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

        <!-- Modal Header -->
        <div class="mb-6">
          <h2 class="text-3xl font-extrabold text-emerald-600 mb-2">Privacy Policy</h2>
          <p class="text-gray-500 text-sm">Last updated: December 2025</p>
        </div>

        <!-- Modal Content -->
        <div class="space-y-6 text-gray-700 text-sm leading-relaxed">
          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">1. Introduction</h3>
            <p>SWISA-AGAP ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our mobile application.</p>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">2. Information We Collect</h3>
            <p>We collect several types of information for various purposes to provide and improve our service to you:</p>
            <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
              <li><strong>Personal Information:</strong> Name, email address, phone number, address, and profile photo</li>
              <li><strong>Membership Information:</strong> Membership ID, sector affiliation, and registration details</li>
              <li><strong>Grant and Equipment Data:</strong> Grant applications, equipment requests, and supporting documents</li>
              <li><strong>Training Records:</strong> Training registrations, attendance, and participation history</li>
              <li><strong>Device Information:</strong> Device type, operating system, and unique device identifiers</li>
              <li><strong>Usage Data:</strong> Pages visited, time spent on pages, and app usage statistics</li>
            </ul>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">3. How We Use Your Information</h3>
            <p>We use the collected information for the following purposes:</p>
            <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
              <li>To provide and maintain our application services</li>
              <li>To process membership applications and verify identity</li>
              <li>To manage grant and equipment requests</li>
              <li>To facilitate training program registrations and track participation</li>
              <li>To send notifications about application status updates and important announcements</li>
              <li>To generate QR codes for identity verification</li>
              <li>To analyze usage patterns and improve our services</li>
              <li>To ensure security and prevent fraud</li>
            </ul>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">4. Data Sharing and Disclosure</h3>
            <p>We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:</p>
            <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
              <li>With SWISA administrators and staff for membership and grant management purposes</li>
              <li>With authorized government agencies when required by law</li>
              <li>With service providers who assist us in operating the application (under strict confidentiality agreements)</li>
              <li>When necessary to protect the rights, property, or safety of SWISA, our users, or others</li>
            </ul>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">5. Data Security</h3>
            <p>We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. These measures include:</p>
            <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
              <li>Encryption of data in transit and at rest</li>
              <li>Secure authentication using Bearer tokens</li>
              <li>Regular security audits and updates</li>
              <li>Access controls and role-based permissions</li>
              <li>Secure file storage systems</li>
            </ul>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">6. Your Data Rights</h3>
            <p>You have the following rights regarding your personal data:</p>
            <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
              <li><strong>Access:</strong> You can request access to your personal information</li>
              <li><strong>Correction:</strong> You can update or correct your personal information through the app</li>
              <li><strong>Deletion:</strong> You can request deletion of your account and associated data</li>
              <li><strong>Portability:</strong> You can request a copy of your data in a portable format</li>
              <li><strong>Objection:</strong> You can object to certain processing of your personal information</li>
            </ul>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">7. Data Retention</h3>
            <p>We retain your personal information for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required by law. Membership records and grant histories may be retained for archival and compliance purposes.</p>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">8. Children's Privacy</h3>
            <p>Our application is not intended for use by children under the age of 18. We do not knowingly collect personal information from children. If you become aware that a child has provided us with personal information, please contact us immediately.</p>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">9. Changes to This Privacy Policy</h3>
            <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date. You are advised to review this Privacy Policy periodically for any changes.</p>
          </section>

          <section>
            <h3 class="text-xl font-bold text-gray-900 mb-3">10. Contact Us</h3>
            <p>If you have any questions about this Privacy Policy or wish to exercise your data rights, please contact us at:</p>
            <p class="mt-2 text-emerald-600 font-semibold">swisaagap2025@gmail.com</p>
            <p class="mt-2 text-gray-700">Small Water Irrigation System Association<br>SWISA Sorsogon<br>Sorsogon Province, Philippines</p>
          </section>
        </div>

        <!-- Modal Footer -->
        <div class="mt-8 flex justify-end">
          <button id="closePrivacyBtn" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition transform hover:scale-105">
            I Understand
          </button>
        </div>
      </div>
    </div>
  </div>


<!-- User Guide -->
<div id="userManualModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-2xl w-11/12 md:w-3/4 lg:w-1/2 p-4 relative">
        <!-- Close button -->
        <button id="closeUserManual" class="absolute top-2 right-2 text-gray-700 hover:text-red-500 text-xl font-bold">&times;</button>

        <!-- Video -->
        <video id="userManualVideo" class="w-full rounded-lg mb-4" controls>
            <source src="{{ asset('videos/UserManual.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Download PDF -->
        <div class="text-center mt-2">
            <a href="{{ asset('videos/UserManual.pdf') }}" 
               download 
               class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
               Download PDF
            </a>
        </div>
    </div>
</div>


<!-- FAQ Modal -->
<div id="faqModal"
     class="modal">
    <div class="w-full max-w-3xl mx-4">
        <div class="modal-content bg-white rounded-2xl shadow-2xl p-8 relative">

            <!-- Close Button -->
            <button id="closeFaqModal"
                class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <h2 class="text-3xl font-extrabold text-emerald-600 mb-6">
                Frequently Asked Questions
            </h2>

            <!-- AJAX CONTENT HERE -->
            <div id="faqContainer" class="space-y-6"></div>

        </div>
    </div>
</div>


<!-- Scripts -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  /* -------------------------------
    AOS INIT
  -------------------------------- */
  AOS.init({ duration: 800, once: true, easing: 'ease-out-cubic' });

  /* -------------------------------
    MOBILE MENU
  -------------------------------- */
  document.getElementById('menu-toggle').addEventListener('click', () => {
    document.getElementById('mobile-menu').classList.toggle('hidden');
  });

  /* -------------------------------
    MODAL ELEMENTS
  -------------------------------- */
  const downloadModal = document.getElementById('downloadModal');
  const termsModal = document.getElementById('termsModal');
  const privacyModal = document.getElementById('privacyModal');
  const faqModal = document.getElementById('faqModal');

  /* -------------------------------
    DOWNLOAD BUTTONS
  -------------------------------- */
  const downloadBtn1 = document.getElementById('downloadBtn1');
  const downloadBtn2 = document.getElementById('downloadBtn2');

  const closeDownloadModal = document.getElementById('closeDownloadModal');
  const cancelDownload = document.getElementById('cancelDownload');
  const confirmDownload = document.getElementById('confirmDownload');

  const agreeTerms = document.getElementById('agreeTerms');
  const agreePrivacy = document.getElementById('agreePrivacy');
  const downloadError = document.getElementById('downloadError');

  const viewTermsLink = document.getElementById('viewTermsLink');
  const viewPrivacyLink = document.getElementById('viewPrivacyLink');

  /* -------------------------------
    TERMS MODAL
  -------------------------------- */
  const openTermsBtn = document.getElementById('openTermsModal');
  const closeTermsModalBtn = document.getElementById('closeTermsModal');
  const closeTermsFooterBtn = document.getElementById('closeTermsBtn');

  /* -------------------------------
    PRIVACY MODAL
  -------------------------------- */
  const openPrivacyBtn = document.getElementById('openPrivacyModal');
  const closePrivacyModalBtn = document.getElementById('closePrivacyModal');
  const closePrivacyFooterBtn = document.getElementById('closePrivacyBtn');

  /* -------------------------------
    FAQ MODAL
  -------------------------------- */
  const openFaqBtn = document.getElementById('openFaqModal');
  const closeFaqBtn = document.getElementById('closeFaqModal');


  /* -------------------------------
    DOWNLOAD MODAL HANDLERS
  -------------------------------- */
  function openDownloadModal() {
    downloadModal.classList.add('show');
    document.body.style.overflow = 'hidden';
    downloadError.classList.add('hidden');
  }

  function closeDownloadConfirmModal() {
    downloadModal.classList.remove('show');
    document.body.style.overflow = 'auto';
    agreeTerms.checked = false;
    agreePrivacy.checked = false;
    downloadError.classList.add('hidden');
  }

  downloadBtn1.addEventListener('click', e => { e.preventDefault(); openDownloadModal(); });
  downloadBtn2.addEventListener('click', e => { e.preventDefault(); openDownloadModal(); });

  closeDownloadModal.addEventListener('click', closeDownloadConfirmModal);
  cancelDownload.addEventListener('click', closeDownloadConfirmModal);


  /* Confirm Download */
  confirmDownload.addEventListener('click', () => {
    if (agreeTerms.checked && agreePrivacy.checked) {
      const link = document.createElement('a');
      link.href = "{{ asset('downloads/swisa-agap.apk') }}";
      link.download = 'swisa-agap.apk';
      document.body.appendChild(link);
      link.click();
      link.remove();
      closeDownloadConfirmModal();
    } else {
      downloadError.classList.remove('hidden');
    }
  });

  /* Hide error on checkbox change */
  [agreeTerms, agreePrivacy].forEach(cb => {
    cb.addEventListener('change', () => {
      if (agreeTerms.checked && agreePrivacy.checked) {
        downloadError.classList.add('hidden');
      }
    });
  });


  /* -------------------------------
    VIEW TERMS FROM DOWNLOAD MODAL
  -------------------------------- */
  viewTermsLink.addEventListener('click', e => {
    e.preventDefault();
    downloadModal.classList.remove('show');
    termsModal.classList.add('show');
    history.pushState({}, '', '/app-download/TermsandCondition');
  });


  /* -------------------------------
    VIEW PRIVACY FROM DOWNLOAD MODAL
  -------------------------------- */
  viewPrivacyLink.addEventListener('click', e => {
    e.preventDefault();
    downloadModal.classList.remove('show');
    privacyModal.classList.add('show');
    history.pushState({}, '', '/app-download/PrivacyPolicy');
  });


  /* -------------------------------
    TERMS MODAL
  -------------------------------- */
  function openTerms() {
    history.pushState({}, '', '/app-download/TermsandCondition');
    termsModal.classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  function closeTerms() {
    history.pushState({}, '', '/app-download');
    termsModal.classList.remove('show');
    document.body.style.overflow = 'auto';
  }

  openTermsBtn.addEventListener('click', e => { e.preventDefault(); openTerms(); });
  closeTermsModalBtn.addEventListener('click', closeTerms);
  closeTermsFooterBtn.addEventListener('click', closeTerms);


  /* -------------------------------
    PRIVACY MODAL
  -------------------------------- */
  function openPrivacy() {
    history.pushState({}, '', '/app-download/PrivacyPolicy');
    privacyModal.classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  function closePrivacy() {
    history.pushState({}, '', '/app-download');
    privacyModal.classList.remove('show');
    document.body.style.overflow = 'auto';
  }

  openPrivacyBtn.addEventListener('click', e => { e.preventDefault(); openPrivacy(); });
  closePrivacyModalBtn.addEventListener('click', closePrivacy);
  closePrivacyFooterBtn.addEventListener('click', closePrivacy);


  /* -------------------------------
    FAQ MODAL (AJAX + URL)
  -------------------------------- */
  openFaqBtn.addEventListener('click', e => {
    e.preventDefault();

    history.pushState({}, '', '/app-download/Faqs');   // URL update
    faqModal.classList.add('show');
    document.body.style.overflow = 'hidden';
  });

  closeFaqBtn.addEventListener('click', () => {
    history.pushState({}, '', '/app-download');
    faqModal.classList.remove('show');
    document.body.style.overflow = 'auto';
  });


  /* -------------------------------
    CLICK OUTSIDE TO CLOSE
  -------------------------------- */
  [downloadModal, termsModal, privacyModal, faqModal].forEach(modal => {
    modal.addEventListener('click', e => {
      if (e.target === modal) {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
        history.pushState({}, '', '/app-download');
      }
    });
  });


  /* -------------------------------
    ESC KEY
  -------------------------------- */
  document.addEventListener('keydown', e => {
    if (e.key !== 'Escape') return;

    if (downloadModal.classList.contains('show')) closeDownloadConfirmModal();
    if (termsModal.classList.contains('show')) closeTerms();
    if (privacyModal.classList.contains('show')) closePrivacy();
    if (faqModal.classList.contains('show')) {
      faqModal.classList.remove('show');
      history.pushState({}, '', '/app-download');
    }
  });
</script>


<script>
  document.getElementById('openFaqModal').addEventListener('click', function (e) {
      e.preventDefault();
      history.pushState({}, '', '/app-download/Faqs');

      let modal = document.getElementById('faqModal');
      modal.classList.add('show');

      let faqContainer = document.getElementById('faqContainer');
      faqContainer.innerHTML = `
          <p class="text-center text-gray-500">Loading FAQs...</p>
      `;

      fetch('/faqs/list')
          .then(res => res.json())
          .then(data => {
              if (!data.length) {
                  faqContainer.innerHTML = `
                      <p class="text-center text-gray-500">No FAQs available.</p>
                  `;
                  return;
              }

              let html = '';

              data.forEach((f, i) => {
                  html += `
                      <div class="mb-4">

                          <button class="faq-question text-[17px] font-semibold text-gray-700 w-full text-left"
                              data-target="faq-answer-${i}">
                              &gt; ${f.question}
                          </button>

                          <p id="faq-answer-${i}"
                            class="faq-answer text-gray-600 mt-1 pl-6 hidden">
                              ${f.answer}
                          </p>

                      </div>
                  `;
              });

              faqContainer.innerHTML = html;

              const allAnswers = document.querySelectorAll('.faq-answer');

              document.querySelectorAll('.faq-question').forEach(btn => {
                  btn.addEventListener('click', () => {

                      let targetId = btn.getAttribute('data-target');
                      let currentAnswer = document.getElementById(targetId);

                      // CLOSE ALL OTHER ANSWERS
                      allAnswers.forEach(ans => {
                          if (ans.id !== targetId && !ans.classList.contains('hidden')) {
                              ans.classList.remove('show');

                              setTimeout(() => {
                                  ans.classList.add('hidden');
                              }, 200);
                          }
                      });

                      // TOGGLE CURRENT ANSWER
                      if (currentAnswer.classList.contains('hidden')) {
                          currentAnswer.classList.remove('hidden');

                          setTimeout(() => {
                              currentAnswer.classList.add('show');
                          }, 10);

                      } else {
                          currentAnswer.classList.remove('show');

                          setTimeout(() => {
                              currentAnswer.classList.add('hidden');
                          }, 200);
                      }

                  });
              });

          });
  });

  document.getElementById('closeFaqModal').addEventListener('click', function () {

      // return URL back to the download page
      history.pushState({}, '', '/app-download');

      document.getElementById('faqModal').classList.remove('show');
  });

</script>

<script>
  const openBtn = document.getElementById('openUserManual');
  const closeBtn = document.getElementById('closeUserManual');
  const modal = document.getElementById('userManualModal');
  const video = document.getElementById('userManualVideo');

  openBtn.addEventListener('click', function(e) {
      e.preventDefault();
      modal.classList.remove('hidden');
      video.play();
  });

  closeBtn.addEventListener('click', function() {
      video.pause();
      video.currentTime = 0;
      modal.classList.add('hidden');
  });

  // Optional: close modal when clicking outside the video
  modal.addEventListener('click', function(e) {
      if (e.target === modal) {
          video.pause();
          video.currentTime = 0;
          modal.classList.add('hidden');
      }
  });

</script>


</body>
</html>
