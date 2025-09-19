@php
    $year = now()->year;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CDA-Helpdesk</title>
    <link rel="icon" href="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" type="image/png">

    <!-- Fonts & Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes fade-in-down {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.9s ease-out both;
        }
        .interactive-link {
            transition: all 0.3s ease-in-out;
        }
        .interactive-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        body, button, input, select, textarea, h1, h2, h3, h4, p, a, span, li {
            font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !important;
        }
        
        .material-icons-outlined {
            font-family: 'Material Icons Outlined' !important;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

<header class="bg-white shadow-lg sticky top-0 z-50 border-b border-gray-200">

    <div class="h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-500"></div>

    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo & Title -->
        <h1 class="text-2xl lg:text-3xl font-bold text-blue-800 flex items-center gap-3">
            <img src="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" 
                 alt="Cooperative Development Authority Seal" 
                 class="w-12 h-12 object-contain drop-shadow-sm transition-transform duration-300 hover:scale-105"/>
            <span class="tracking-tight">CDA IT-Helpdesk System</span>
        </h1>

        <!-- Navigation -->
        <nav>
            <ul class="flex space-x-6 text-base font-medium items-center">
                @auth
                    <!-- Dashboard Link -->
                    <li>
                        <a href="{{ url('/dashboard') }}" 
                           class="text-blue-600 hover:text-blue-800 hover:bg-blue-100 px-3 py-2 rounded-full flex items-center gap-2 transition-all duration-300 ease-in-out">
                            <span class="material-icons-outlined text-lg">dashboard</span> Dashboard
                        </a>
                    </li>

                    <!-- Logout Button -->
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="text-red-500 hover:text-red-700 hover:bg-red-100 px-3 py-2 rounded-full flex items-center gap-2 transition-all duration-300 ease-in-out">
                                <span class="material-icons-outlined text-lg">logout</span> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <!-- Login Button -->
                    <li>
                        <a href="{{ route('login') }}" 
                           class="text-blue-600 hover:text-blue-800 hover:bg-blue-100 px-3 py-2 rounded-full flex items-center gap-2 font-medium transition-all duration-300 ease-in-out shadow-sm hover:shadow-md">
                            <span class="material-icons-outlined text-lg">login</span>
                            Login
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section class="relative w-full bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center text-white"
         style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
    <div class="relative z-10 text-center px-6 animate-fade-in-down py-16 lg:py-24 max-w-4xl">
        <h2 class="text-3xl lg:text-6xl font-extrabold mb-6 drop-shadow-xl">
            Your Seamless Gateway to CDA IT-Helpdesk
        </h2>
        <p class="text-lg lg:text-xl text-gray-200 max-w-2xl mx-auto mb-8">
            Fast, reliable, and secure assistance for all your technical concerns across all CDA offices.
        </p>
        <a href="{{ url('create_ticket') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-full text-lg font-bold shadow-xl interactive-link">
            <span class="material-icons-outlined">add_circle</span> Submit a Ticket
        </a>
    </div>
</section>

<!-- Services -->
<section class="py-2 bg-white">
    <div class="container mx-auto px-6">
        <h3 class="text-3xl lg:text-3xl font-bold text-gray-800 mb-10 text-center mb-2">How We Can Help You</h3>
        
        <div class="flex flex-wrap justify-center gap-6">
            <!-- Box 1 -->
            <div class="flex-1 min-w-[280px] max-w-sm bg-white shadow-md rounded-xl p-6 flex flex-col items-center text-center interactive-link">
                <div class="p-4 bg-blue-100 rounded-full mb-4">
                    <span class="material-icons-outlined text-blue-600 text-4xl">computer</span>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Technical Support</h4>
                <p class="text-gray-600 text-sm">Assistance with hardware, software, and system issues.</p>
            </div>

            <!-- Box 2 -->
            <div class="flex-1 min-w-[280px] max-w-sm bg-white shadow-md rounded-xl p-6 flex flex-col items-center text-center interactive-link">
                <div class="p-4 bg-green-100 rounded-full mb-4">
                    <span class="material-icons-outlined text-green-600 text-4xl">wifi</span>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Network & Connectivity</h4>
                <p class="text-gray-600 text-sm">Resolving internet, LAN, and other network problems.</p>
            </div>

            <!-- Box 3 -->
            <div class="flex-1 min-w-[280px] max-w-sm bg-white shadow-md rounded-xl p-6 flex flex-col items-center text-center interactive-link">
                <div class="p-4 bg-purple-100 rounded-full mb-4">
                    <span class="material-icons-outlined text-purple-600 text-4xl">security</span>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Security & Data</h4>
                <p class="text-gray-600 text-sm">Guidance on data security, backups, and access control.</p>
            </div>

            <!-- Box 4 -->
            <div class="flex-1 min-w-[280px] max-w-sm bg-white shadow-md rounded-xl p-6 flex flex-col items-center text-center interactive-link">
                <div class="p-4 bg-yellow-100 rounded-full mb-4">
                    <span class="material-icons-outlined text-yellow-600 text-4xl">miscellaneous_services</span>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Other Services</h4>
                <p class="text-gray-600 text-sm">Guidance on Website, database, Google Workspace, and etc.</p>
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
<footer class="bg-gray-800 text-center text-sm text-gray-300 py-8 border-t border-gray-700">
    <div class="container mx-auto px-6">
        <p class="text-gray-400">© {{ $year }} CDA ICTD. All rights reserved.</p>
        <p class="text-gray-400 mt-1">Contact us at <a href="mailto:ictd@cda.gov.ph" class="text-blue-400 hover:underline">ictd@cda.gov.ph</a></p>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button id="scrollToTopBtn"
        class="fixed bottom-6 right-6 z-40 bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hidden"
        title="Back to top">
    <span class="material-icons-outlined">arrow_upward</span>
</button>

<script>
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    window.addEventListener('scroll', () => {
        scrollToTopBtn.classList.toggle('hidden', window.scrollY < 300);
    });
    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

</body>
</html>