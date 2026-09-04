@php
    $year = now()->year;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="CDA-ICT Helpdesk System - Rapid Response & Secure IT Incident Portal">

    <title>CDA-ICT Helpdesk</title>
    <link rel="icon" href="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Modern Cybersecurity Theme Variables */
        :root { 
            --primary-dark: #0f172a; 
            --secondary-dark: #1e293b; 
            --accent-blue: #3b82f6; 
            --accent-blue-hover: #2563eb; 
            --alert-red: #ef4444; 
            --alert-red-hover: #dc2626; 
            --text-main: rgb(248, 250, 252); 
            --text-muted: #94a3b8; 
            --glass-bg: rgba(15, 23, 42, 0.75); 
            --glass-border: rgba(255, 255, 255, 0.1);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Base Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        /* Custom Webkit Scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: var(--primary-dark); }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 5px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }

        /* Body Typography & Layout */
        body { display: flex; flex-direction: column; min-height: 100vh; background: linear-gradient(-45deg, #020617, #0f172a, #082f49, #172554, #1e293b); background-size: 400% 400%; animation: gradientBG 15s ease infinite; color: var(--text-main); font-family: 'Inter', system-ui, -apple-system, sans-serif; -webkit-font-smoothing: antialiased; line-height: 1.6; overflow-x: hidden; }

        /* Main Content wrapper to push footer down */
        .flex-grow { flex: 1 0 auto; }

        a { text-decoration: none; }
        ul { list-style: none; }
        .hidden { opacity: 0; visibility: hidden; pointer-events: none; }

        /* Accessibility Focus States */
        a:focus-visible, button:focus-visible {
            outline: 2px solid var(--accent-blue);
            outline-offset: 4px;
            border-radius: 4px;
        }

        /* Animations */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes fadeInUp { 
            from { opacity: 0; transform: translateY(30px); } 
            to { opacity: 1; transform: translateY(0); } 
        }
        @keyframes glowRed { 
            0%, 100% { box-shadow: 0 0 15px rgba(239, 68, 68, 0.3); } 
            50% { box-shadow: 0 0 25px rgba(239, 68, 68, 0.6); } 
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        /* Prevent animations for users who prefer reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *, ::before, ::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
        .delay-100 { animation-delay: 0.15s; }
        .delay-200 { animation-delay: 0.3s; }

        /* Header (Glassmorphism) */
        .app-header { background-color: var(--glass-bg); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); position: sticky; top: 0; z-index: 50; border-bottom: 1px solid var(--glass-border); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); }
        .header-gradient { height: 3px; background: linear-gradient(90deg, var(--accent-blue), #8b5cf6, var(--alert-red)); }
        .container { max-width: 1280px; margin: 0 auto; padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; }

        /* Branding */
        .brand { font-size: 1.5rem; font-weight: 800; color: var(--text-main); display: flex; align-items: center; gap: 0.75rem; letter-spacing: -0.025em; }
        .brand img { width: 44px; height: 44px; object-fit: contain; transition: var(--transition-smooth); filter: drop-shadow(0 0 8px rgba(255,255,255,0.2)); }
        .brand:hover img { transform: scale(1.1) rotate(-5deg); filter: drop-shadow(0 0 12px rgba(255,255,255,0.4)); }

        /* Navigation */
        .nav-links { display: flex; gap: 1rem; align-items: center; font-weight: 600; font-size: 0.95rem; }
        .nav-link { color: var(--text-main); padding: 0.6rem 1.25rem; border-radius: 8px; display: flex; align-items: center; gap: 0.5rem; transition: var(--transition-smooth); border: 1px solid transparent; }
        .nav-link:hover { color: var(--text-main); background-color: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.3); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15); }

        /* Logout Link Specifics */
        .nav-link.nav-link-logout { color: #fca5a5; background: none; cursor: pointer; font: inherit; }
        .nav-link.nav-link-logout:hover { color: var(--text-main); background-color: rgba(239, 68, 68, 0.15); border-color: rgba(239, 68, 68, 0.3); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15); }

        /* Hero Section */
        .hero { position: relative; width: 100%; min-height: 80vh; display: flex; align-items: center; justify-content: center; background-image: url("{{ asset('images/icthelpdesk.png') }}"); background-size: cover; background-position: center; background-attachment: fixed; background-repeat: no-repeat; image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges; overflow: hidden; }

        /* Hero Overlay */
        .hero::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(2, 6, 23, 0.7) 0%, rgba(15, 23, 42, 0.45) 100%); z-index: 1; }
        .hero-content { position: relative; z-index: 10; text-align: center; padding: 5rem 1.5rem; max-width: 900px; }

        /* Status Badge with Border Glow */
        .status-badge { display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(15, 23, 42, 0.85); border: 1px solid rgba(96, 165, 250, 0.6); color: #60a5fa; padding: 0.5rem 1.25rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600; margin-bottom: 2rem; text-transform: uppercase; letter-spacing: 0.05em; backdrop-filter: blur(8px); box-shadow: 0 0 20px rgba(59, 130, 246, 0.35), inset 0 0 10px rgba(59, 130, 246, 0.15); }

        /* Hero Title with Border Contrast & Ambient Blue Shadow Glow */
        .hero-title { font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 800; margin-bottom: 1.5rem; line-height: 1.15; letter-spacing: -0.02em; color: var(--text-main); text-shadow: -1px -1px 0 rgba(2, 6, 23, 0.95), 1px -1px 0 rgba(2, 6, 23, 0.95), -1px  1px 0 rgba(2, 6, 23, 0.95), 1px  1px 0 rgba(2, 6, 23, 0.95), 0 0 20px rgba(59, 130, 246, 0.6), 0 6px 30px rgba(2, 6, 23, 0.9); }

        /* Solid White Text Style for CDA-ICT Helpdesk System */
        .text-gradient { color: var(--text-main); background: none; -webkit-background-clip: initial; -webkit-text-fill-color: var(--text-main); filter: drop-shadow(0 0 12px rgba(255, 255, 255, 0.4)) drop-shadow(0 2px 6px rgba(2, 6, 23, 0.95)); }

        /* Hero Subtitle with High-Contrast Dark Glow */
        .hero-subtitle { font-size: clamp(1rem, 2vw, 1.25rem); color:  var(--text-main); margin-bottom: 3.5rem; line-height: 1.7; max-width: 750px; margin-left: auto; margin-right: auto; text-shadow: -1px -1px 0 rgba(2, 6, 23, 0.9), 1px -1px 0 rgba(2, 6, 23, 0.9), -1px  1px 0 rgba(2, 6, 23, 0.9), 1px  1px 0 rgba(2, 6, 23, 0.9), 0 0 15px rgba(2, 6, 23, 0.9); }

        /* Buttons Container */
        .action-buttons { display: flex; justify-content: center; gap: 1.5rem; margin-top: 2rem; flex-wrap: wrap; }

        /* Base Button Styles */
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 0.85rem 2.5rem; border-radius: 12px; font-size: 1.125rem; font-weight: 700; transition: var(--transition-smooth); border: 1px solid transparent; cursor: pointer; }
        .btn-primary { background: rgba(59, 130, 246, 0.25); color: var(--text-main); border-color: rgba(96, 165, 250, 0.6); backdrop-filter: blur(6px); box-shadow: 0 0 15px rgba(59, 130, 246, 0.25); }
        .btn-primary:hover { background: var(--accent-blue); color: var(--text-main); transform: translateY(-3px); box-shadow: 0 15px 25px -5px rgba(59, 130, 246, 0.5); }
        .btn-danger { background-color: var(--alert-red); color: var(--text-main); border-color: #f87171; animation: glowRed 3s infinite alternate; }
        .btn-danger:hover { background-color: var(--alert-red-hover); transform: translateY(-3px); box-shadow: 0 15px 25px -5px rgba(239, 68, 68, 0.5); }

        /* Services Section */
        .services { padding: 5rem 0; background-color: transparent; position: relative; z-index: 10; }
        .section-title { font-size: clamp(1.75rem, 3vw, 2.25rem); font-weight: 800; text-align: center; margin-bottom: 3.5rem; color: var(--text-main); letter-spacing: -0.01em; text-shadow: 0 2px 10px rgba(0,0,0,0.5); }
        .service-grid { display: flex; flex-wrap: wrap; justify-content: center; gap: 2.5rem; padding: 0 1.5rem; }
        
        .service-card { flex: 1 1 320px; max-width: 420px; background: rgba(30, 41, 59, 0.65); backdrop-filter: blur(12px); border-radius: 20px; transition: var(--transition-smooth); border: 1px solid var(--glass-border); position: relative; overflow: hidden; text-align: center; padding: 3rem 2rem; }
        .service-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--accent-blue), var(--alert-red)); transform: scaleX(0); transform-origin: left; transition: transform 0.5s ease; }
        .service-card:hover { transform: translateY(-10px); border-color: rgba(59, 130, 246, 0.3); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); background: rgba(30, 41, 59, 0.85); }
        .service-card:hover::before { transform: scaleX(1); }

        /* Icons */
        .icon-wrapper { display: flex; align-items: center; justify-content: center; width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 2rem; background: rgba(15, 23, 42, 0.8); border: 1px solid var(--glass-border); transition: var(--transition-smooth); animation: float 6s ease-in-out infinite; }
        .service-card:hover .icon-wrapper { transform: scale(1.1) rotate(5deg); }
        .icon-blue { color: #60a5fa; box-shadow: inset 0 0 20px rgba(59, 130, 246, 0.15); }
        .icon-red { color: #f87171; box-shadow: inset 0 0 20px rgba(239, 68, 68, 0.15); animation-delay: 1s; }

        /* Service Card Text */
        .service-card h4 { font-size: 1.4rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-main); }
        .service-card p { color: var(--text-muted); font-size: 1.05rem; line-height: 1.6; margin-top: 0.5rem; }

        /* Footer (Zero Spacing Architecture) */
        .app-footer { background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); text-align: center; padding: 1.5rem 0; color: var(--text-muted); font-size: 0.95rem; border-top: 1px solid var(--glass-border); position: relative; z-index: 10; flex-shrink: 0; margin-bottom: 0; }

        /* Scroll To Top */
        .scroll-top-btn { position: fixed; bottom: 2rem; right: 2rem; z-index: 40; background-color: rgba(30, 41, 59, 0.8); backdrop-filter: blur(8px); color: var(--text-main); padding: 1rem; border-radius: 50%; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.5); cursor: pointer; transition: var(--transition-smooth); display: flex; align-items: center; justify-content: center; }
        .scroll-top-btn:hover { background-color: var(--accent-blue); transform: translateY(-5px); border-color: var(--accent-blue); box-shadow: 0 15px 20px -5px rgba(59, 130, 246, 0.4); }

        /* Responsive Media */
        @media (max-width: 768px) {
            .nav-text { display: none !important; }
            .nav-link { padding: 0.6rem 0.8rem; margin: 0 !important; justify-content: center; }
            .hero-content { padding: 3rem 1rem; }
            .action-buttons { flex-direction: column; gap: 1rem; align-items: stretch; }
            .btn { width: 100%; padding: 1rem 1.5rem; }
            .service-grid { gap: 1.5rem; }
            .service-card { padding: 2rem 1.5rem; }
            .services { padding: 3rem 0; }
        }
    </style>
