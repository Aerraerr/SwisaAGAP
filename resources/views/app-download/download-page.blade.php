<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
        Empowering farmers, fishers, and agribusiness owners with real-time data, training modules, and community support — anytime, anywhere.
      </p>
      <p class="text-emerald-400 font-semibold mb-2 text-lg">Now available for Android</p>

      <a href="{{ asset('downloads/swisa-agap.apk') }}" download
        class="w-[220px] inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-500 text-white font-semibold rounded-full shadow-lg hover:from-green-700 hover:to-emerald-600 transition transform hover:scale-105">
        <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
          <polyline points="7 10 12 15 17 10"/>
          <line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
        Download APK
      </a>

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
      Why Choose Our App?
    </h2>
    <div class="text-center grid gap-8 md:grid-cols-3">
      <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
        <h3 class="font-bold text-lg mb-2 text-emerald-400">Fast & Lightweight</h3>
        <p class="text-gray-200 text-sm">Optimized to perform smoothly even in areas with limited connectivity.</p>
      </div>
      <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
        <h3 class="font-bold text-lg mb-2 text-emerald-400">All-in-One Platform</h3>
        <p class="text-gray-200 text-sm">Access reports, events, and member tools all in one app.</p>
      </div>
      <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
        <h3 class="font-bold text-lg mb-2 text-emerald-400">Community Driven</h3>
        <p class="text-gray-200 text-sm">Built for and with the SWISA community to keep everyone connected.</p>
      </div>
    </div>
  </section>

  <!-- Visit Section -->
  <section id="visit" class="py-16 relative z-10 text-white text-center">
    <div class="max-w-4xl mx-auto px-6" data-aos="fade-up">
      <h2 class="text-3xl font-bold mb-4 text-white">Get Started Today</h2>
      <p class="text-gray-200 mb-6">
        Experience digital transformation in agriculture with the SWISA-AGAP app. Download now and join the community.
      </p>
      <a href="{{ asset('downloads/swisa-agap.apk') }}" download
        class="w-[220px] mt-3 inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-500 text-white font-semibold rounded-full shadow-lg hover:from-green-700 hover:to-emerald-600 transition transform hover:scale-105">
        <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
          <polyline points="7 10 12 15 17 10"/>
          <line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
        Download
      </a>
    </div>
  </section>

  <!-- Footer -->
<!-- Footer -->
<footer class="bg-[#043B2E] text-white py-10 relative z-10 ">
    <div class="max-w-full mx-auto px-6">

        <!-- TOP GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 pb-10">

            <!-- Agency -->
            <div class="space-y-3">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/swisa-logo.png') }}" alt="Logo 1" class="h-[100px] w-auto object-contain">
                    <img src="{{ asset('images/swisa-logov1.png') }}" alt="Logo 1" class="h-[88px] w-auto object-contain">
                </div>


                <p class="text-base font-semibold text-white">SwisaAGAP</p>

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
                    <li><a href="#" class="text-gray-300 hover:text-emerald-400 transition">Events Calendar</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div class="space-y-2">
                <p class="font-bold text-white text-base">Resources</p>

                <ul class="space-y-1">
                    <li><a href="#" class="text-gray-300 hover:text-emerald-400 transition">User Manual</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-emerald-400 transition">FAQs</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-emerald-400 transition">Training Modules</a></li>
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
                <a href="#" class="text-gray-300 hover:text-emerald-400 transition">Privacy Policy</a>
                <a href="#" class="text-gray-300 hover:text-emerald-400 transition">Terms and Conditions</a>
            </div>

        </div>

    </div>
</footer>


  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 800, once: true, easing: 'ease-out-cubic' });
    document.getElementById('menu-toggle').addEventListener('click', () => {
      document.getElementById('mobile-menu').classList.toggle('hidden');
    });
  </script>

</body>
</html>
