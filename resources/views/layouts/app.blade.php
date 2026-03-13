<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CDA-DBRS') }}</title>
    <link rel="icon" href="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="/assets/js/sweetalert2.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

    <style>
        :root {
            --sidebar-bg: #133e5e;
            --sidebar-hover: rgba(255, 255, 255, 0.1);
            --sidebar-active: rgba(255, 255, 255, 0.15);
            --sidebar-text: #cbd5e1;
            --sidebar-width: 256px;
            --sidebar-collapsed-width: 80px;
            --body-bg: #f9fafb;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --danger: #ef4444;
            --danger-hover: #fee2e2;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Figtree', sans-serif; background-color: var(--body-bg); color: var(--text-main); overflow: hidden; }
        a { text-decoration: none; }
        button { background: none; border: none; cursor: pointer; font-family: inherit; }
        [x-cloak] { display: none !important; }

        /* Layout - Added 100dvh for mobile browser UI compatibility */
        .app-wrapper { display: flex; height: 100vh; height: 100dvh; width: 100%; overflow: hidden; }
        .main-content { display: flex; flex-direction: column; flex: 1; min-width: 0; overflow: hidden; transition: margin 0.3s ease; }
        .content-area { flex: 1; padding: 24px; overflow-y: auto; }

        /* Sidebar Base */
        .sidebar { background-color: var(--sidebar-bg); color: white; display: flex; flex-direction: column; transition: width 0.3s ease, transform 0.3s ease; z-index: 50; flex-shrink: 0; box-shadow: 4px 0 15px rgba(0,0,0,0.1); }
        .sidebar-header { height: 64px; display: flex; align-items: center; padding: 0 16px; border-bottom: 1px solid rgba(255,255,255,0.1); flex-shrink: 0; overflow: hidden; }
        .sidebar-logo { height: 32px; width: auto; background: rgba(255,255,255,0.1); padding: 4px; border-radius: 4px; }
        .sidebar-brand { display: flex; flex-direction: column; margin-left: 12px; white-space: nowrap; }
        .sidebar-brand-title { font-size: 18px; font-weight: bold; line-height: 1; }
        .sidebar-brand-sub { font-size: 10px; font-weight: 600; color: #7dd3fc; text-transform: uppercase; margin-top: 4px; letter-spacing: 0.5px; }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 24px 12px; }
        
        .sidebar-footer { height: 64px; display: flex; align-items: center; justify-content: center; padding: 0 16px; border-top: 1px solid rgba(255,255,255,0.1); flex-shrink: 0; }
        
        .nav-label { font-size: 10px; font-weight: bold; color: #7dd3fc; text-transform: uppercase; letter-spacing: 1px; padding: 16px 12px 4px; margin-top: 8px; }

        /* Navigation Links */
        .nav-link { display: flex; align-items: center; padding: 10px 12px; color: var(--sidebar-text); border-radius: 8px; font-weight: 500; transition: all 0.2s ease; margin-bottom: 4px; white-space: nowrap; }
        .nav-link:hover { background-color: var(--sidebar-hover); color: white; }
        .nav-link.active { background-color: var(--sidebar-active); color: white; border: 1px solid rgba(255,255,255,0.05); box-shadow: inset 0 2px 4px rgba(0,0,0,0.1); }
        .nav-link .material-icons-outlined { font-size: 22px; margin-right: 12px; flex-shrink: 0; }
        
        .nav-link.logout { color: #fb7185; }
        .nav-link.logout:hover { background-color: rgba(244, 63, 94, 0.1); color: #fda4af; }

        /* Submenu */
        .submenu { list-style: none; padding-left: 0; margin-top: 4px; margin-bottom: 8px; }
        .submenu-link { display: flex; align-items: center; padding: 8px 12px 8px 44px; color: #94a3b8; font-size: 14px; border-radius: 8px; transition: 0.2s; }
        .submenu-link:hover { background-color: rgba(255,255,255,0.05); color: white; }
        .submenu-link.active { background-color: rgba(255,255,255,0.1); color: white; font-weight: 600; }
        .submenu-dot { width: 6px; height: 6px; border-radius: 50%; background-color: #64748b; margin-right: 12px; }
        .submenu-link.active .submenu-dot { background-color: #38bdf8; }
        .chevron { margin-left: auto; transition: transform 0.2s; width: 16px; height: 16px; }
        .chevron.open { transform: rotate(90deg); }

        /* Header */
        .top-header { height: 64px; background-color: white; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; padding: 0 24px; z-index: 30; flex-shrink: 0; }
        .header-left, .header-right { display: flex; align-items: center; height: 100%; }
        .icon-btn { padding: 8px; color: var(--text-muted); border-radius: 8px; transition: background 0.2s; display: flex; align-items: center; justify-content: center; }
        .icon-btn:hover { background-color: var(--border-color); color: var(--text-main); }
        
        .clock-widget { display: flex; align-items: center; color: var(--text-muted); font-size: 14px; font-weight: 500; margin-right: 24px; white-space: nowrap; }
        .clock-widget .material-icons-outlined { font-size: 18px; margin-right: 8px; }

        /* Profile Dropdown */
        .profile-dropdown { position: relative; }
        .avatar-btn { width: 40px; height: 40px; border-radius: 50%; background-color: var(--sidebar-bg); color: white; font-weight: bold; display: flex; align-items: center; justify-content: center; font-size: 14px; transition: 0.2s; flex-shrink: 0; }
        .avatar-btn:hover { background-color: #1a537d; box-shadow: 0 0 0 2px white, 0 0 0 4px var(--sidebar-bg); }
        .dropdown-menu { position: absolute; right: 0; top: 100%; margin-top: 8px; width: 220px; background: white; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 1px solid var(--border-color); z-index: 50; overflow: hidden; }
        .dropdown-header { padding: 12px 16px; border-bottom: 1px solid var(--border-color); }
        .dropdown-name { font-weight: bold; color: var(--text-main); font-size: 14px; }
        .dropdown-email { font-size: 12px; color: var(--text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .dropdown-role { display: inline-block; padding: 2px 8px; background: #e0f2fe; color: var(--sidebar-bg); font-size: 10px; font-weight: bold; border-radius: 12px; margin-top: 6px; text-transform: uppercase; }
        .dropdown-item { display: flex; align-items: center; width: 100%; padding: 10px 16px; color: var(--text-main); font-size: 14px; text-decoration: none; transition: 0.2s; background: transparent; text-align: left; }
        .dropdown-item:hover { background-color: #f3f4f6; }
        .dropdown-item .material-icons-outlined { font-size: 18px; margin-right: 10px; color: var(--text-muted); }
        .dropdown-item.logout { color: var(--danger); }
        .dropdown-item.logout:hover { background-color: var(--danger-hover); color: #b91c1c; }
        .dropdown-item.logout .material-icons-outlined { color: inherit; }

        /* App Footer Desktop */
        .app-footer { height: 64px; background: white; border-top: 1px solid var(--border-color); padding: 0 24px; display: flex; justify-content: center; align-items: center; gap: 24px; font-size: 14px; color: var(--text-muted); flex-shrink: 0; }
        .app-footer a { color: var(--text-muted); transition: color 0.2s; }
        .app-footer a:hover { color: var(--sidebar-bg); }

        /* Mobile Overlay */
        .mobile-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(17, 24, 39, 0.6); backdrop-filter: blur(2px); z-index: 40; display: none; }

        /* --- Media Queries --- */
        @media (min-width: 768px) {
            .mobile-only { display: none !important; }
            .sidebar { width: var(--sidebar-width); position: relative; }
            .sidebar.collapsed { width: var(--sidebar-collapsed-width); }
            .sidebar.collapsed .sidebar-brand { display: none; }
            .sidebar.collapsed .sidebar-header { justify-content: center; }
            .sidebar.collapsed .nav-text { display: none; }
            .sidebar.collapsed .nav-label { display: none; }
            .sidebar.collapsed .nav-link { justify-content: center; padding-left: 0; padding-right: 0; }
            .sidebar.collapsed .nav-link .material-icons-outlined { margin-right: 0; }
            .sidebar.collapsed .chevron { display: none; }
            .sidebar.collapsed hr { display: block !important; margin: 16px 0; border: 0; border-top: 1px solid rgba(255,255,255,0.1); }
        }

        @media (max-width: 767px) {
            .desktop-only { display: none !important; }
            .sidebar { position: fixed; top: 0; bottom: 0; left: 0; width: var(--sidebar-width); transform: translateX(-100%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .mobile-overlay.mobile-open { display: block; }
            .header-left .icon-btn { margin-right: 8px; }
            .top-header { padding: 0 16px; } 
            
            .clock-widget { font-size: 12px; margin-right: 12px;}
            .clock-widget .material-icons-outlined { font-size: 16px; margin-right: 4px; }
            
            /* Responsive Mobile Footer adjustments for narrow screens */
            .app-footer { height: auto; min-height: 64px; padding: 16px 12px; padding-bottom: calc(16px + env(safe-area-inset-bottom)); flex-direction: column; gap: 8px; text-align: center; }
            .app-footer p, .app-footer a { margin: 0; font-size: 12px; word-wrap: break-word; }
            .sidebar-footer { height: auto; padding: 16px; padding-bottom: calc(16px + env(safe-area-inset-bottom)); }
        }
    </style>
</head>

<body x-data="{ 
        sidebarOpen: localStorage.getItem('sidebarOpen') !== 'false',
        mobileSidebarOpen: false,
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', this.sidebarOpen);
        }
    }">
    
    <div class="app-wrapper">

        <div 
            class="mobile-overlay" 
            :class="{ 'mobile-open': mobileSidebarOpen }"
            @click="mobileSidebarOpen = false"
            x-transition.opacity
        ></div>

        @include('layouts.navigation')

        <div class="main-content">
            
            <header class="top-header">
                <div class="header-left">
                    <button @click="mobileSidebarOpen = true" class="icon-btn mobile-only">
                        <span class="material-icons-outlined">menu</span>
                    </button>

                    <button @click="toggleSidebar()" class="icon-btn desktop-only" :title="sidebarOpen ? 'Collapse Sidebar' : 'Expand Sidebar'">
                        <span class="material-icons-outlined" x-text="sidebarOpen ? 'menu_open' : 'menu'"></span>
                    </button>
                </div>

                <div class="header-right">
                    @php $user = Auth::user(); @endphp

                    <div class="clock-widget" x-data="{ 
                            time: '',
                            init() {
                                this.updateTime();
                                setInterval(() => this.updateTime(), 1000);
                            },
                            updateTime() {
                                // Unified date format for all screen sizes
                                const options = { timeZone: 'Asia/Manila', weekday: 'short', month: 'short', day: 'numeric', year: 'numeric', hour: 'numeric', minute: '2-digit', second: '2-digit', hour12: true };
                                this.time = new Date().toLocaleString('en-US', options);
                            }
                        }">
                        <span class="material-icons-outlined">schedule</span>
                        <span x-text="time"></span>
                    </div>

                    <div class="profile-dropdown" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="avatar-btn" title="{{ $user->name ?? 'User' }}">
                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                        </button>

                        <div x-show="open" x-transition.opacity style="display: none;" class="dropdown-menu">
                            <div class="dropdown-header">
                                <div class="dropdown-name">{{ $user->name }}</div>
                                <div class="dropdown-email">{{ $user->email }}</div>
                                
                                @forelse($user->roles as $role)
                                    <span class="dropdown-role">{{ $role->name }}</span>
                                @empty
                                    <span class="dropdown-role" style="background: #f3f4f6; color: #4b5563;">No Role</span>
                                @endforelse
                            </div>

                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <span class="material-icons-outlined">person</span> Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item logout">
                                    <span class="material-icons-outlined">logout</span> Log out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="content-area">
                {{ $slot }}
            </main>

            <footer class="app-footer">
                <p>&copy; {{ date('Y') }} CDA ICTD. All rights reserved.</p>
                <a href="mailto:ictd@cda.gov.ph">Contact us at ictd@cda.gov.ph</a>
            </footer>

        </div>
    </div>
</body>
</html>