</head>
<body>

<header class="app-header">
    <div class="header-gradient"></div>
    <div class="container">
        <a href="/" aria-label="Home" class="brand">
            <img src="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" alt="CDA Seal" loading="lazy">
            <span>CDA-ICT Helpdesk</span>
        </a>

        <nav aria-label="Main Navigation">
            <ul class="nav-links">
                @auth
                    <li>
                        <a href="{{ url('/tickets/overview_tickets') }}" class="nav-link" aria-label="Tickets Overview">
                            <span class="material-symbols-outlined" style="font-size: 1.25rem;" aria-hidden="true">table_chart_view</span> 
                            <span class="nav-text">Tickets Overview</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link nav-link-logout" aria-label="Logout">
                                <span class="material-symbols-outlined" style="font-size: 1.25rem;" aria-hidden="true">logout</span> 
                                <span class="nav-text">Logout</span>
                            </button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="nav-link" aria-label="Login">
                            <span class="material-symbols-outlined" style="font-size: 1.25rem;" aria-hidden="true">login</span> 
                            <span class="nav-text">Login</span>
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

<main class="flex-grow">
    <section class="hero" aria-labelledby="hero-heading">
        <div class="hero-content">
            <div class="status-badge animate-fade-in-up">
                <span class="material-symbols-outlined" style="font-size: 1.25rem;" aria-hidden="true">shield_locked</span>
                Secure IT & Incident Portal
            </div>

            <h1 id="hero-heading" class="hero-title animate-fade-in-up delay-100">
                Rapid Response & Tracking for the <br>
                <span class="text-gradient">CDA-ICT Helpdesk System</span>
            </h1>

            <p class="hero-subtitle animate-fade-in-up delay-200">
                Centralized IT support and secure incident reporting for CDA nationwide. Get real-time technical assistance and maintain cybersecurity resilience in one secure hub.
            </p>

            <div class="action-buttons animate-fade-in-up delay-200">
                <a href="{{ url('create_ticket') }}" class="btn btn-primary" aria-label="Submit Ticket">
                    <span class="material-symbols-outlined" aria-hidden="true">confirmation_number</span> Submit Ticket
                </a>

                <a href="{{ url('create_incident') }}" class="btn btn-danger" aria-label="Report Incident">
                    <span class="material-symbols-outlined" aria-hidden="true">warning</span> Report Incident
                </a>
            </div>
        </div>
    </section>

    <section class="services" aria-labelledby="services-heading">
        <div class="container" style="flex-direction: column;">
            <h3 id="services-heading" class="section-title">System Capabilities & Support</h3>

            <div class="service-grid">
                <article class="service-card">
                    <div class="icon-wrapper icon-red">
                        <span class="material-symbols-outlined" style="font-size: 2.5rem;" aria-hidden="true">security</span>
                    </div>
                    <h4>Incident Management</h4>
                    <p>Log, track, and manage potential data breaches instantly. Receive essential guidance on data containment, immediate incident handling, and strict access control.</p>
                </article>

                <article class="service-card">
                    <div class="icon-wrapper icon-blue">
                        <span class="material-symbols-outlined" style="font-size: 2.5rem;" aria-hidden="true">dns</span>
                    </div>
                    <h4>ICT Infrastructure Support</h4>
                    <p>Get priority assistance with database integrity, system backups, Google Workspace security, and other critical ICT services tied to incident resolution.</p>
                </article>
            </div>
        </div>
    </section>
</main>

<footer class="app-footer">
    <div class="container" style="justify-content: center;">
        <p>&copy; {{ $year }} CDA-ICT Helpdesk. All rights reserved.</p>
    </div>
</footer>

<button id="scrollToTopBtn" class="scroll-top-btn hidden" aria-label="Scroll to top" title="Back to top">
    <span class="material-symbols-outlined" aria-hidden="true">arrow_upward</span>
</button>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        const heroSection = document.querySelector('.hero');

        let isScrolling = false;
        
        window.addEventListener('scroll', () => {
            if (!isScrolling) {
                window.requestAnimationFrame(() => {
                    let currentScroll = window.scrollY;

                    if (currentScroll < 300) {
                        scrollToTopBtn.classList.add('hidden');
                    } else {
                        scrollToTopBtn.classList.remove('hidden');
                    }

                    if (window.matchMedia('(prefers-reduced-motion: no-preference)').matches) {
                        if (currentScroll <= heroSection.offsetHeight) {
                            heroSection.style.backgroundPositionY = `${currentScroll * 0.4}px`;
                        }
                    }
                    isScrolling = false;
                });
                isScrolling = true;
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
</script>
</body>
</html>