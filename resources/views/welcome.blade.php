@php
    $year = now()->year;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CDA-DBRS | Data Breach Reporting</title>
    <link rel="icon" href="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/js/app.js'])

    <style>
        /* Modern Cybersecurity Theme Variables */
        :root { 
            --primary-dark: #0f172a; 
            --secondary-dark: #1e293b; 
            --accent-blue: #3b82f6; 
            --accent-blue-hover: #2563eb; 
            --alert-red: #ef4444; 
            --alert-red-hover: #dc2626; 
            --text-main: #f8fafc; 
            --text-muted: #94a3b8; 
            --glass-bg: rgba(15, 23, 42, 0.75); 
            --glass-border: rgba(255, 255, 255, 0.1); 
        }

        /* Base Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        /* Body Typography & Animated Gradient Background */
        body { 
            background: linear-gradient(-45deg, #020617, #0f172a, #082f49, #172554, #1e293b); background-size: 400% 400%; animation: gradientBG 15s ease infinite; color: var(--text-main); font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, sans-serif; -webkit-font-smoothing: antialiased; line-height: 1.6; overflow-x: hidden; min-height: 100vh; }
        a { text-decoration: none; }
        ul { list-style: none; }
        .hidden { display: none !important; }

        /* Animations */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes glow { 0%, 100% { box-shadow: 0 0 15px rgba(239, 68, 68, 0.5); } 50% { box-shadow: 0 0 30px rgba(239, 68, 68, 0.8); } }
        
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }

        /* Header (Glassmorphism) */
        .app-header { background-color: var(--glass-bg); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); position: sticky; top: 0; z-index: 50; border-bottom: 1px solid var(--glass-border); }
        .header-gradient { height: 3px; background: linear-gradient(90deg, var(--accent-blue), var(--alert-red)); }
        .container { max-width: 1280px; margin: 0 auto; padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; }

        /* Branding */
        .brand { font-size: 1.5rem; font-weight: 800; color: #ffffff; display: flex; align-items: center; gap: 0.75rem; letter-spacing: -0.025em; }
        .brand img { width: 44px; height: 44px; object-fit: contain; transition: transform 0.3s ease; }
        .brand:hover img { transform: scale(1.1) rotate(-5deg); }

        /* Navigation */
        .nav-links { display: flex; gap: 1rem; align-items: center; font-weight: 600; font-size: 0.95rem; }
        .nav-link { color: #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 8px; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease; border: 1px solid transparent; }
        .nav-link:hover { color: #ffffff; background-color: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.3); }
        .nav-link-logout { color: #fca5a5; background: none; cursor: pointer; font: inherit; }
        .nav-link-logout:hover { color: #ffffff; background-color: rgba(239, 68, 68, 0.15); border-color: rgba(239, 68, 68, 0.3); }

        /* Hero Section */
        .hero { position: relative; width: 100%; min-height: 80vh; display: flex; align-items: center; justify-content: center; background-image: url("{{ asset('images/cda-dbrs-banner.svg') }}"); background-size: cover; background-position: center; background-repeat: no-repeat; overflow: hidden; }

        /* NEW: Hero Overlay */
        .hero::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.75; background: linear-gradient(135deg, rgba(2, 6, 23, 0.85) 0%, rgba(15, 23, 42, 0.75) 100%); z-index: 1;}

        .hero-content { position: relative; z-index: 10; text-align: center; padding: 4rem 1.5rem; max-width: 900px; }
        .hero-content p { font-weight: bold; color: white; }
        .status-badge { display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); color: #60a5fa; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600; margin-bottom: 2rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .hero-title { font-size: 3.5rem; font-weight: 800; margin-bottom: 1.5rem; line-height: 1.1; letter-spacing: -0.02em; }
        .text-gradient { background: linear-gradient(to right, #60a5fa, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-subtitle { font-size: 1.25rem; color: var(--text-muted); margin-bottom: 3.5rem; line-height: 1.6; max-width: 700px; margin-left: auto; margin-right: auto; }

        /* Buttons */
        .btn-danger { display: inline-flex; align-items: center; gap: 0.75rem; background-color: var(--alert-red); color: #ffffff; padding: 0.75rem 2.5rem; border-radius: 12px; font-size: 1.125rem; font-weight: 700; transition: all 0.3s ease; animation: glow 3s infinite alternate; border: 1px solid #f87171; }
        .btn-danger:hover { background-color: var(--alert-red-hover); transform: translateY(-3px); box-shadow: 0 15px 25px -5px rgba(239, 68, 68, 0.4); }

        /* Services Section */
        .services { padding: 3rem 0; background-color: transparent; position: relative; }
        .section-title { font-size: 2.25rem; font-weight: 800; text-align: center; margin-bottom: 3rem; color: #ffffff; }
        .service-grid { display: flex; flex-wrap: wrap; justify-content: center; gap: 2rem; padding: 0 1.5rem; }
        .service-card { flex: 1 1 320px; max-width: 400px; background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(10px); border-radius: 16px; transition: all 0.4s ease; border: 1px solid var(--glass-border); position: relative; overflow: hidden; text-align: center; padding: 2rem 1.5rem; }
        .service-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--accent-blue), var(--alert-red)); transform: scaleX(0); transform-origin: left; transition: transform 0.4s ease; }
        .service-card:hover { transform: translateY(-8px); border-color: rgba(59, 130, 246, 0.4); box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5); background: rgba(30, 41, 59, 0.8); }
        .service-card:hover::before { transform: scaleX(1); }

        /* Icons */
        .icon-wrapper { display: flex; align-items: center; justify-content: center; width: 70px; height: 70px; border-radius: 50%; margin: 0 auto 1.5rem; background: rgba(15, 23, 42, 0.8); border: 1px solid var(--glass-border); transition: transform 0.3s ease; }
        .service-card:hover .icon-wrapper { transform: scale(1.1); }
        .icon-blue { color: #60a5fa; box-shadow: inset 0 0 20px rgba(59, 130, 246, 0.2); }
        .icon-red { color: #f87171; box-shadow: inset 0 0 20px rgba(239, 68, 68, 0.2); }

        /* Service Card Text */
        .service-card h4 { font-size: 1.35rem; font-weight: 700; margin-bottom: 1rem; color: #ffffff; }
        .service-card p { color: var(--text-muted); font-size: 1rem; line-height: 1.6; text-align: justify; margin-top: 0.5rem; }

        /* Footer */
        .app-footer { background: rgba(15, 23, 42, 0.9); backdrop-filter: blur(10px); text-align: center; padding: 1.5rem 0; color: var(--text-muted); font-size: 0.9rem; border-top: 1px solid var(--glass-border); }
        .app-footer a { color: var(--accent-blue); transition: color 0.2s; font-weight: 600; }
        .app-footer a:hover { color: #93c5fd; text-decoration: underline; }

        /* Scroll To Top */
        .scroll-top-btn { position: fixed; bottom: 2rem; right: 2rem; z-index: 40; background-color: var(--secondary-dark); color: #ffffff; padding: 1rem; border-radius: 50%; border: 1px solid var(--glass-border); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.5); cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; }
        .scroll-top-btn:hover { background-color: var(--accent-blue); transform: translateY(-5px); border-color: var(--accent-blue); }

        /* Responsive Media Queries */
        @media (max-width: 768px) {
            .hero-title { font-size: 2.25rem; }
            .hero-subtitle { font-size: 1.1rem; }
            .nav-links span.text-lg { display: none; }
        }
        @media (max-width: 400px) {
            .service-grid { margin-bottom: 0.5rem; }
            .services { padding: 1.5rem 0; }
        }
    </style>
</head>
<body>

<header class="app-header">
    <div class="header-gradient"></div>
    <div class="container">
        <h1 class="brand">
            <img src="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" alt="CDA Seal" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Cooperative_Development_Authority_%28CDA%29.svg/1200px-Cooperative_Development_Authority_%28CDA%29.svg.png'" />
            <span>CDA-DBRS</span>
        </h1>

        <nav>
            <ul class="nav-links">
                @auth
                    <li>
                        <a href="{{ url('/dashboard') }}" class="nav-link">
                            <span class="material-icons-outlined text-lg">dashboard</span> Dashboard
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link nav-link-logout">
                                <span class="material-icons-outlined text-lg">logout</span> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="nav-link">
                            <span class="material-icons-outlined text-lg">login</span> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="hero-content">
        <div class="status-badge animate-fade-in-up">
            <span class="material-icons-outlined" style="font-size: 1rem;">verified_user</span>
            Secure Reporting Portal
        </div>
        
        <h1 class="hero-title animate-fade-in-up delay-100">
            Rapid Response & Tracking for the <br>
            <span class="text-gradient">CDA Data Breach Reporting System</span>
        </h1>
        
        <p class="hero-subtitle animate-fade-in-up delay-200">
            Experience real-time, highly secure, and centralized monitoring of CDA’s cybersecurity incidents and data breach reports across all nationwide offices.
        </p>
        
        <div class="animate-fade-in-up delay-200" style="display: flex; justify-content: center; gap: 1rem; margin-top: 2rem;">
            <a href="{{ url('create_incident') }}" class="btn-danger">
                <i class="fa-solid fa-shield-halved"></i> Report an Incident Now
            </a>
        </div>
    </div>
</section>

<section class="services">
    <div class="container" style="flex-direction: column;">
        <h3 class="section-title">System Capabilities & Support</h3>
        
        <div class="service-grid">
            <div class="service-card">
                <div class="icon-wrapper icon-red">
                    <span class="material-icons-outlined text-4xl">gpp_bad</span>
                </div>
                <h4>Incident Management</h4>
                <p>Log, track, and manage potential data breaches instantly. Receive essential guidance on data containment, immediate incident handling, and strict access control.</p>
            </div>

            <div class="service-card">
                <div class="icon-wrapper icon-blue">
                    <span class="material-icons-outlined text-4xl">dns</span>
                </div>
                <h4>ICT Infrastructure Support</h4>
                <p>Get priority assistance with database integrity, system backups, Google Workspace security, and other critical ICT services tied to incident resolution.</p>
            </div>
        </div>
    </div>
</section>

<footer class="app-footer">
    <div class="container" style="flex-direction: column; gap: 0.75rem;">
        <p>© {{ $year }} CDA-DBRS. All rights reserved.</p>
    </div>
</footer>

<button id="scrollToTopBtn" class="scroll-top-btn hidden" title="Back to top">
    <span class="material-icons-outlined">arrow_upward</span>
</button>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        const heroSection = document.querySelector('.hero');
        
        // Scroll Event Listener
        window.addEventListener('scroll', () => {
            let currentScroll = window.scrollY;

            // Scroll-to-top button logic
            if (currentScroll < 300) {
                scrollToTopBtn.classList.add('hidden');
            } else {
                scrollToTopBtn.classList.remove('hidden');
            }

            // Parallax effect
            if (currentScroll <= heroSection.offsetHeight) {
                heroSection.style.backgroundPositionY = `${currentScroll * 0.4}px`;
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
</script>

</body>
</html>