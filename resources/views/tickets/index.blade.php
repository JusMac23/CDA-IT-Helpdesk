<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Base Resets */
        * { box-sizing: border-box; }

        /* Main Container - Mobile First 100% Width */
        .content-panel { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1rem; width: 100%; box-sizing: border-box; }
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.5rem; font-weight: 900; color: #111827; margin-bottom: 0; margin-top: 0; }

        /* --- Action Container (Toolbar Layout) - Mobile First --- */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 0.75rem; margin-bottom: 1rem; }
        .action-left-group { display: flex; flex-direction: column; width: 100%; gap: 0.75rem; }

        /* Auto Reload Toggle */
        .auto-reload-label { display: flex; align-items: center; font-size: 0.8rem; color: #374151; cursor: pointer; width: 100%; justify-content: flex-start; padding: 0.25rem 0; font-weight: 500; white-space: nowrap; }
        .auto-reload-checkbox { margin-right: 0.4rem; cursor: pointer; width: 1rem; height: 1rem; accent-color: #4f46e5; }
        
        /* Action Forms (To allow buttons to stretch) */
        .action-form { margin: 0; width: 100%; }

        /* Buttons - Mobile First (Full Width default) */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 1.5rem; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 600; cursor: pointer; border: none; transition: background-color 0.2s, box-shadow 0.2s, transform 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05); width: 100%; box-sizing: border-box; text-decoration: none; white-space: nowrap; line-height: 1.5; min-height: 46px; }
        .btn i { margin-right: 0.5rem; }
        .btn h4 { margin: 0 0 0 0.5rem; font-size: 0.875rem; display: inline; }

        .btn-green { background-color: #16a34a; color: white; border: 1px solid #15803d; }
        .btn-green:hover { background-color: #15803d; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(22, 163, 74, 0.25); color: white; }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(22, 163, 74, 0.15); }
        
        .btn-blue { background-color: #2563eb; color: white; border: 1px solid #1d4ed8; }
        .btn-blue:hover { background-color: #1d4ed8; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(37, 99, 235, 0.25); color: white; }

        .btn-red { background-color: #dc2626; color: white; border: 1px solid #b91c1c; }
        .btn-red:hover { background-color: #b91c1c; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(220, 38, 38, 0.25); color: white; }
        
        .btn-indigo { background-color: #4f46e5; color: white; border: 1px solid #4338ca; }
        .btn-indigo:hover { background-color: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(79, 70, 229, 0.25); color: white; }

        .btn-gray { background-color: #e5e7eb; color: #374151; padding: 0.85rem 1.5rem; font-weight: 600; border-radius: 0.375rem; }
        .btn-gray:hover { background-color: #d1d5db; }

        /* --- Search Form Group --- */
        .search-form { display: flex; align-items: stretch; width: 100%; margin: 0; min-height: 44px; }
        .search-form .form-input { border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; margin: 0; width: 100%; transition: all 0.2s; position: relative; z-index: 1; padding: 0.5rem 1rem; border: 1px solid #d1d5db; outline: none; font-size: 0.875rem; line-height: 1.5; background-color: white; border-top-left-radius: 0.375rem; border-bottom-left-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .search-form .form-input:focus { z-index: 10; border-color: #4f46e5; box-shadow: inset 0 0 0 1px #4f46e5, 0 0 0 2px rgba(79,70,229,0.2); }
        .search-form .btn-indigo { border-top-left-radius: 0; border-bottom-left-radius: 0; margin: 0; z-index: 2; width: auto; padding: 0 1.25rem; display: flex; align-items: center; justify-content: center; }

        /* --- Filters Section - Mobile First --- */
        .filter-section { display: flex; flex-direction: column; align-items: stretch; width: 100%; gap: 1rem; margin-bottom: 1.5rem; background: #f9fafb; padding: 1rem; border-radius: 0.5rem; border: 1px solid #e5e7eb; box-sizing: border-box; }
        .form-group { display: flex; flex-direction: column; width: 100%; }
        .form-label { font-weight: 600; margin-bottom: 0.35rem; font-size: 0.875rem; color: #374151; }
        .form-input, .form-select { padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 1rem; width: 100%; box-sizing: border-box; outline: none; transition: border-color 0.2s, box-shadow 0.2s; background-color: white; min-height: 44px; }
        .form-input:focus, .form-select:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2); }
        textarea.form-input { resize: vertical; }
        
        .filter-container { display: flex; flex-direction: column; gap: 0.75rem; width: 100%; margin-top: 0.5rem; }

        /* --- Data Table - Horizontal Scroll on All Devices --- */
        .table-container { width: 100%; overflow-x: auto; background-color: #ffffff; border-radius: 0.5rem; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-top: 1.5rem; -webkit-overflow-scrolling: touch; display: block; }
        .data-table { width: 100%; min-width: 1200px; border-collapse: collapse; text-align: left; font-size: 0.875rem; }
        .data-table th { padding: 0.75rem 1rem; background-color: #f3f4f6; color: #374151; font-weight: 600; text-transform: uppercase; border-bottom: 2px solid #e5e7eb; white-space: nowrap; }
        .data-table td { padding: 0.75rem 1rem; border-bottom: 1px solid #e5e7eb; color: #1f2937; vertical-align: top; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: #f9fafb; }
        .text-center { text-align: center; }
        .text-truncate { max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block; }
        
        /* Thumbnails */
        .thumb-img { width: 3rem; height: 3rem; object-fit: cover; border-radius: 0.375rem; border: 1px solid #e5e7eb; transition: opacity 0.2s; }
        .thumb-img:hover { opacity: 0.8; }

        /* Status Badges */
        .badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-align: center; white-space: nowrap; }
        .status-resolved { background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; } 
        .status-pending { background-color: #fef9c3; color: #854d0e; border: 1px solid #fef08a; }
        .status-reassigned { background-color: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
        .status-default { background-color: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; }

        /* Action Links inside Table */
        .action-group { display: flex; flex-direction: column; gap: 0.5rem; min-width: 130px; }
        .action-link { display: flex; align-items: center; font-size: 0.75rem; font-weight: 500; font-family: inherit; cursor: pointer; padding: 0.35rem 0.75rem; border-radius: 0.375rem; transition: 0.2s; text-decoration: none; background: transparent; white-space: nowrap; width: 100%; text-align: left; box-sizing: border-box; justify-content: flex-start; border: 1px solid transparent; min-height: 32px; }
        .action-link i { margin-right: 0.35rem; width: 16px; text-align: center; flex-shrink: 0; }
        
        .link-blue { color: #2563eb; border: 1px solid #93c5fd; } 
        .link-blue:hover { background-color: #eff6ff; color: #1e40af; border-color: #60a5fa; }
        
        .link-yellow { color: #ca8a04; border: 1px solid #fde047; } 
        .link-yellow:hover { background-color: #fef9c3; color: #a16207; border-color: #facc15; }
        
        .link-indigo { color: #4f46e5; border: 1px solid #a5b4fc; } 
        .link-indigo:hover { background-color: #e0e7ff; color: #3730a3; border-color: #818cf8; }
        
        .link-red { color: #dc2626; border: 1px solid #fca5a5; } 
        .link-red:hover { background-color: #fef2f2; color: #b91c1c; border-color: #f87171; }

        /* Modal Base - Mobile First */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.6); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 1rem; box-sizing: border-box; }
        .modal-overlay.hidden { display: none !important; }
        .modal-box { position: relative; background-color: white; border-radius: 0.75rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); width: 100%; max-width: 48rem; max-height: 90vh; overflow-y: auto; padding: 1.5rem; box-sizing: border-box; }
        .close-btn { position:absolute; top:1.25rem; right:1.5rem; color:#9ca3af; font-size:2rem; background:none; border:none; cursor:pointer; transition:color 0.2s; line-height: 1; padding: 0; }
        .close-btn:hover { color:#374151; }
        .modal-title { font-size: 1.25rem; font-weight: 700; color: #111827; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 2px solid #e5e7eb; padding-bottom: 0.75rem; padding-right: 2rem; }
        
        .form-grid { display: grid; grid-template-columns: 1fr; gap: 1rem; }
        fieldset.form-fieldset { border: 1px solid #d1d5db; border-radius: 0.5rem; padding: 1rem 0.75rem; margin-bottom: 1rem; }
        fieldset.form-fieldset legend { font-weight: 600; color: #374151; padding: 0 0.5rem; font-size: 1rem; }
        .modal-footer { display: flex; flex-direction: column; padding-top: 1.25rem; border-top: 1px solid #e5e7eb; margin-top: 1.25rem; gap: 0.75rem; }
        .modal-footer .btn { width: 100%; }

        /* Pagination Fixes */
        .pagination-container { margin-top: 1.5rem; width: 100%; overflow-x: auto; padding-bottom: 0.5rem; }
        .pagination-container nav { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; }
        .pagination-container svg { width: 1.25rem !important; height: 1.25rem !important; display: inline-block; vertical-align: middle; } 
        .pagination-container a, .pagination-container span { display: inline-flex; align-items: center; justify-content: center; }
        .pagination-container p { margin: 0; font-size: 0.875rem; color: #6b7280; }

        /* --------------------------------------------------- */
        /* Mobile Specific Overrides                           */
        /* --------------------------------------------------- */
        @media (max-width: 640px) {
            .pagination-container > nav > div:first-child { display: flex; width: 100%; justify-content: space-between; }
            .pagination-container > nav > div:last-child { display: none; }
            .page-wrapper { padding: 0.5rem; }
            .content-panel { padding: 1rem; }
        }

        /* --------------------------------------------------- */
        /* Desktop & Tablet Overrides (min-width: 768px)       */
        /* --------------------------------------------------- */
        @media (min-width: 768px) {
            .content-panel { padding: 1.5rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            
            /* Align Actions inline */
            .action-container { flex-direction: row; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
            .action-left-group { flex-direction: row; width: auto; flex: 1; align-items: center; }
            .action-form { width: auto; }
            .search-form { max-width: 350px; min-width: 250px; width: auto; }
            .auto-reload-label { width: auto; padding: 0; justify-content: flex-start; margin-left: 0.5rem; }
            
            /* Un-stretch buttons on desktop */
            .btn { width: auto; padding: 0.5rem 1.5rem; }
            
            /* Filter Row */
            .filter-section { flex-direction: row; align-items: flex-end; width: auto; background: transparent; padding: 0; border: none; }
            .form-group { width: 200px; }
            .filter-container { flex-direction: row; width: auto; margin-top: 0; }
            .form-input, .form-select { padding: 0.5rem 0.75rem; min-height: 44px; }
            
            /* Modal formatting */
            .modal-box { padding: 2rem; }
            .modal-title { font-size: 1.5rem; }
            .form-grid { grid-template-columns: repeat(2, 1fr); }
            .col-span-2 { grid-column: span 2; }
            fieldset.form-fieldset { padding: 1.25rem; }
            .modal-footer { flex-direction: row; justify-content: flex-end; }
            .modal-footer .btn { width: auto; }
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
                                <i class="fas fa-list"></i> All Tickets <h4>({{ $ticketsCount ?? 0 }})</h4>
                            </button>
                        </form>

                        <form action="{{ route('tickets.index') }}" method="GET" class="action-form">
                            <input type="hidden" name="filter" value="overdue">
                            <button id="overdue" type="submit" class="btn btn-red">
                                <i class="fas fa-clock"></i> Overdue <h4>({{ $overdueCount ?? 0 }})</h4>
                            </button>
                        </form>

                        <label class="auto-reload-label">
                            <input type="checkbox" id="autoReloadCheckbox" class="auto-reload-checkbox">
                            <span>(<span id="countdown">60</span>s) Auto-Reload</span>
                        </label>
                    </div>

                    @can('search_ticket')
                    <form action="{{ route('tickets.index') }}" method="GET" class="search-form">
                        <input type="text" name="search_query" value="{{ request('search_query') }}" placeholder="Search tickets..." class="form-input">
                        <button type="submit" class="btn btn-indigo" aria-label="Search">
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
                                    <td class="text-center font-bold">{{ $ticket->ticket_number }}</td>
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
                                    <td>{{ $ticket->action_taken ?: 'N/A' }}</td>
                                    <td style="font-size: 0.8rem; color: #4b5563;">
                                        {{ \Carbon\Carbon::parse($ticket->date_created)->format('M d, Y h:i A') }}
                                    </td>
                                    <td style="font-size: 0.8rem; color: #4b5563;">
                                        @if($ticket->date_resolved)
                                            {{ \Carbon\Carbon::parse($ticket->date_resolved)->format('M d, Y h:i A') }}
                                        @else
                                            <span style="color: #dc2626; font-style: italic; font-weight: 600;">Not Resolved</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($ticket->photo)
                                            <a href="{{ asset('storage/' . $ticket->photo) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $ticket->photo) }}" alt="Photo" class="thumb-img">
                                            </a>
                                        @else
                                            <span style="color: #9ca3af; font-size: 0.75rem;">N/A</span>
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
                                    <td colspan="13" class="text-center" style="padding: 2rem; color: #6b7280;">
                                        No Ticket found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    {{ $tickets->links() ?? '' }}
                </div>
            </div>
        </div>

        {{-- Add Ticket Modal --}}
        <div id="ticketModal" class="modal-overlay hidden">
            <div class="modal-box transform scale-95 opacity-0 transition-all duration-300 ease-out">
                <button id="closeModal" class="close-btn" aria-label="Close">&times;</button>
                
                @if ($errors->any())
                    <div style="background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1rem;">
                        <h4 style="margin:0 0 0.5rem 0; font-weight: bold;"><i class="fas fa-exclamation-triangle"></i> Please fix the following error(s):</h4>
                        <ul style="margin:0; padding-left: 1.5rem; font-size: 0.875rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <h2 class="modal-title">Create Ticket</h2>

                <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="form-fieldset">
                        <legend>Client Information</legend>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="firstname" class="form-label">First Name <span style="color:#ef4444;">*</span></label>
                                <input type="text" name="firstname" id="firstname" placeholder="e.g., Juan" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="form-label">Last Name <span style="color:#ef4444;">*</span></label>
                                <input type="text" name="lastname" id="lastname" placeholder="e.g., Dela Cruz" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email <span style="color:#ef4444;">*</span></label>
                                <input type="email" name="email" id="email" placeholder="j_delacruz@cda.gov.ph" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="date_created" class="form-label">Date Created</label>
                                <input type="text" id="date_created_display" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}" readonly class="form-input" style="background-color: #f9fafb; cursor: not-allowed;">
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
                                <input type="file" name="photo" id="photo" class="form-input" style="padding: 0.4rem;">
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
                                <input type="text" name="it_email" id="it_email_add" readonly class="form-input" style="background-color: #f9fafb;">
                            </div>
                            <div class="form-group">
                                <label for="status_add" class="form-label">Status</label>
                                <input type="text" name="status" id="status_add" value="Pending" readonly class="form-input" style="background-color: #fef9c3; color: #854d0e; font-weight: 600;">
                            </div>
                        </div>
                    </fieldset>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-indigo">
                            <i class="fas fa-paper-plane"></i> Submit Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Re-Assign Modal --}}
        <div id="assignTicketModal" class="modal-overlay hidden">
            <div class="modal-box transform scale-95 opacity-0 transition-all duration-300 ease-out">
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
                        <div class="form-group">
                            <label for="assigned_it_email" class="form-label">Personnel Email</label>
                            <input type="text" name="assigned_it_email" id="assigned_it_email" readonly class="form-input" style="background-color: #f9fafb;">
                        </div>
                        <div class="form-group">
                            <label for="assigned_at" class="form-label">Date Assigned</label>
                            <input type="text" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}" readonly class="form-input" style="background-color: #f9fafb; cursor: not-allowed;">
                            <input type="hidden" name="assigned_at" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('Y-m-d') }}">
                        </div>
                        <div class="form-group col-span-2">
                            <label for="assign_notes" class="form-label">Instructions / Notes</label>
                            <textarea name="notes" id="assign_notes" rows="3" class="form-input"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-indigo">
                            <i class="fas fa-user-plus"></i> Assign
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div id="editticketModal" class="modal-overlay hidden">
            <div class="modal-box transform scale-95 opacity-0 transition-all duration-300 ease-out">
                <button id="closeEditModal" class="close-btn" aria-label="Close">&times;</button>
                <h2 class="modal-title">Update Ticket Status</h2>
                
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="ticket_id" id="edit_ticket_id">

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="edit_status" class="form-label">Status <span style="color:#ef4444;">*</span></label>
                            <select name="status" id="edit_status" required class="form-select">
                                <option value="" disabled>Select status</option>
                                <option value="Pending">Pending</option>
                                <option value="Pending/Re-Assigned">Pending/Re-Assigned</option>
                                <option value="Resolved">Resolved</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date Resolved</label>
                            <input type="text" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}" readonly class="form-input" style="background-color: #f9fafb; cursor: not-allowed;">
                            <input type="hidden" name="date_resolved" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('Y-m-d') }}">
                        </div>
                        <div class="form-group col-span-2">
                            <label for="action_taken" class="form-label">Action Taken <span style="color:#ef4444;">*</span></label>
                            <textarea name="action_taken" id="action_taken" rows="3" required class="form-input"></textarea>
                        </div>
                        <div class="form-group col-span-2">
                            <label for="edit_photo" class="form-label">Photo Evidence</label>
                            <input type="file" name="photo" id="edit_photo" accept="image/*" class="form-input" style="padding: 0.4rem;">
                            <div class="mt-2">
                                <img id="photo_preview" src="" alt="Uploaded Photo" class="thumb-img" style="display: none; height: 5rem; width: 5rem;">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-indigo">
                            <i class="fas fa-save"></i> Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const body = document.body;

            // Flash Messages
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{!! addslashes(session("success")) !!}',
                    timer: 2000,
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
            function openModal(modal, modalContent) {
                modal.classList.remove('hidden');
                body.classList.add('overflow-hidden');
                void modalContent.offsetWidth; // Trigger reflow
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }

            function closeModal(modal, modalContent) {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    body.classList.remove('overflow-hidden');
                }, 300);
            }

            const itMapping = @json($it_mapping ?? []);

            // ======= ADD TICKET MODAL =======
            const addModal = document.getElementById('ticketModal');
            if (addModal) {
                const addContent = addModal.querySelector('.modal-box');
                const addCloseBtn = addModal.querySelector('#closeModal');
                const addOpenBtn = document.getElementById('openModal');

                if (addOpenBtn) addOpenBtn.addEventListener('click', () => openModal(addModal, addContent));
                if (addCloseBtn) addCloseBtn.addEventListener('click', () => closeModal(addModal, addContent));
                addModal.addEventListener('click', e => { if (e.target === addModal) closeModal(addModal, addContent); });

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
                const assignContent = assignModal.querySelector('.modal-box');
                const closeAssignBtn = document.getElementById('closeAssignModal');
                const regionSelectAssign = assignModal.querySelector('#it_area_assign');
                const assigneeSelect = assignModal.querySelector('#assigned_to');
                const assigneeEmail = assignModal.querySelector('#assigned_it_email');
                const assignForm = document.getElementById('assignForm');

                document.querySelectorAll('.open-assign-modal').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const ticketId = this.dataset.id;
                        const currentStatus = this.dataset.status;

                        if (currentStatus === 'Resolved') {
                            Swal.fire({ title: 'Ticket Locked', text: 'Ticket was already resolved. Re-assignment is not allowed.', icon: 'warning', confirmButtonText: 'OK' });
                            return;
                        } else if (currentStatus === 'Pending/Re-Assigned') {
                            Swal.fire({ title: 'Ticket Already Re-Assigned', text: 'Please follow up with the re-assigned personnel.', icon: 'warning', confirmButtonText: 'OK' });
                            return;
                        }

                        document.getElementById('assignTicketId').value = ticketId;
                        regionSelectAssign.selectedIndex = 0;
                        assigneeSelect.innerHTML = '<option disabled selected value="">Select Personnel</option>';
                        assigneeEmail.value = '';
                        openModal(assignModal, assignContent);
                    });
                });

                if (closeAssignBtn) closeAssignBtn.addEventListener('click', () => closeModal(assignModal, assignContent));
                assignModal.addEventListener('click', e => { if (e.target === assignModal) closeAssignBtn.click(); });

                assignForm.addEventListener('submit', function (e) {
                    const currentStatus = this.dataset.status?.trim() || '';
                    if (currentStatus === 'Resolved') {
                        e.preventDefault();
                        Swal.fire({ title: 'Ticket Locked', text: 'You cannot assign a resolved ticket.', icon: 'error', confirmButtonText: 'OK' });
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
                const editContent = editModal.querySelector('.modal-box');
                const editCloseBtn = document.getElementById('closeEditModal');
                const editForm = document.getElementById('editForm');
                const statusSelect = editModal.querySelector('#edit_status');
                const actionTakenField = editModal.querySelector('#action_taken');
                const photoPreview = editModal.querySelector('#photo_preview');

                if (editCloseBtn) editCloseBtn.addEventListener('click', () => closeModal(editModal, editContent));
                editModal.addEventListener('click', e => { if (e.target === editModal) editCloseBtn.click(); });

                document.querySelectorAll('.open-edit-modal').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const ticketId = this.dataset.id;
                        const status = this.dataset.status;
                        const actionTaken = this.dataset.action_taken || '';
                        const photo = this.dataset.photo;

                        if (status === 'Resolved') {
                            Swal.fire({ title: 'Ticket Locked', text: 'This ticket is already resolved.', icon: 'info', confirmButtonText: 'OK' });
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
                        openModal(editModal, editContent);
                    });
                });

                if (statusSelect) {
                    statusSelect.addEventListener('change', function () {
                        if (this.value === 'Pending/Re-Assigned') {
                            Swal.fire({ title: 'Reminder', text: 'You must re-assign the ticket to another personnel.', icon: 'info', confirmButtonText: 'OK' });
                        }
                    });
                }

                if (editForm) {
                    editForm.addEventListener('submit', function (e) {
                        const newStatus = statusSelect.value;
                        const originalStatus = this.dataset.originalStatus;

                        if (originalStatus === 'Pending' && newStatus === 'Pending') {
                            e.preventDefault();
                            Swal.fire({ title: 'Status Not Updated', text: 'Please update your status before submitting.', icon: 'warning', confirmButtonText: 'OK' });
                        } else if (originalStatus === 'Pending' && newStatus === 'Pending/Re-Assigned') {
                            e.preventDefault();
                            Swal.fire({ title: 'Assignment Needed', text: 'Assign the ticket to another Personnel before submitting.', icon: 'warning', confirmButtonText: 'OK' });
                        } else if (originalStatus === 'Pending/Re-Assigned' && (newStatus === 'Pending' || newStatus === 'Pending/Re-Assigned')) {
                            e.preventDefault();
                            Swal.fire({ title: 'Ticket Already Re-Assigned', text: 'Please follow up to the Re-Assigned Personnel.', icon: 'warning', confirmButtonText: 'OK' });
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
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Delete'
                    }).then(res => {
                        if (res.isConfirmed) document.getElementById('delete-form-' + id).submit();
                    });
                });
            });
        });
    </script>
</x-app-layout>