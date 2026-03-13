<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }

        /* Main Container */
        .content-panel { background-color: #ffffff; border-radius: 1rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); padding: 1.25rem; width: 100%; }
        
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em; }

        /* --- Action Container (Toolbar Layout) --- */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 1rem; margin-bottom: 1.5rem; }
        .action-left-group { display: flex; flex-direction: column; width: 100%; gap: 0.75rem; }
        
        .action-form { margin: 0; width: 100%; }

        /* Auto Reload Toggle */
        .auto-reload-label { display: flex; align-items: center; font-size: 0.9rem; font-weight: 600; color: #475569; cursor: pointer; width: 100%; justify-content: flex-start; padding: 0.5rem 0; white-space: nowrap; }
        .auto-reload-checkbox { margin-right: 0.5rem; cursor: pointer; width: 1.15rem; height: 1.15rem; accent-color: #4f46e5; border-radius: 0.25rem; }

        /* --- Buttons - Uniform 44px Heights --- */
        .btn { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 1.5rem; border-radius: 0.5rem; font-size: 0.95rem; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s ease; width: 100%; text-decoration: none; font-family: inherit; white-space: nowrap; box-sizing: border-box; }
        .btn i { margin-right: 0.5rem; font-size: 1rem; }
        
        /* Internal Count Badges inside Buttons */
        .btn .btn-count { margin-left: 0.5rem; background-color: rgba(255, 255, 255, 0.25); padding: 0.15rem 0.5rem; border-radius: 9999px; font-size: 0.85rem; font-weight: 700; }

        .btn-green { background-color: #10b981; color: white; box-shadow: 0 1px 2px rgba(16, 185, 129, 0.2); }
        .btn-green:hover { background-color: #059669; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(16, 185, 129, 0.2); }
        
        .btn-blue { background-color: #3b82f6; color: white; box-shadow: 0 1px 2px rgba(59, 130, 246, 0.2); }
        .btn-blue:hover { background-color: #2563eb; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }
        
        .btn-red { background-color: #ef4444; color: white; box-shadow: 0 1px 2px rgba(239, 68, 68, 0.2); }
        .btn-red:hover { background-color: #dc2626; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }

        .btn-indigo { background-color: #4f46e5; color: white; box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }
        .btn-indigo:hover { background-color: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }

        .btn-yellow { background-color: #eab308; color: white; box-shadow: 0 1px 2px rgba(234, 179, 8, 0.2); }
        .btn-yellow:hover { background-color: #ca8a04; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(234, 179, 8, 0.3); color: white; }
        .btn-yellow:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(234, 179, 8, 0.2); }

        .btn-gray { background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
        .btn-gray:hover { background-color: #e2e8f0; color: #0f172a; }

        /* --- Search Form Group --- */
        .search-form { display: flex; align-items: stretch; width: 100%; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border-radius: 0.5rem; }
        .search-input { height: 44px; flex: 1; min-width: 0; padding: 0 1rem; font-size: 0.95rem; font-family: inherit; color: #334155; border: 1px solid #cbd5e1; border-right: none; border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem; outline: none; transition: all 0.2s; position: relative; z-index: 1; background-color: #ffffff; }
        .search-input:focus { border-color: #6366f1; box-shadow: inset 0 0 0 1px #6366f1, 0 0 0 3px rgba(99, 102, 241, 0.15); z-index: 10; }
        .search-btn { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 1.25rem; border: none; border-top-right-radius: 0.5rem; border-bottom-right-radius: 0.5rem; background-color: #4f46e5; color: white; cursor: pointer; transition: background-color 0.2s; z-index: 2; width: auto; }
        .search-btn:hover { background-color: #4338ca; }

        /* --- Filters Section --- */
        .filter-section { display: flex; flex-direction: column; align-items: stretch; width: 100%; gap: 1rem; margin-bottom: 2rem; background: #f8fafc; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; }
        .form-group { display: flex; flex-direction: column; width: 100%; }
        .form-label { font-weight: 600; margin-bottom: 0.5rem; font-size: 0.875rem; color: #475569; }
        .form-input, .form-select { height: 44px; padding: 0 1rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.95rem; color: #334155; width: 100%; box-sizing: border-box; outline: none; transition: all 0.2s; background-color: white; font-family: inherit; }
        .form-input:focus, .form-select:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }
        textarea.form-input { height: auto; resize: vertical; padding: 0.75rem 1rem; min-height: 100px; }
        
        .filter-container { display: flex; flex-direction: column; gap: 0.75rem; width: 100%; margin-top: 0.25rem; }

        /* --- Data Table --- */
        .table-container { width: 100%; overflow-x: auto; background-color: #ffffff; border-radius: 0.75rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-top: 1.5rem; -webkit-overflow-scrolling: touch; display: block; }
        .data-table { width: 100%; min-width: 1200px; border-collapse: collapse; text-align: left; font-size: 0.9rem; }
        .data-table th { padding: 1rem 1.25rem; background-color: #f8fafc; color: #64748b; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
        .data-table td { padding: 1.25rem; border-bottom: 1px solid #f1f5f9; color: #334155; vertical-align: middle; font-weight: 500; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: #f8fafc; }
        .text-center { text-align: center; }
        .font-bold { font-weight: 700; color: #0f172a; }
        .text-truncate { max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block; }
        
        /* Thumbnails */
        .thumb-img { width: 3rem; height: 3rem; object-fit: cover; border-radius: 0.5rem; border: 1px solid #e2e8f0; transition: all 0.2s; cursor: pointer; }
        .thumb-img:hover { opacity: 0.8; border-color: #94a3b8; }

        /* Status Badges */
        .badge { display: inline-block; padding: 0.35rem 0.85rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-align: center; white-space: nowrap; letter-spacing: 0.025em; }
        .status-resolved { background-color: #dcfce7; color: #166534; } 
        .status-pending { background-color: #fef9c3; color: #854d0e; }
        .status-reassigned { background-color: #eff6ff; color: #1e40af; }
        .status-default { background-color: #f1f5f9; color: #475569; }

        /* Action Links inside Table */
        .action-group { display: flex; flex-direction: column; gap: 0.5rem; min-width: 140px; }
        .action-link { display: inline-flex; align-items: center; font-size: 0.85rem; font-weight: 600; font-family: inherit; cursor: pointer; padding: 0.4rem 0.75rem; border-radius: 0.375rem; transition: all 0.2s; text-decoration: none; background: transparent; white-space: nowrap; width: 100%; text-align: left; box-sizing: border-box; justify-content: flex-start; }
        .action-link i { margin-right: 0.4rem; width: 16px; text-align: center; flex-shrink: 0; font-size: 0.9rem; }
        
        .link-blue { color: #3b82f6; border: 1px solid #bfdbfe; } 
        .link-blue:hover { background-color: #eff6ff; color: #1d4ed8; border-color: #93c5fd; }
        
        .link-yellow { color: #d97706; border: 1px solid #fde68a; } 
        .link-yellow:hover { background-color: #fffbeb; color: #b45309; border-color: #fcd34d; }
        
        .link-indigo { color: #4f46e5; border: 1px solid #a5b4fc; } 
        .link-indigo:hover { background-color: #e0e7ff; color: #3730a3; border-color: #818cf8; }
        
        .link-red { color: #ef4444; border: 1px solid #fecaca; } 
        .link-red:hover { background-color: #fef2f2; color: #b91c1c; border-color: #fca5a5; }

        /* --- Modern UI Pagination (Laravel Structure Fix) --- */
        .pagination-wrapper { margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; width: 100%; }
        .pagination-wrapper nav { display: flex; flex-direction: column; gap: 1.25rem; width: 100%; align-items: center; }
        
        /* Pagination Sub-Text */
        .pagination-wrapper p { margin: 0; font-size: 0.875rem; color: #64748b; font-weight: 500; text-align: center; }
        .pagination-wrapper p span { font-weight: 700; color: #0f172a; }

        /* Container for links */
        .pagination-wrapper div > span.relative.z-0.inline-flex,
        .pagination-wrapper .flex.justify-between { display: flex; flex-wrap: wrap; gap: 0.5rem; box-shadow: none !important; justify-content: center; align-items: center; }

        /* Uniform Button Styling for Page Numbers & Arrows */
        .pagination-wrapper a, 
        .pagination-wrapper span[aria-current="page"] > span,
        .pagination-wrapper span[aria-disabled="true"] > span { 
            display: inline-flex; align-items: center; justify-content: center; 
            min-width: 2.25rem; height: 2.25rem; padding: 0 0.5rem; 
            border-radius: 0.375rem !important; 
            font-size: 0.875rem; font-weight: 600; font-family: 'Inter', sans-serif;
            transition: all 0.2s ease; border: 1px solid transparent; 
            margin: 0 !important; 
            text-decoration: none; line-height: 1;
        }

        /* Default Inactive Links */
        .pagination-wrapper a { background-color: #ffffff; color: #475569; border-color: #e2e8f0; }
        .pagination-wrapper a:hover { background-color: #f8fafc; color: #0f172a; border-color: #cbd5e1; transform: translateY(-1px); box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

        /* Active Page Link */
        .pagination-wrapper span[aria-current="page"] > span { background-color: #4f46e5; color: #ffffff; border-color: #4f46e5; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.25); z-index: 2; position: relative; }

        /* Disabled Navigation Arrows */
        .pagination-wrapper span[aria-disabled="true"] > span { background-color: #f8fafc; color: #94a3b8; border-color: #e2e8f0; cursor: not-allowed; opacity: 0.7; }

        /* "..." Separator Fix */
        .pagination-wrapper span[aria-disabled="true"]:not([aria-label]) > span { background: transparent; border: none; opacity: 1; color: #64748b; }

        /* Standardize Arrow SVGs */
        .pagination-wrapper svg { width: 1.25rem !important; height: 1.25rem !important; display: block; }


        /* Modals */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(15, 23, 42, 0.75); backdrop-filter: blur(4px); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 1rem; opacity: 1; visibility: visible; transition: all 0.3s ease; }
        .modal-overlay.hidden { opacity: 0; visibility: hidden; pointer-events: none; }
        
        .modal-box { position: relative; background-color: white; border-radius: 1rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); width: 100%; max-width: 48rem; max-height: 90vh; overflow-y: auto; padding: 1.5rem; transform: scale(1); transition: transform 0.3s ease; }
        .modal-overlay.hidden .modal-box { transform: scale(0.95); }
        
        .close-btn { position: absolute; top: 1.25rem; right: 1.25rem; color: #94a3b8; font-size: 2rem; background: none; border: none; cursor: pointer; transition: all 0.2s; line-height: 1; border-radius: 0.25rem; padding: 0 0.5rem; }
        .close-btn:hover { color: #0f172a; background-color: #f1f5f9; }
        
        .modal-title { font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; padding-right: 2.5rem; letter-spacing: -0.025em; }
        
        .form-grid { display: flex; flex-direction: column; gap: 1.25rem; width: 100%; }
        fieldset.form-fieldset { border: 1px solid #cbd5e1; border-radius: 0.5rem; padding: 1.25rem 1rem; margin-bottom: 1.5rem; background: #ffffff; }
        fieldset.form-fieldset legend { font-weight: 700; color: #0f172a; padding: 0 0.5rem; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.05em; }
        
        .modal-footer { display: flex; flex-direction: column; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; margin-top: 1.5rem; gap: 0.75rem; }

        /* --------------------------------------------------- */
        /* Responsive Overrides                                */
        /* --------------------------------------------------- */
        
        /* Mobile Breakpoint for Pagination */
        @media (max-width: 639px) {
            .pagination-wrapper nav .hidden { display: none !important; }
            .pagination-wrapper nav .sm\:hidden { display: flex; width: 100%; justify-content: space-between; }
        }

        /* Desktop & Tablet Overrides */
        @media (min-width: 768px) {
            .content-panel { padding: 2rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            
            /* Align Actions inline */
            .action-container { flex-direction: row; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
            .action-left-group { flex-direction: row; width: auto; flex: 1; align-items: center; }
            .action-form { width: auto; }
            .search-form { max-width: 350px; min-width: 250px; width: auto; }
            .auto-reload-label { width: auto; padding: 0; justify-content: flex-start; margin-left: 0.5rem; }
            
            /* Un-stretch buttons on desktop */
            .btn { width: auto; }
            
            /* Filter Row */
            .filter-section { flex-direction: row; align-items: flex-end; width: auto; background: transparent; padding: 0; border: none; }
            .form-group { width: 220px; }
            .filter-container { flex-direction: row; width: auto; margin-top: 0; }
            
            /* Modal formatting */
            .modal-box { padding: 2.5rem; }
            .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
            .col-span-2 { grid-column: span 2; }
            fieldset.form-fieldset { padding: 1.5rem; }
            .modal-footer { flex-direction: row; justify-content: flex-end; }

            /* Pagination Layout */
            .pagination-wrapper nav { flex-direction: row; justify-content: space-between; }
            .pagination-wrapper nav > div.sm\:hidden { display: none !important; }
            .pagination-wrapper nav > div.hidden.sm\:flex-1 { display: flex !important; width: 100%; justify-content: space-between; align-items: center; }
        }
    </style>

    <div id="main-content" class="page-wrapper">
        <div id="ticketsContent">
            <div class="content-panel">

                <div class="header-flex">
                    <h3 class="title">All Tickets</h3>
                </div>

                {{-- Toolbar Action Buttons --}}
                <div class="action-container">
                    <div class="action-left-group">
                        @can('create_ticket')
                        <button id="openModal" class="btn btn-green">
                            <i class="fas fa-plus"></i> Add Ticket
                        </button>
                        @endcan

                        <form action="{{ route('tickets.index') }}" method="GET" class="action-form">
                            <input type="hidden" name="filter" value="allTickets">
                            <button id="allTickets" type="submit" class="btn btn-blue">
                                <i class="fas fa-list"></i> All Tickets <span class="btn-count">{{ $ticketsCount ?? 0 }}</span>
                            </button>
                        </form>

                        <form action="{{ route('tickets.index') }}" method="GET" class="action-form">
                            <input type="hidden" name="filter" value="overdue">
                            <button id="overdue" type="submit" class="btn btn-red">
                                <i class="fas fa-clock"></i> Overdue <span class="btn-count">{{ $overdueCount ?? 0 }}</span>
                            </button>
                        </form>

                        <label class="auto-reload-label">
                            <input type="checkbox" id="autoReloadCheckbox" class="auto-reload-checkbox">
                            <span>(<span id="countdown">60</span>s) Auto-Reload</span>
                        </label>
                    </div>

                    @can('search_ticket')
                    <form action="{{ route('tickets.index') }}" method="GET" class="search-form">
                        <input type="text" name="search_query" value="{{ request('search_query') }}" placeholder="Search tickets..." class="search-input" autocomplete="off">
                        <button type="submit" class="search-btn" aria-label="Search">
                            <i class="fas fa-search" style="margin: 0;"></i>
                        </button>
                    </form>
                    @endcan
                </div>
                
                {{-- Filters --}}
                <form action="{{ route('tickets.index') }}" method="GET" class="filter-section">
                    <div class="form-group">
                        <label for="it_area" class="form-label">Filter by Region</label>
                        <select name="it_area" id="it_area" class="form-select">
                            <option value="">All Regions</option>
                            @if(!empty($it_area))
                                @foreach($it_area as $area)
                                    <option value="{{ $area }}" {{ request('it_area') == $area ? 'selected' : '' }}>
                                        {{ $area }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status" class="form-label">Filter by Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">All Tickets</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Pending/Re-Assigned" {{ request('status') == 'Pending/Re-Assigned' ? 'selected' : '' }}>Pending/Re-Assigned</option>
                            <option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="datetime-local" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="datetime-local" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-input">
                    </div>
                    <div class="filter-container">
                        <button type="submit" name="action" value="search" class="btn btn-indigo">
                            <i class="fas fa-filter"></i> Apply
                        </button>
                        @can('generate_report')
                        <button type="submit" name="action" value="generate" class="btn btn-green">
                            <i class="fas fa-download"></i> Report
                        </button>
                        @endcan
                    </div>
                </form>

                {{-- Data Table --}}
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="text-center">Tracking ID</th>
                                <th>Requested By</th>
                                <th>Division</th>
                                <th>Device</th>
                                <th>Service</th>
                                <th>Request Details</th>
                                <th>Assigned Personnel</th>
                                <th>Action Taken</th>
                                <th>Date Created</th>
                                <th>Date Resolved</th>
                                <th class="text-center">Photo</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tickets ?? [] as $ticket)
                                <tr>
                                    <td class="text-center font-bold" style="font-size: 0.95rem;">{{ $ticket->ticket_number }}</td>
                                    <td>{{ $ticket->firstname }} {{ $ticket->lastname }}</td>
                                    <td>{{ $ticket->division }}</td>
                                    <td>{{ $ticket->device }}</td>
                                    <td>{{ $ticket->service }}</td>
                                    <td>
                                        <span class="text-truncate" title="{{ $ticket->request }}">
                                            {{ $ticket->request }}
                                        </span>
                                    </td>
                                    <td>{{ $ticket->it_personnel }}</td>
                                    <td>
                                        <span class="text-truncate" title="{{ $ticket->action_taken }}">
                                            {{ $ticket->action_taken ?: 'N/A' }}
                                        </span>
                                    </td>
                                    <td style="color: #64748b;">
                                        {{ \Carbon\Carbon::parse($ticket->date_created)->format('M d, Y h:i A') }}
                                    </td>
                                    <td style="color: #64748b;">
                                        @if($ticket->date_resolved)
                                            {{ \Carbon\Carbon::parse($ticket->date_resolved)->format('M d, Y h:i A') }}
                                        @else
                                            <span style="color: #ef4444; font-style: italic; font-weight: 600;">Not Resolved</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($ticket->photo)
                                            <a href="{{ asset('storage/' . $ticket->photo) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $ticket->photo) }}" alt="Evidence" class="thumb-img">
                                            </a>
                                        @else
                                            <span style="color: #94a3b8; font-size: 0.8rem; font-weight: 600;">N/A</span>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                        @php
                                            $status = trim($ticket->status);
                                            $badgeClass = match($status) {
                                                'Resolved' => 'status-resolved',
                                                'Pending' => 'status-pending',
                                                'Pending/Re-Assigned' => 'status-reassigned',
                                                default => 'status-default',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $ticket->status }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="action-group">
                                            @can('reassign_ticket')
                                                <button type="button" class="action-link link-yellow open-assign-modal"
                                                    data-id="{{ $ticket->ticket_id }}" 
                                                    data-status="{{ $ticket->status }}">
                                                    <i class="fas fa-user-plus"></i> Re-Assign
                                                </button>
                                            @endcan

                                            @can('update_status_ticket')
                                                <button type="button" class="action-link link-blue open-edit-modal"
                                                    data-id="{{ $ticket->ticket_id }}"
                                                    data-status="{{ $ticket->status }}"
                                                    data-action_taken="{{ $ticket->action_taken }}"
                                                    data-photo="{{ $ticket->photo }}">
                                                    <i class="fas fa-edit"></i> Update Status
                                                </button>
                                            @endcan

                                            @can('generate_tsar')
                                                @if($ticket->status === 'Resolved')
                                                    <a href="{{ route('tickets.generateTSAR', $ticket->ticket_id) }}" class="action-link link-indigo">
                                                        <i class="fas fa-file-alt"></i> Generate TSAR
                                                    </a>
                                                @endif
                                            @endcan

                                            @can('delete_ticket')
                                                <form id="delete-form-{{ $ticket->ticket_id }}" action="{{ route('tickets.destroy', $ticket->ticket_id) }}" method="POST" style="margin: 0; width: 100%;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="action-link link-red delete-btn" data-id="{{ $ticket->ticket_id }}">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center" style="padding: 3rem; color: #94a3b8; font-size: 1rem;">
                                        No Tickets found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrapper">
                    {{ $tickets->links() ?? '' }}
                </div>
            </div>
        </div>

        {{-- Add Ticket Modal --}}
        <div id="ticketModal" class="modal-overlay hidden">
            <div class="modal-box">
                <button id="closeModal" class="close-btn" aria-label="Close">&times;</button>
                
                @if ($errors->any())
                    <div style="background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 1.25rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                        <h4 style="margin:0 0 0.5rem 0; font-weight: 700; color: #7f1d1d;"><i class="fas fa-exclamation-triangle"></i> Please fix the following errors:</h4>
                        <ul style="margin:0; padding-left: 1.5rem; font-size: 0.9rem; font-weight: 500;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <h2 class="modal-title">Create New Ticket</h2>

                <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form-fieldset">
                        <legend>Client Information</legend>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="firstname" class="form-label">First Name <span style="color:#ef4444;">*</span></label>
                                <input type="text" name="firstname" id="firstname" placeholder="e.g., Juan" required class="form-input" autocomplete="given-name">
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="form-label">Last Name <span style="color:#ef4444;">*</span></label>
                                <input type="text" name="lastname" id="lastname" placeholder="e.g., Dela Cruz" required class="form-input" autocomplete="family-name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email <span style="color:#ef4444;">*</span></label>
                                <input type="email" name="email" id="email" placeholder="j_delacruz@cda.gov.ph" required class="form-input" autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label for="date_created" class="form-label">Date Created</label>
                                <input type="text" id="date_created_display" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}" readonly class="form-input">
                                <input type="hidden" name="date_created" id="date_created" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label for="division" class="form-label">Division <span style="color:#ef4444;">*</span></label>
                                <select name="division" id="division" required class="form-select">
                                    <option value="" disabled selected>Select Division</option>
                                    @foreach ($sections_divisions ?? [] as $division)
                                        <option value="{{ $division }}">{{ $division }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="device" class="form-label">Device <span style="color:#ef4444;">*</span></label>
                                <select name="device" id="device" required class="form-select">
                                    <option value="" disabled selected>Select Device</option>
                                    <option value="Desktop PC">Desktop PC</option>
                                    <option value="Laptop/Netbook PC">Laptop/Netbook PC</option>
                                    <option value="Tablet PC">Tablet PC</option>
                                    <option value="All-in-1 Printer">All-in-1 Printer</option>
                                    <option value="Printer Only">Printer Only</option>
                                    <option value="Scanner Only">Scanner Only</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="service" class="form-label">Technical Service <span style="color:#ef4444;">*</span></label>
                                <select name="service" id="service" required class="form-select">
                                    <option value="" disabled selected>Select Service</option>
                                    @foreach ($technical_services ?? [] as $service)
                                        <option value="{{ $service }}">{{ $service }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="photo" class="form-label">Attach Photo (Optional)</label>
                                <input type="file" name="photo" id="photo" class="form-input" style="padding: 0.5rem 1rem;">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="request" class="form-label">Request Details <span style="color:#ef4444;">*</span></label>
                                <textarea name="request" id="request" rows="3" required placeholder="Please describe your issue or request in detail." class="form-input"></textarea>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="form-fieldset" style="margin-bottom: 0;">
                        <legend>Designated Personnel</legend>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="it_area_add" class="form-label">Region <span style="color:#ef4444;">*</span></label>
                                <select name="it_area" id="it_area_add" required class="form-select">
                                    <option selected disabled value="">Select Region</option>
                                    @foreach($it_area ?? [] as $area)
                                        <option value="{{ $area }}">{{ $area }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="it_personnel_add" class="form-label">Assigned Personnel</label>
                                <select name="it_personnel" id="it_personnel_add" class="form-select">
                                    <option selected disabled value="">Select Personnel</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="it_email_add" class="form-label">IT Email</label>
                                <input type="text" name="it_email" id="it_email_add" readonly class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="status_add" class="form-label">Status</label>
                                <input type="text" name="status" id="status_add" value="Pending" readonly class="form-input" style="color: #854d0e; font-weight: 700;">
                            </div>
                        </div>
                    </fieldset>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-gray" id="cancelAddModal">Cancel</button>
                        <button type="submit" class="btn btn-indigo">
                            <i class="fas fa-paper-plane"></i> Submit Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Re-Assign Modal --}}
        <div id="assignTicketModal" class="modal-overlay hidden">
            <div class="modal-box">
                <button id="closeAssignModal" class="close-btn" aria-label="Close">&times;</button>
                <h2 class="modal-title">Re-Assign Ticket</h2>
                
                <form id="assignForm" method="POST" action="{{ route('tickets.assign') }}">
                    @csrf
                    <input type="hidden" name="ticket_id" id="assignTicketId">

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="it_area_assign" class="form-label">Region <span style="color:#ef4444;">*</span></label>
                            <select name="it_area" id="it_area_assign" required class="form-select">
                                <option selected disabled value="">Select Region</option>
                                @foreach($it_area ?? [] as $area)
                                    <option value="{{ $area }}">{{ $area }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="assigned_to" class="form-label">Assign To <span style="color:#ef4444;">*</span></label>
                            <select name="assigned_to" id="assigned_to" required class="form-select">
                                <option selected disabled value="">Select Personnel</option>
                            </select>
                        </div>
                        <div class="form-group col-span-2">
                            <label for="assigned_it_email" class="form-label">Personnel Email</label>
                            <input type="text" name="assigned_it_email" id="assigned_it_email" readonly class="form-input">
                        </div>
                        <div class="form-group col-span-2">
                            <label for="assigned_at" class="form-label">Date Assigned</label>
                            <input type="text" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}" readonly class="form-input">
                            <input type="hidden" name="assigned_at" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('Y-m-d') }}">
                        </div>
                        <div class="form-group col-span-2">
                            <label for="assign_notes" class="form-label">Instructions / Notes</label>
                            <textarea name="notes" id="assign_notes" rows="3" class="form-input"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-gray" id="cancelAssignModal">Cancel</button>
                        <button type="submit" class="btn btn-yellow">
                            <i class="fas fa-user-plus"></i> Re-Assign
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Status Modal --}}
        <div id="editticketModal" class="modal-overlay hidden">
            <div class="modal-box">
                <button id="closeEditModal" class="close-btn" aria-label="Close">&times;</button>
                <h2 class="modal-title">Update Ticket Status</h2>
                
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="ticket_id" id="edit_ticket_id">

                    <div class="form-grid">
                        <div class="form-group col-span-2">
                            <label for="edit_status" class="form-label">Status <span style="color:#ef4444;">*</span></label>
                            <select name="status" id="edit_status" required class="form-select">
                                <option value="" disabled>Select status</option>
                                <option value="Pending">Pending</option>
                                <option value="Pending/Re-Assigned">Pending/Re-Assigned</option>
                                <option value="Resolved">Resolved</option>
                            </select>
                        </div>
                        <div class="form-group col-span-2">
                            <label class="form-label">Date Resolved</label>
                            <input type="text" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}" readonly class="form-input">
                            <input type="hidden" name="date_resolved" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('Y-m-d') }}">
                        </div>
                        <div class="form-group col-span-2">
                            <label for="action_taken" class="form-label">Action Taken <span style="color:#ef4444;">*</span></label>
                            <textarea name="action_taken" id="action_taken" rows="3" required class="form-input"></textarea>
                        </div>
                        <div class="form-group col-span-2">
                            <label for="edit_photo" class="form-label">Update Photo Evidence</label>
                            <input type="file" name="photo" id="edit_photo" accept="image/*" class="form-input" style="padding: 0.5rem 1rem;">
                            <div class="mt-2">
                                <img id="photo_preview" src="" alt="Uploaded Photo" class="thumb-img" style="display: none; height: 6rem; width: 6rem;">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-gray" id="cancelEditStatusModal">Cancel</button>
                        <button type="submit" class="btn btn-indigo">
                            <i class="fas fa-save"></i> Save Updates
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // Flash Messages
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{!! addslashes(session("success")) !!}',
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Notice!',
                    text: '{!! addslashes(session("error")) !!}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
            
            // === AUTO-RELOAD & COUNTDOWN ===
            const checkbox = document.getElementById('autoReloadCheckbox');
            const countdownDisplay = document.getElementById('countdown');
            let intervalId = null;
            let countdown = 60;

            if (checkbox) {
                const isChecked = localStorage.getItem('autoReload') === 'true';
                checkbox.checked = isChecked;

                if (isChecked) startAutoReload();

                checkbox.addEventListener('change', function () {
                    localStorage.setItem('autoReload', checkbox.checked);
                    if (checkbox.checked) {
                        startAutoReload();
                    } else {
                        stopAutoReload();
                    }
                });
            }

            function startAutoReload() {
                countdown = 60;
                updateCountdown();
                intervalId = setInterval(() => {
                    countdown--;
                    updateCountdown();
                    if (countdown <= 0) location.reload();
                }, 1000);
            }

            function stopAutoReload() {
                clearInterval(intervalId);
                countdown = 60;
                updateCountdown();
            }

            function updateCountdown() {
                if (countdownDisplay) countdownDisplay.textContent = countdown;
            }

            // ======= Shared Modal Functions =======
            const body = document.body;
            
            function openModal(modal) {
                modal.classList.remove('hidden');
                body.classList.add('overflow-hidden');
            }

            function closeModal(modal) {
                modal.classList.add('hidden');
                body.classList.remove('overflow-hidden');
            }

            const itMapping = @json($it_mapping ?? []);

            // ======= ADD TICKET MODAL =======
            const addModal = document.getElementById('ticketModal');
            if (addModal) {
                const addCloseBtn = addModal.querySelector('#closeModal');
                const addCancelBtn = addModal.querySelector('#cancelAddModal');
                const addOpenBtn = document.getElementById('openModal');

                if (addOpenBtn) addOpenBtn.addEventListener('click', () => openModal(addModal));
                
                const closeAddFunc = () => closeModal(addModal);
                if (addCloseBtn) addCloseBtn.addEventListener('click', closeAddFunc);
                if (addCancelBtn) addCancelBtn.addEventListener('click', closeAddFunc);
                addModal.addEventListener('click', e => { if (e.target === addModal) closeAddFunc(); });

                const regionSelectAdd = addModal.querySelector('#it_area_add');
                const personnelSelectAdd = addModal.querySelector('#it_personnel_add');
                const emailInputAdd = addModal.querySelector('#it_email_add');

                if (regionSelectAdd && personnelSelectAdd && emailInputAdd) {
                    regionSelectAdd.addEventListener('change', function () {
                        personnelSelectAdd.innerHTML = '<option disabled selected value="">Select Personnel</option>';
                        emailInputAdd.value = '';
                        (itMapping[this.value] || []).forEach(p => {
                            const opt = document.createElement('option');
                            opt.value = p.name;
                            opt.text = p.name;
                            personnelSelectAdd.appendChild(opt);
                        });
                    });
                    personnelSelectAdd.addEventListener('change', function () {
                        const p = itMapping[regionSelectAdd.value].find(x => x.name === this.value);
                        emailInputAdd.value = p ? p.email : '';
                    });
                }
            }

            // ======= ASSIGN TICKET MODAL =======
            const assignModal = document.getElementById('assignTicketModal');
            if (assignModal) {
                const closeAssignBtn = document.getElementById('closeAssignModal');
                const cancelAssignBtn = document.getElementById('cancelAssignModal');
                const regionSelectAssign = assignModal.querySelector('#it_area_assign');
                const assigneeSelect = assignModal.querySelector('#assigned_to');
                const assigneeEmail = assignModal.querySelector('#assigned_it_email');
                const assignForm = document.getElementById('assignForm');

                document.querySelectorAll('.open-assign-modal').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const ticketId = this.dataset.id;
                        const currentStatus = this.dataset.status;

                        if (currentStatus === 'Resolved') {
                            Swal.fire({ title: 'Ticket Locked', text: 'Ticket was already resolved. Re-assignment is not allowed.', icon: 'warning', confirmButtonColor: '#4f46e5' });
                            return;
                        } else if (currentStatus === 'Pending/Re-Assigned') {
                            Swal.fire({ title: 'Already Re-Assigned', text: 'Please follow up with the assigned personnel.', icon: 'info', confirmButtonColor: '#4f46e5' });
                            return;
                        }

                        document.getElementById('assignTicketId').value = ticketId;
                        regionSelectAssign.selectedIndex = 0;
                        assigneeSelect.innerHTML = '<option disabled selected value="">Select Personnel</option>';
                        assigneeEmail.value = '';
                        openModal(assignModal);
                    });
                });

                const closeAssignFunc = () => closeModal(assignModal);
                if (closeAssignBtn) closeAssignBtn.addEventListener('click', closeAssignFunc);
                if (cancelAssignBtn) cancelAssignBtn.addEventListener('click', closeAssignFunc);
                assignModal.addEventListener('click', e => { if (e.target === assignModal) closeAssignFunc(); });

                assignForm.addEventListener('submit', function (e) {
                    const currentStatus = this.dataset.status?.trim() || '';
                    if (currentStatus === 'Resolved') {
                        e.preventDefault();
                        Swal.fire({ title: 'Ticket Locked', text: 'You cannot assign a resolved ticket.', icon: 'error', confirmButtonColor: '#ef4444' });
                    }
                });

                if (regionSelectAssign) {
                    regionSelectAssign.addEventListener('change', function () {
                        assigneeSelect.innerHTML = '<option disabled selected value="">Select Personnel</option>';
                        assigneeEmail.value = '';
                        (itMapping[this.value] || []).forEach(p => {
                            const opt = document.createElement('option');
                            opt.value = p.name;
                            opt.text = p.name;
                            opt.setAttribute('data-email', p.email);
                            assigneeSelect.appendChild(opt);
                        });
                    });
                }

                if (assigneeSelect) {
                    assigneeSelect.addEventListener('change', function () {
                        const sel = this.options[this.selectedIndex];
                        assigneeEmail.value = sel.getAttribute('data-email') || '';
                    });
                }
            }

            // ======= EDIT TICKET MODAL =======
            const editModal = document.getElementById('editticketModal');
            if (editModal) {
                const editCloseBtn = document.getElementById('closeEditModal');
                const cancelEditBtn = document.getElementById('cancelEditStatusModal');
                const editForm = document.getElementById('editForm');
                const statusSelect = editModal.querySelector('#edit_status');
                const actionTakenField = editModal.querySelector('#action_taken');
                const photoPreview = editModal.querySelector('#photo_preview');

                const closeEditFunc = () => closeModal(editModal);
                if (editCloseBtn) editCloseBtn.addEventListener('click', closeEditFunc);
                if (cancelEditBtn) cancelEditBtn.addEventListener('click', closeEditFunc);
                editModal.addEventListener('click', e => { if (e.target === editModal) closeEditFunc(); });

                document.querySelectorAll('.open-edit-modal').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const ticketId = this.dataset.id;
                        const status = this.dataset.status;
                        const actionTaken = this.dataset.action_taken || '';
                        const photo = this.dataset.photo;

                        if (status === 'Resolved') {
                            Swal.fire({ title: 'Ticket Locked', text: 'This ticket is already resolved.', icon: 'info', confirmButtonColor: '#4f46e5' });
                            return;
                        }

                        editForm.action = `/tickets/${ticketId}`;
                        document.getElementById('edit_ticket_id').value = ticketId;
                        statusSelect.value = status;
                        actionTakenField.value = actionTaken;

                        if (photo && photoPreview) {
                            photoPreview.src = `/storage/${photo}`;
                            photoPreview.style.display = 'block';
                        } else if (photoPreview) {
                            photoPreview.style.display = 'none';
                        }

                        editForm.dataset.originalStatus = status;
                        openModal(editModal);
                    });
                });

                if (statusSelect) {
                    statusSelect.addEventListener('change', function () {
                        if (this.value === 'Pending/Re-Assigned') {
                            Swal.fire({ title: 'Reminder', text: 'You must re-assign the ticket to another personnel.', icon: 'info', confirmButtonColor: '#4f46e5' });
                        }
                    });
                }

                if (editForm) {
                    editForm.addEventListener('submit', function (e) {
                        const newStatus = statusSelect.value;
                        const originalStatus = this.dataset.originalStatus;

                        if (originalStatus === 'Pending' && newStatus === 'Pending') {
                            e.preventDefault();
                            Swal.fire({ title: 'Status Not Updated', text: 'Please update your status before submitting.', icon: 'warning', confirmButtonColor: '#4f46e5' });
                        } else if (originalStatus === 'Pending' && newStatus === 'Pending/Re-Assigned') {
                            e.preventDefault();
                            Swal.fire({ title: 'Assignment Needed', text: 'Assign the ticket to another Personnel before submitting.', icon: 'warning', confirmButtonColor: '#4f46e5' });
                        } else if (originalStatus === 'Pending/Re-Assigned' && (newStatus === 'Pending' || newStatus === 'Pending/Re-Assigned')) {
                            e.preventDefault();
                            Swal.fire({ title: 'Ticket Already Re-Assigned', text: 'Please follow up to the Re-Assigned Personnel.', icon: 'warning', confirmButtonColor: '#4f46e5' });
                        }
                    });
                }
            }

            // === DELETE CONFIRMATION ALERT ===
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.dataset.id;
                    Swal.fire({
                        title: 'Delete this Ticket?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Yes, delete',
                        cancelButtonText: 'Cancel'
                    }).then(res => {
                        if (res.isConfirmed) document.getElementById('delete-form-' + id).submit();
                    });
                });
            });
            
            // Allow closing modals with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === "Escape") {
                    if(addModal) closeModal(addModal);
                    if(assignModal) closeModal(assignModal);
                    if(editModal) closeModal(editModal);
                }
            });
        });
    </script>
</x-app-layout>