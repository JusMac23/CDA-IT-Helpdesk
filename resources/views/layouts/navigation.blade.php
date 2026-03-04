<aside class="sidebar" :class="{ 'collapsed': !sidebarOpen, 'mobile-open': mobileSidebarOpen }">
    
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; color: white;">
            <img src="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" alt="CDA Logo" class="sidebar-logo" style="background-color: transparent !important; background: none !important; border: none !important; box-shadow: none !important;">
            <div class="sidebar-brand">
                <span class="sidebar-brand-title">CDA-DBRS</span>
            </div>
        </a>
        <button @click="mobileSidebarOpen = false" class="icon-btn mobile-only" style="margin-left: auto; color: white; padding: 4px;">
            <span class="material-icons-outlined">close</span>
        </button>
    </div>

    <nav class="sidebar-nav">

        @if(auth()->user()->can('view_dashboard'))
        <a href="{{ route('dashboard') }}" 
           title="Tickets Overview"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="material-icons-outlined">dashboard</span>
            <span class="nav-text">Tickets Overview</span>
        </a>
        @endif

        @if(auth()->user()->canAny(['view_all_tickets', 'view_myrequested_tickets', 'view_assignedtome_tickets', 'view_reassigned_tickets']))
        <div x-data="{ 
            open: {{ request()->routeIs('*tickets.index') ? 'true' : 'false' }},
            toggleMenu() {
                if (!sidebarOpen && !mobileSidebarOpen) toggleSidebar(); 
                this.open = !this.open;
            }
        }">
            <button @click="toggleMenu()" title="Ticket Management" class="nav-link w-100 {{ request()->routeIs('*tickets.index') ? 'active' : '' }}" style="width: 100%;">
                <span class="material-icons-outlined">confirmation_number</span>
                <span class="nav-text">Ticket Management</span>
                <svg class="chevron" :class="open ? 'open' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <ul x-show="open && (sidebarOpen || mobileSidebarOpen)" x-collapse class="submenu" style="display: none;">
                @if(auth()->user()->can('view_all_tickets'))
                <li>
                    <a href="{{ route('tickets.index') }}" class="submenu-link {{ request()->routeIs('tickets.index') ? 'active' : '' }}">
                        <span class="submenu-dot"></span> All Tickets
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('view_myrequested_tickets'))
                <li> 
                    <a href="{{ route('myrequested_tickets.index') }}" class="submenu-link {{ request()->routeIs('myrequested_tickets.index') ? 'active' : '' }}">
                        <span class="submenu-dot"></span> My Requested Tickets
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('view_assignedtome_tickets'))
                <li> 
                    <a href="{{ route('assignedtome_tickets.index') }}" class="submenu-link {{ request()->routeIs('assignedtome_tickets.index') ? 'active' : '' }}">
                        <span class="submenu-dot"></span> Tickets Assigned to Me
                    </a>
                </li>
                @endif
                @if(auth()->user()->can('view_reassigned_tickets'))
                <li>
                    <a href="{{ route('reassigned_tickets.index') }}" class="submenu-link {{ request()->routeIs('reassigned_tickets.index') ? 'active' : '' }}">
                        <span class="submenu-dot"></span> Re-Assigned Tickets
                    </a>
                </li>
                @endif
            </ul>
        </div>
        @endif

        @if(auth()->user()->can('view_overview_databreach'))
        <a href="{{ url('overview_databreach') }}" 
           title="Overview"
           class="nav-link {{ request()->is('overview_databreach') ? 'active' : '' }}">
            <span class="material-icons-outlined">analytics</span>
            <span class="nav-text">Overview</span>
        </a>
        @endif

        @if(auth()->user()->can('view_all_databreach'))
        <a href="{{ route('databreach.index') }}" 
           title="All Reports"
           class="nav-link {{ request()->routeIs('databreach.index') ? 'active' : '' }}">
            <span class="material-icons-outlined">article</span>
            <span class="nav-text">All Reports</span>
        </a>
        @endif

        @if(auth()->user()->canAny(['view_dbrt', 'create_dbrt', 'edit_dbrt', 'delete_dbrt']))
        <a href="{{ route('databreach.team_databreach') }}" 
           title="DBRT"
           class="nav-link {{ request()->routeIs('databreach.team_databreach') ? 'active' : '' }}">
            <span class="material-icons-outlined">group</span>
            <span class="nav-text">DBRT</span>
        </a>
        @endif

        @if(auth()->user()->canAny(['view_technical_personnel', 'view_technical_services', 'view_tech_users', 'view_roles']))
            <div class="nav-label">System Setup</div>
            <hr style="display: none;"> 
        @endif

        @if(auth()->user()->canAny(['view_technical_personnel', 'create_technical_personnel', 'edit_technical_personnel', 'delete_technical_personnel', 'search_technical_personnel']))
        <a href="{{ route('tech_personnel.index') }}" 
           title="Technical Personnel"
           class="nav-link {{ request()->routeIs('tech_personnel.index') ? 'active' : '' }}">
            <span class="material-icons-outlined">engineering</span>
            <span class="nav-text">Technical Personnel</span>
        </a>
        @endif

        @if(auth()->user()->canAny(['view_technical_services', 'create_technical_services', 'edit_technical_services', 'delete_technical_services', 'search_technical_services']))
        <a href="{{ route('tech_services.index') }}" 
           title="Technical Services"
           class="nav-link {{ request()->routeIs('tech_services.index') ? 'active' : '' }}">
            <span class="material-icons-outlined">checklist</span>
            <span class="nav-text">Technical Services</span>
        </a>
        @endif

        @if(auth()->user()->canAny(['view_tech_users', 'create_tech_users', 'edit_tech_users', 'delete_tech_users', 'tech_users']))
        <a href="{{ route('users.index') }}" 
           title="Users"
           class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
            <span class="material-icons-outlined">manage_accounts</span>
            <span class="nav-text">Users</span>
        </a>
        @endif

        @if(auth()->user()->canAny(['view_roles', 'create_roles', 'edit_roles', 'delete_roles', 'search_roles']))
        <a href="{{ route('roles.index') }}" 
           title="Roles"
           class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}">
            <span class="material-icons-outlined">add_moderator</span>
            <span class="nav-text">Roles</span>
        </a>
        @endif

    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}" style="margin: 0; width: 100%;">
            @csrf
            <button type="submit" class="nav-link logout" title="Log Out" style="width: 100%; border-radius: 8px; margin-bottom: 0;">
                <span class="material-icons-outlined">logout</span>
                <span class="nav-text">Log Out</span>
            </button>
        </form>
    </div>
</aside>