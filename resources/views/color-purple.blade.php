{{-- resources/views/color-purple-blog.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Empowerment in The Color Purple | PurpleVoice Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8B5CF6',
                        dark: '#020617'
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        html { scroll-behavior: smooth; }

        body {
            background-color: #020617;
            color: #F8FAFC;
        }

        /* Animation System */
        .animate-up,
        .animate-left {
            opacity: 0;
            transition: all 1s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .animate-up {
            transform: translateY(30px);
        }

        .animate-left {
            transform: translateX(40px);
        }

        .reveal {
            opacity: 1 !important;
            transform: translate(0, 0) !important;
        }

        .delay-1 { transition-delay: .1s; }
        .delay-2 { transition-delay: .2s; }
        .delay-3 { transition-delay: .3s; }
        .delay-4 { transition-delay: .4s; }
        .delay-5 { transition-delay: .5s; }

        .text-gradient {
            background: linear-gradient(90deg, #a855f7, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="font-sans">

{{-- HEADER --}}
<header class="sticky top-0 z-50 bg-dark/90 backdrop-blur border-b border-primary/20">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="#" class="font-serif text-xl font-bold hover:text-primary transition">
            The Color <span class="text-gradient">Purple</span>
        </a>
        <nav class="hidden sm:flex gap-6 text-sm text-slate-300">
            <a href="#themes" class="hover:text-primary">Themes</a>
            <a href="#impact" class="hover:text-primary">Impact</a>
            <a href="#author" class="hover:text-primary">Author</a>
        </nav>
    </div>
</header>

{{-- HERO --}}
<section class="pt-20 pb-28 text-center">
    <div class="max-w-4xl mx-auto px-6 space-y-6">
        <p class="text-xs uppercase tracking-widest text-primary animate-up">
            Literary Analysis · Inspiration
        </p>

        <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight animate-up delay-1">
            From Celie to Queen:
            <span class="text-gradient block">The Voice of the Black Girl’s Journey</span>
        </h1>

        <p class="text-slate-300 max-w-2xl mx-auto animate-up delay-2">
            Alice Walker’s <em>The Color Purple</em> is a timeless testament to resilience,
            sisterhood, and the power of a Black woman reclaiming her voice.
        </p>

        <div class="flex justify-center gap-3 text-xs animate-up delay-3">
            <span class="px-4 py-1 rounded-full border border-primary/40 bg-primary/10">
                Alice Walker
            </span>
            <span class="px-4 py-1 rounded-full border border-primary/40 bg-primary/10">
                Published 1982
            </span>
        </div>
    </div>
</section>

{{-- FEATURE IMAGE --}}
<section class="relative h-[28rem]">
<img
    src="{{ asset('images/color-purple.png') }}"
    alt="The Color Purple – Empowerment Visual"
    class="absolute inset-0 w-full h-full object-cover"
/>

    <div class="absolute inset-0 bg-dark/60"></div>
</section>

{{-- MAIN CONTENT --}}
<div class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row gap-12">

    {{-- ARTICLE --}}
    <main class="md:w-3/4 space-y-20">

        {{-- SECTION 1 --}}
        <section id="story-foundation" class="space-y-6">
            <h2 class="font-serif text-3xl font-bold border-l-4 border-primary pl-4 animate-up">
                Finding the Pen: Celie’s Epistolary Foundation
            </h2>

            <p class="text-slate-300 animate-up delay-1">
                Told entirely through letters, <em>The Color Purple</em> grants readers
                unfiltered access to Celie’s inner world—her pain, fear, and eventual awakening.
            </p>

            <blockquote class="border-l-4 border-fuchsia-400 pl-4 italic text-slate-400 animate-up delay-2">
                Celie’s transformation from silence to self-expression reveals how language
                becomes a tool of survival and empowerment.
            </blockquote>

            <div class="grid sm:grid-cols-2 gap-4 pt-4 animate-up delay-3">
                <div class="bg-dark/80 p-4 rounded-xl border border-primary/30">
                    <p class="font-semibold text-fuchsia-300">Epistolary Form</p>
                    <p class="text-sm text-slate-300">
                        Letters serve as Celie’s private sanctuary and evolving voice.
                    </p>
                </div>

                <div class="bg-dark/80 p-4 rounded-xl border border-primary/30">
                    <p class="font-semibold text-fuchsia-300">Womanist Lens</p>
                    <p class="text-sm text-slate-300">
                        Walker centers Black women’s experiences beyond traditional feminism.
                    </p>
                </div>
            </div>
        </section>

        {{-- SECTION 2 --}}
        <section id="themes" class="space-y-6">
            <h2 class="font-serif text-3xl font-bold border-l-4 border-primary pl-4 animate-up">
                Sisterhood, Voice, and Liberation
            </h2>

            <div class="grid lg:grid-cols-2 gap-6 pt-4">
                <div class="bg-dark/80 p-6 rounded-xl animate-up delay-1">
                    <h3 class="text-emerald-300 font-semibold mb-2">Sisterhood</h3>
                    <p class="text-slate-300 text-sm">
                        Relationships with Shug, Sofia, and Nettie model resistance and love.
                    </p>
                </div>

                <div class="bg-dark/80 p-6 rounded-xl animate-up delay-2">
                    <h3 class="text-sky-300 font-semibold mb-2">Redefining God</h3>
                    <p class="text-slate-300 text-sm">
                        Divinity becomes presence, joy, and appreciation—symbolized by purple.
                    </p>
                </div>

                <div class="bg-dark/80 p-6 rounded-xl animate-up delay-3">
                    <h3 class="text-fuchsia-300 font-semibold mb-2">Economic Freedom</h3>
                    <p class="text-slate-300 text-sm">
                        Celie’s pants business represents autonomy and self-worth.
                    </p>
                </div>

                <div class="bg-dark/80 p-6 rounded-xl animate-up delay-4">
                    <h3 class="text-fuchsia-300 font-semibold mb-2">Language as Power</h3>
                    <p class="text-slate-300 text-sm">
                        AAVE becomes a language of truth, not limitation.
                    </p>
                </div>
            </div>
        </section>

        {{-- SECTION 3 --}}
        <section id="impact" class="space-y-6">
            <h2 class="font-serif text-3xl font-bold border-l-4 border-primary pl-4 animate-up">
                A Timeless Literary Legacy
            </h2>

            <div class="grid md:grid-cols-3 gap-4 pt-4">
                <div class="text-center p-4 border border-primary/40 rounded-xl animate-up delay-1">
                    <p class="text-2xl font-bold text-primary">1983</p>
                    <p class="text-xs text-slate-400">Pulitzer Prize</p>
                </div>

                <div class="text-center p-4 border border-primary/40 rounded-xl animate-up delay-2">
                    <p class="text-2xl font-bold text-primary">1985</p>
                    <p class="text-xs text-slate-400">Film Adaptation</p>
                </div>

                <div class="text-center p-4 border border-primary/40 rounded-xl animate-up delay-3">
                    <p class="text-2xl font-bold text-primary">Womanism</p>
                    <p class="text-xs text-slate-400">Enduring Theory</p>
                </div>
            </div>
        </section>

    </main>

    {{-- SIDEBAR --}}
    <aside class="hidden md:block md:w-1/4">
        <div class="sticky top-24 p-6 bg-dark/80 border border-primary/30 rounded-xl animate-left delay-3">
            <h3 class="text-primary font-bold mb-4">Contents</h3>
            <ul class="space-y-3 text-sm text-slate-300">
                <li><a href="#story-foundation" class="hover:text-primary">Story Foundation</a></li>
                <li><a href="#themes" class="hover:text-primary">Themes</a></li>
                <li><a href="#impact" class="hover:text-primary">Impact</a></li>
            </ul>
        </div>
    </aside>
</div>

{{-- FOOTER --}}
<footer id="author" class="border-t border-primary/20 py-10 text-center text-sm text-slate-400">
    <p>PurpleVoice Blog © 2025</p>
    <p>A literary exploration inspired by Alice Walker</p>
</footer>

{{-- SCROLL ANIMATION --}}
<script>
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.animate-up, .animate-left')
        .forEach(el => observer.observe(el));
</script>

</body>
</html>





{{-- resources/views/color-purple.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Color Purple | Web Presentation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            background: radial-gradient(circle at top, #4c1d95 0, #020617 45%, #020617 100%);
            color: #f9fafb;
        }

        section.slide {
            min-height: 100vh;
            position: relative;
        }

        /* Base animation classes */
        .fade-up {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-left {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-right {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .zoom-in {
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .reveal {
            opacity: 1 !important;
            transform: translate(0, 0) scale(1) !important;
        }

        .delay-1 { transition-delay: 0.15s; }
        .delay-2 { transition-delay: 0.3s; }
        .delay-3 { transition-delay: 0.45s; }
        .delay-4 { transition-delay: 0.6s; }

        /* Floating + pulsing SVG helpers */
        .float-slow {
            animation: float-slow 8s ease-in-out infinite;
        }

        .float-fast {
            animation: float-fast 4s ease-in-out infinite;
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-18px); }
        }

        @keyframes float-fast {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .pulse-soft {
            animation: pulse-soft 2.8s infinite;
        }

        @keyframes pulse-soft {
            0% { opacity: 0.4; transform: scale(0.98); }
            50% { opacity: 1; transform: scale(1); }
            100% { opacity: 0.4; transform: scale(0.98); }
        }

        /* Gradient border card */
        .gradient-card {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
        }

        .gradient-card::before {
            content: "";
            position: absolute;
            inset: -2px;
            z-index: -1;
            background: conic-gradient(from 180deg,
                    #a855f7,
                    #ec4899,
                    #f97316,
                    #22c55e,
                    #3b82f6,
                    #a855f7);
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            to { transform: rotate(360deg); }
        }

        .gradient-card-inner {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(18px);
        }

    </style>
</head>

<body class="text-slate-50">

{{-- Floating background decoration --}}
<div class="pointer-events-none fixed inset-0 -z-10 overflow-hidden">
    <svg class="absolute -top-10 -left-10 w-72 h-72 blur-3xl opacity-40 float-slow"
         viewBox="0 0 200 200">
        <defs>
            <radialGradient id="bg1" cx="50%" cy="50%" r="50%">
                <stop offset="0%" stop-color="#a855f7"/>
                <stop offset="100%" stop-color="#0f172a" stop-opacity="0"/>
            </radialGradient>
        </defs>
        <circle cx="100" cy="100" r="100" fill="url(#bg1)"/>
    </svg>

    <svg class="absolute bottom-0 right-0 w-80 h-80 blur-3xl opacity-40 float-slow"
         viewBox="0 0 200 200">
        <defs>
            <radialGradient id="bg2" cx="50%" cy="50%" r="50%">
                <stop offset="0%" stop-color="#ec4899"/>
                <stop offset="100%" stop-color="#020617" stop-opacity="0"/>
            </radialGradient>
        </defs>
        <circle cx="100" cy="100" r="100" fill="url(#bg2)"/>
    </svg>
</div>

{{-- SLIDE 1 : HERO / TITLE --}}
<section class="slide flex items-center justify-center bg-gradient-to-br from-purple-800 via-fuchsia-600 to-rose-500 relative overflow-hidden">
    {{-- radial overlay --}}
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(15,23,42,0.4),transparent_60%)]"></div>

    <div class="relative text-center space-y-6 px-6 max-w-3xl fade-up">
        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight drop-shadow-xl">
            The Color Purple
        </h1>
        <p class="text-lg md:text-xl opacity-90">
            A Modern Literary Web Presentation
        </p>

        {{-- Animated SVG: opening book with rays --}}
        <svg class="mx-auto w-28 h-28 float-fast" viewBox="0 0 200 200" fill="none">
            <defs>
                <linearGradient id="book-grad" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0%" stop-color="#f9fafb"/>
                    <stop offset="100%" stop-color="#e879f9"/>
                </linearGradient>
            </defs>
            <g stroke="url(#book-grad)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <path d="M40 60c0-10 8-18 18-18h52v96H58c-10 0-18 8-18 18V60z" />
                <path d="M110 42v96c0-10 8-18 18-18h32V24h-32c-10 0-18 8-18 18z" />
                <path d="M58 48h52" />
                <path d="M128 40l16-10" />
                <path d="M132 54l20-4" />
                <path d="M128 68l16 10" />
            </g>
        </svg>

        <p class="text-sm opacity-80">
            Alice Walker · Epistolary · Feminist / Womanist · Realist Bildungsroman [file:1]
        </p>

        <div class="flex justify-center gap-3 text-xs md:text-sm">
            <span class="px-3 py-1 rounded-full bg-slate-900/30 border border-white/30">
                Published 1982 [file:1]
            </span>
            <span class="px-3 py-1 rounded-full bg-slate-900/30 border border-white/30">
                Pulitzer & National Book Award 1983 [file:1]
            </span>
        </div>

        {{-- Scroll hint --}}
        <div class="mt-4 flex flex-col items-center gap-2 text-xs opacity-80">
            <span>Scroll to explore the story</span>
            <svg class="w-6 h-6 animate-bounce" viewBox="0 0 24 24" fill="none">
                <path d="M12 5v14" stroke="#f9fafb" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M7 13l5 5 5-5" stroke="#f9fafb" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </div>
    </div>
</section>

{{-- SLIDE 2 : ABOUT --}}
<section class="slide flex items-center">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-[1.4fr,1fr] gap-12 items-center">
        <div class="fade-right">
            <h2 class="text-3xl font-bold mb-4 border-l-4 border-purple-500 pl-3">
                About the Novel
            </h2>
            <p class="mb-3 text-sm md:text-base">
                <em>The Color Purple</em> is an epistolary novel told through letters written mostly by Celie, a Black woman living in the early 20th‑century American South, giving readers direct access to her private thoughts and struggles. [file:1]
            </p>
            <p class="text-sm md:text-base">
                The narrative follows Celie’s journey from an abused, silenced girl into an empowered woman who discovers love, independence, and self‑worth through sisterhood, work, and redefining her understanding of God. [file:1]
            </p>

            <div class="mt-5 grid grid-cols-2 gap-3 text-xs md:text-sm">
                <div class="gradient-card">
                    <div class="gradient-card-inner h-full p-3 rounded-[0.95rem]">
                        <p class="font-semibold text-purple-300">Form</p>
                        <p>Epistolary novel (letters) with African American Vernacular English. [file:1]</p>
                    </div>
                </div>
                <div class="gradient-card">
                    <div class="gradient-card-inner h-full p-3 rounded-[0.95rem]">
                        <p class="font-semibold text-purple-300">Movements</p>
                        <p>Feminist / womanist, realism, and Bildungsroman (coming‑of‑age). [file:1]</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Decorative SVG: letters orbit --}}
        <div class="fade-left delay-2">
            <svg class="w-full max-w-sm mx-auto pulse-soft" viewBox="0 0 260 260" fill="none">
                <defs>
                    <radialGradient id="orb-grad" cx="50%" cy="50%" r="50%">
                        <stop offset="0%" stop-color="#a855f7" stop-opacity="0.9"/>
                        <stop offset="100%" stop-color="#020617" stop-opacity="0"/>
                    </radialGradient>
                </defs>
                <circle cx="130" cy="130" r="110" fill="url(#orb-grad)" />
                <circle cx="130" cy="130" r="80" stroke="#a855f7" stroke-width="1.5" stroke-dasharray="4 6" />
                <circle cx="130" cy="130" r="52" stroke="#e879f9" stroke-width="1.5" stroke-dasharray="2 4" />

                {{-- Envelopes as orbiting letters --}}
                <g stroke="#e5e7eb" stroke-width="1.5" fill="none">
                    <rect x="60" y="60" width="40" height="26" rx="3" />
                    <path d="M60 63l20 15 20-15" />
                    <rect x="160" y="90" width="40" height="26" rx="3" />
                    <path d="M160 93l20 15 20-15" />
                    <rect x="100" y="150" width="40" height="26" rx="3" />
                    <path d="M100 153l20 15 20-15" />
                </g>

                <text x="50%" y="50%" text-anchor="middle" fill="#f9fafb" font-size="14" dy=".3em">
                    Celie’s Letters
                </text>
            </svg>
        </div>
    </div>
</section>

{{-- SLIDE 3 : TIMELINE --}}
<section class="slide flex items-center bg-slate-950/70">
    <div class="max-w-6xl mx-auto px-6 w-full">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
            <h2 class="text-3xl font-bold border-l-4 border-purple-500 pl-3 fade-right">
                Historical Timeline
            </h2>
            <p class="text-xs md:text-sm text-slate-300 fade-left delay-1">
                From a 1982 publication to award‑winning adaptations on stage and screen. [file:1]
            </p>
        </div>

        <div class="grid md:grid-cols-4 gap-6 text-sm">
            <div class="gradient-card fade-up">
                <div class="gradient-card-inner p-5 rounded-[0.95rem]">
                    <span class="text-purple-400 font-bold text-sm">1982</span>
                    <p class="mt-2">
                        The novel is published and immediately draws attention for its portrayal of race, gender inequality, and resilience. [file:1]
                    </p>
                </div>
            </div>
            <div class="gradient-card fade-up delay-1">
                <div class="gradient-card-inner p-5 rounded-[0.95rem]">
                    <span class="text-purple-400 font-bold text-sm">1983</span>
                    <p class="mt-2">
                        Wins the Pulitzer Prize for Fiction and the National Book Award, cementing Alice Walker’s literary impact. [file:1]
                    </p>
                </div>
            </div>
            <div class="gradient-card fade-up delay-2">
                <div class="gradient-card-inner p-5 rounded-[0.95rem]">
                    <span class="text-purple-400 font-bold text-sm">1985</span>
                    <p class="mt-2">
                        Film adaptation directed by Steven Spielberg receives 11 Academy Award nominations. [file:1]
                    </p>
                </div>
            </div>
            <div class="gradient-card fade-up delay-3">
                <div class="gradient-card-inner p-5 rounded-[0.95rem]">
                    <span class="text-purple-400 font-bold text-sm">2005–2023</span>
                    <p class="mt-2">
                        The story becomes a Broadway musical with Tony recognition and a 2023 film‑musical honored at the NAACP Image Awards. [file:1]
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SLIDE 4 : STORY OVERVIEW --}}
<section class="slide flex items-center">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold mb-6 border-l-4 border-purple-500 pl-3 fade-right">
            Story Overview
        </h2>

        <div class="grid md:grid-cols-4 gap-4 text-sm">
            <div class="bg-slate-900/80 rounded-xl p-4 fade-up">
                <h3 class="font-semibold text-purple-300 mb-1">Oppression</h3>
                <p>
                    Celie endures sexual abuse, loss of her children, and a forced marriage to Albert, where she is beaten and treated like a servant. [file:1]
                </p>
            </div>
            <div class="bg-slate-900/80 rounded-xl p-4 fade-up delay-1">
                <h3 class="font-semibold text-purple-300 mb-1">Connection</h3>
                <p>
                    Strong women like Sofia and Shug Avery enter her life, modeling resistance to abuse and offering Celie genuine affection. [file:1]
                </p>
            </div>
            <div class="bg-slate-900/80 rounded-xl p-4 fade-up delay-2">
                <h3 class="font-semibold text-purple-300 mb-1">Truth</h3>
                <p>
                    Nettie’s hidden letters reveal Celie’s children are alive, that Nettie is a missionary in Africa, and that “Pa” is not their true father. [file:1]
                </p>
            </div>
            <div class="bg-slate-900/80 rounded-xl p-4 fade-up delay-3">
                <h3 class="font-semibold text-purple-300 mb-1">Freedom</h3>
                <p>
                    Celie leaves Albert, starts a pants‑making business in Memphis, and is ultimately reunited with Nettie and her children. [file:1]
                </p>
            </div>
        </div>

        {{-- Subtle SVG timeline underline --}}
        <div class="mt-8 fade-up delay-2">
            <svg class="w-full h-14" viewBox="0 0 400 40" fill="none">
                <path d="M10 20 Q 80 0 150 20 T 290 20 T 390 20"
                      stroke="#a855f7" stroke-width="1.5" stroke-linecap="round"
                      stroke-dasharray="4 6"/>
                <circle cx="10" cy="20" r="3" fill="#a855f7"/>
                <circle cx="150" cy="20" r="3" fill="#a855f7"/>
                <circle cx="290" cy="20" r="3" fill="#a855f7"/>
                <circle cx="390" cy="20" r="3" fill="#a855f7"/>
            </svg>
        </div>
    </div>
</section>

{{-- SLIDE 5 : THEMES / ANALYSIS --}}
<section class="slide flex items-center bg-slate-950/80">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold mb-6 border-l-4 border-purple-500 pl-3 fade-right">
            Themes & Literary Lens
        </h2>

        <div class="grid md:grid-cols-3 gap-6 text-sm">
            <div class="bg-slate-900/90 p-5 rounded-xl fade-up">
                <h3 class="text-emerald-300 font-semibold mb-1">Womanism & Sisterhood</h3>
                <p>
                    The novel draws from feminist and womanist thought by centering Black women’s experiences and showing how bonds between Celie, Nettie, Shug, and Sofia become a source of empowerment. [file:1]
                </p>
            </div>
            <div class="bg-slate-900/90 p-5 rounded-xl fade-up delay-1">
                <h3 class="text-emerald-300 font-semibold mb-1">Realism & Oppression</h3>
                <p>
                    Using realism, the story portrays domestic violence, racism, and gender oppression in the early 20th‑century South without idealization, confronting readers with harsh social realities. [file:1]
                </p>
            </div>
            <div class="bg-slate-900/90 p-5 rounded-xl fade-up delay-2">
                <h3 class="text-emerald-300 font-semibold mb-1">Coming‑of‑Age</h3>
                <p>
                    As a Bildungsroman, the book follows Celie’s growth from powerlessness to independence, with the shifting addressee of her letters marking her spiritual and emotional development. [file:1]
                </p>
            </div>
        </div>

        <div class="mt-6 grid md:grid-cols-2 gap-6 text-sm">
            <div class="bg-slate-900/90 p-5 rounded-xl fade-left delay-1">
                <h3 class="text-sky-300 font-semibold mb-1">Language & Voice</h3>
                <p>
                    Walker’s use of African American Vernacular English gives Celie’s letters an authentic, raw voice that reflects her culture and social position while making the narrative intimate and direct. [file:1]
                </p>
            </div>
            <div class="bg-slate-900/90 p-5 rounded-xl fade-left delay-2">
                <h3 class="text-sky-300 font-semibold mb-1">Relevance Today</h3>
                <p>
                    The novel remains relevant because issues like domestic and sexual violence, intersectional oppression, and the need for economic independence continue to shape lives in the 21st century. [file:1]
                </p>
            </div>
        </div>
    </div>
</section>

{{-- SLIDE 6 : SYMBOLS --}}
<section class="slide flex items-center">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6 mb-6">
            <h2 class="text-3xl font-bold border-l-4 border-purple-500 pl-3 fade-right">
                Symbols in the Novel
            </h2>
            {{-- SVG cluster of symbols --}}
            <div class="fade-left delay-1">
                <svg class="w-40 h-40 mx-auto float-fast" viewBox="0 0 200 200" fill="none">
                    <circle cx="100" cy="100" r="70" stroke="#a855f7" stroke-width="2" />
                    {{-- Purple flower --}}
                    <circle cx="70" cy="80" r="18" fill="#7c3aed" opacity="0.9"/>
                    <circle cx="65" cy="75" r="6" fill="#f9fafb"/>
                    {{-- Dress --}}
                    <path d="M130 60l12 20-10 36h-16l-10-36 12-20z" fill="#e879f9" opacity="0.9"/>
                    {{-- Letter --}}
                    <rect x="80" y="120" width="50" height="30" rx="4" stroke="#e5e7eb" stroke-width="1.5" />
                    <path d="M80 123l25 17 25-17" stroke="#e5e7eb" stroke-width="1.5" />
                </svg>
            </div>
        </div>

        <div class="grid md:grid-cols-4 gap-4 text-sm">
            <div class="bg-slate-900/90 p-4 rounded-xl fade-up">
                <h3 class="font-semibold text-indigo-300 mb-1">The Color Purple</h3>
                <p>
                    Represents beauty, joy, and the richness of life that Celie has been taught to ignore but gradually learns to notice and appreciate. [file:1]
                </p>
            </div>
            <div class="bg-slate-900/90 p-4 rounded-xl fade-up delay-1">
                <h3 class="font-semibold text-indigo-300 mb-1">Purple Dress</h3>
                <p>
                    Symbolizes Celie’s desire for dignity and self‑worth, and her wish to be seen as valuable and beautiful. [file:1]
                </p>
            </div>
            <div class="bg-slate-900/90 p-4 rounded-xl fade-up delay-2">
                <h3 class="font-semibold text-indigo-300 mb-1">Letters</h3>
                <p>
                    Stand for Celie’s voice and existence in a world that tries to silence her, providing a space for self‑expression and truth. [file:1]
                </p>
            </div>
            <div class="bg-slate-900/90 p-4 rounded-xl fade-up delay-3">
                <h3 class="font-semibold text-indigo-300 mb-1">Quilt</h3>
                <p>
                    The quilt reflects sisterhood and creative bonding, especially between Celie and Sofia, as they turn pain into art. [file:1]
                </p>
            </div>
        </div>
    </div>
</section>

{{-- SLIDE 7 : WHY IT’S GREAT / IMPACT --}}
<section class="slide flex items-center bg-gradient-to-br from-purple-900 via-slate-950 to-slate-950">
    <div class="max-w-4xl mx-auto px-6 text-center space-y-6">
        <h2 class="text-3xl font-bold fade-up">
            Why This Novel Matters
        </h2>
        <p class="fade-up delay-1 text-sm md:text-base">
            <em>The Color Purple</em> is celebrated for its artistry, intellectual depth, and spiritual value, offering a timeless story about resilience, love, and self‑respect. [file:1]
        </p>
        <p class="opacity-80 text-xs md:text-sm fade-up delay-2">
            Its themes remain universal and permanent, resonating with readers across cultures and generations who recognize its honest portrayal of oppression and healing. [file:1]
        </p>

        {{-- Tiny “badge” table styled as modern card --}}
        <div class="mt-4 grid md:grid-cols-3 gap-3 text-xs md:text-sm fade-up delay-3">
            <div class="bg-slate-950/60 border border-purple-500/60 rounded-xl px-4 py-3">
                <p class="font-semibold text-purple-300">Artistry & Style</p>
                <p>Vivid imagery, unique voice, and powerful epistolary structure. [file:1]</p>
            </div>
            <div class="bg-slate-950/60 border border-purple-500/60 rounded-xl px-4 py-3">
                <p class="font-semibold text-purple-300">Universality</p>
                <p>Themes of family, faith, trauma, and liberation speak globally. [file:1]</p>
            </div>
            <div class="bg-slate-950/60 border border-purple-500/60 rounded-xl px-4 py-3">
                <p class="font-semibold text-purple-300">Awards & Legacy</p>
                <p>Pulitzer, major adaptations, and ongoing critical recognition. [file:1]</p>
            </div>
        </div>

        {{-- Heart SVG --}}
        <svg class="mx-auto w-16 h-16 pulse-soft fade-up delay-4" viewBox="0 0 24 24" fill="none">
            <path d="M12 21s-8-6.5-8-11a5 5 0 0 1 8-3 5 5 0 0 1 8 3c0 4.5-8 11-8 11z"
                  stroke="#f9fafb" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
</section>

{{-- Minimal JS: IntersectionObserver for scroll animations --}}
<script>
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal');
                }
            });
        },
        { threshold: 0.25 }
    );

    document.querySelectorAll('.fade-up, .fade-left, .fade-right, .zoom-in')
        .forEach(el => observer.observe(el));
</script>

</body>
</html>
