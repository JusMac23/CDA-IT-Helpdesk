@php
    $year = now()->year;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CDA-DBRS</title>
    <link rel="icon" href="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/js/app.js'])

    <style>
        /* CSS Variables for Theming */
        :root {
            --primary-blue: #2563eb;
            --blue-hover: #1e40af;
            --blue-light: #dbeafe;
            --primary-red: #dc2626;
            --red-hover: #b91c1c;
            --text-main: #111827;
            --text-muted: #4b5563;
            --bg-body: #f9fafb;
            --white: #ffffff;
        }

        /* Base Reset & Typography */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
            line-height: 1.5;
        }
        
        a { text-decoration: none; }
        ul { list-style: none; }
        .hidden { display: none !important; }

        /* Animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
        @keyframes ping {
            75%, 100% { transform: scale(2); opacity: 0; }
        }

        .animate-fade-in-down { animation: fadeInDown 0.9s ease-out both; }
        .animate-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        .animate-ping { animation: ping 3s cubic-bezier(0, 0, 0.2, 1) infinite; }

        /* Header Styles */
        .app-header {
            background-color: var(--white);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 50;
            border-bottom: 1px solid #e5e7eb;
        }
        .header-gradient {
            height: 4px;
            background: linear-gradient(to right, #2563eb, #6366f1, #a855f7);
        }
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e40af;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            letter-spacing: -0.025em;
        }
        .brand img {
            width: 48px; height: 48px; object-fit: contain;
            transition: transform 0.3s;
        }
        .brand:hover img { transform: scale(1.05); }

        /* Navigation */
        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            font-weight: 500;
        }
        .nav-link {
            color: var(--primary-blue);
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            color: var(--blue-hover);
            background-color: var(--blue-light);
        }
        .nav-link-logout {
            color: #ef4444; background: none; border: none; cursor: pointer; font: inherit;
        }
        .nav-link-logout:hover {
            color: #b91c1c; background-color: #fee2e2;
        }

        /* Hero Section */
        .hero {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: var(--white);
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(30,58,138,0.3), rgba(0,0,0,0.6));
            backdrop-filter: blur(1px);
        }
        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 4rem 1.5rem;
            max-width: 800px;
        }
        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 0 5px 10px rgba(0,0,0,0.6);
        }
        .hero-title span { color: #60a5fa; }
        .hero-subtitle {
            font-size: 1.25rem;
            color: #e5e7eb;
            margin-bottom: 3rem;
            line-height: 1.6;
        }
        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background-color: var(--primary-red);
            color: var(--white);
            padding: 1rem 2rem;
            border-radius: 9999px;
            font-size: 1.125rem;
            font-weight: 600;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .btn-danger:hover {
            background-color: var(--red-hover);
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(248, 113, 113, 0.4);
        }

        /* Floating Shapes */
        .shape { position: absolute; border-radius: 50%; }
        .shape-1 {
            top: 2.5rem; left: 2.5rem; width: 5rem; height: 5rem;
            background-color: rgba(59, 130, 246, 0.2); filter: blur(20px);
        }
        .shape-2 {
            bottom: 2.5rem; right: 4rem; width: 7rem; height: 7rem;
            background-color: rgba(147, 197, 253, 0.2); filter: blur(24px);
        }

        /* Services Section */
        .services {
            padding: 4rem 0;
            background-color: var(--white);
        }
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--text-main);
        }
        .service-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
        }
        .service-card {
            flex: 1 1 280px;
            max-width: 350px;
            background-color: var(--white);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease-in-out;
            border: 1px solid #f3f4f6;
        }
        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .icon-wrapper {
            display: inline-flex;
            padding: 1rem;
            border-radius: 50%;
            margin-bottom: 1rem;
        }
        .icon-purple { background-color: #f3e8ff; color: #9333ea; }
        .icon-yellow { background-color: #fef3c7; color: #d97706; }
        .service-card h4 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .service-card p {
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        /* Footer */
        .app-footer {
            background-color: #1f2937;
            text-align: center;
            padding: 2rem 0;
            color: #d1d5db;
            font-size: 0.875rem;
            border-top: 1px solid #374151;
        }
        .app-footer a { color: #60a5fa; transition: color 0.2s; }
        .app-footer a:hover { text-decoration: underline; color: #93c5fd; }

        /* Scroll to Top */
        .scroll-top-btn {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 40;
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 1rem;
            border-radius: 50%;
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .scroll-top-btn:hover {
            background-color: var(--blue-hover);
            transform: translateY(-4px);
        }

        /* Responsive */
        @media (min-width: 768px) {
            .hero-title { font-size: 4rem; }
            .hero-subtitle { font-size: 1.25rem; }
        }
    </style>
</head>
<body>

<header class="app-header">
    <div class="header-gradient"></div>
    <div class="container">
        <h1 class="brand">
            <img src="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" alt="Cooperative Development Authority Seal" />
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

<section class="hero" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
    <div class="hero-overlay"></div>

    <div class="hero-content animate-fade-in-down">
        <h1 class="hero-title">
            Your Seamless Gateway to the <br><span>CDA Data Breach Reporting System</span>
        </h1>
        <p class="hero-subtitle">
            Experience real-time, efficient, and nationwide monitoring of CDA’s incidents and data breach reports across all CDA offices.
        </p>
        
        <div style="display: flex; justify-content: center; gap: 1rem;">
            <a href="{{ url('create_incident') }}" class="btn-danger">
                <i class="fa-solid fa-shield-alt"></i> Submit Incident Report
            </a>
        </div>
    </div>

    <div class="shape shape-1 animate-pulse"></div>
    <div class="shape shape-2 animate-ping"></div>
</section>

<section class="services">
    <div class="container" style="flex-direction: column;">
        <h3 class="section-title">How We Can Help You</h3>
        
        <div class="service-grid">
            <div class="service-card">
                <div class="icon-wrapper icon-purple">
                    <span class="material-icons-outlined text-4xl">security</span>
                </div>
                <h4>Security & Incident Management</h4>
                <p>Essential guidance on data protection, incident handling, system backups, and access control.</p>
            </div>

            <div class="service-card">
                <div class="icon-wrapper icon-yellow">
                    <span class="material-icons-outlined text-4xl">miscellaneous_services</span>
                </div>
                <h4>Other ICT & Incident Services</h4>
                <p>Assistance with website management, database support, Google Workspace, and other ICT services related to incident reporting and resolution.</p>
            </div>
        </div>
    </div>
</section>

<footer class="app-footer">
    <div class="container" style="flex-direction: column; gap: 0.5rem;">
        <p>© {{ $year }} CDA ICTD. All rights reserved.</p>
        <p>Contact us at <a href="mailto:ictd@cda.gov.ph">ictd@cda.gov.ph</a></p>
    </div>
</footer>

<button id="scrollToTopBtn" class="scroll-top-btn hidden" title="Back to top">
    <span class="material-icons-outlined">arrow_upward</span>
</button>

<script>
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY < 300) {
            scrollToTopBtn.classList.add('hidden');
        } else {
            scrollToTopBtn.classList.remove('hidden');
        }
    });

    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

</body>
</html>