<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Main Container */
        .content-panel { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; width: 100%; box-sizing: border-box; }
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; }
        .title { font-size: 1.5rem; font-weight: 900; color: #111827; margin-bottom: 0; margin-top: 0; }

        /* --- Action Container (Toolbar Layout) --- */
        .action-container { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }

        /* --- Search Form Group (Joined Input & Button) --- */
        .action-btn { display: flex; align-items: stretch; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .action-btn .form-input { border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; margin: 0; width: 100%; min-width: 250px; max-width: 350px; transition: all 0.2s; position: relative; z-index: 1; }
        .action-btn .form-input:focus { z-index: 10; border-color: #4f46e5; box-shadow: inset 0 0 0 1px #4f46e5, 0 0 0 2px rgba(79,70,229,0.2); }
        .action-btn .btn-indigo { border-top-left-radius: 0; border-bottom-left-radius: 0; margin: 0; padding: 0.5rem 1.25rem; z-index: 2; transition: background-color 0.2s; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 1rem; border: 1px solid transparent; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.2s; text-decoration: none; box-sizing: border-box; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .btn i { margin-right: 0.5rem; }
        .btn-green { background-color: #16a34a; color: #ffffff; }
        .btn-green:hover { background-color: #15803d; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(22, 163, 74, 0.25); }
        .btn-red { color: #ffffff;  background-color: #dc2626; border-color: #fecaca; }
        .btn-blue { background-color: #2563eb; color: #ffffff; }
        .btn-indigo { background-color: #4f46e5; color: white; }
        .btn-indigo:hover { background-color: #4338ca; }
        .btn-gray { background-color: #e5e7eb; color: #374151; }
        .btn-gray:hover { background-color: #d1d5db; }

        /* Auto Reload Toggle */
        .auto-reload-label { display: flex; align-items: center; font-size: 0.875rem; color: #374151; cursor: pointer; font-weight: 500; }
        .auto-reload-checkbox { margin-right: 0.5rem; cursor: pointer; width: 1rem; height: 1rem; accent-color: #4f46e5; }

        /* Filters Section */
        .filter-section { display: flex; flex-direction: row; flex-wrap: wrap; align-items: flex-end; gap: 16px; width: 60%; margin-bottom: 0; }
        .form-group { display: flex; flex-direction: column; flex: 1; min-width: 150px; }
        .form-label { font-weight: 600; margin-bottom: 4px; font-size: 0.875rem; color: #374151; }
        .form-input, .form-select { padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem; width: 100%; box-sizing: border-box; background-color: white; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        .form-input:focus, .form-select:focus { border-color: #4f46e5; box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2); }
        textarea.form-input { resize: vertical; }

        /* Container for the Apply and Report buttons */
        .filter-container { display: flex; gap: 8px; flex-shrink: 0; }

        /* Data Table */
        .table-container { overflow-x: auto; background-color: #ffffff; border-radius: 0.5rem; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-top: 1.5rem; }
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
        .action-group { display: flex; flex-direction: column; gap: 0.25rem; }
        .action-link { display: flex; align-items: center; font-size: 0.75rem; font-weight: 600; font-family: inherit; cursor: pointer; padding: 0.35rem 0.5rem; border-radius: 0.25rem; transition: 0.2s; text-decoration: none; border: 1px solid transparent; background: transparent; white-space: nowrap; width: 100%; text-align: left; }
        .action-link i { margin-right: 0.35rem; width: 14px; text-align: center; }
        
        .link-blue { color: #2563eb; background-color: #eff6ff; border-color: #bfdbfe; } .link-blue:hover { background-color: #dbeafe; color: #1e40af; }
        .link-yellow { color: #ca8a04; background-color: #fefce8; border-color: #fef08a; } .link-yellow:hover { background-color: #fef9c3; color: #854d0e; }
        .link-indigo { color: #4f46e5; background-color: #eef2ff; border-color: #c7d2fe; } .link-indigo:hover { background-color: #e0e7ff; color: #3730a3; }
        .link-red { color: #dc2626; background-color: #fef2f2; border-color: #fecaca; } .link-red:hover { background-color: #fee2e2; color: #991b1b; }

        /* Modal Base */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.6); display: flex; align-items: center; justify-content: center; z-index: 50; padding: 1rem; }
        .modal-overlay.hidden { display: none !important; }
        .modal-box { position: relative; background-color: white; border-radius: 0.75rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); width: 100%; max-width: 48rem; max-height: 90vh; overflow-y: auto; padding: 2rem; box-sizing: border-box; }
        
        /* Fixed Modal Close Button */
        .close-btn { position:absolute; top:1.5rem; right:1.5rem; color:#9ca3af; font-size:2rem; background:none; border:none; cursor:pointer; transition:color 0.2s; line-height: 1; padding: 0; }
        .close-btn:hover { color:#374151; }
        .modal-title { font-size: 1.5rem; font-weight: 700; color: #111827; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 2px solid #e5e7eb; padding-bottom: 0.75rem; padding-right: 2rem; }
        
        /* Modal Grids */
        .form-grid { display: grid; grid-template-columns: 1fr; gap: 1rem; }
        @media (min-width: 640px) {
            .form-grid { grid-template-columns: repeat(2, 1fr); }
            .col-span-2 { grid-column: span 2; }
        }
        fieldset.form-fieldset { border: 1px solid #d1d5db; border-radius: 0.5rem; padding: 1.25rem; margin-bottom: 1rem; }
        fieldset.form-fieldset legend { font-weight: 600; color: #374151; padding: 0 0.5rem; font-size: 1rem; }

        .modal-footer { display: flex; justify-content: flex-end; padding-top: 1.25rem; border-top: 1px solid #e5e7eb; margin-top: 1.25rem; gap: 0.75rem; }

        /* Pagination Fixes */
        .pagination-container { margin-top: 1.5rem; font-size: 0.875rem; color: #374151; }
        .pagination-container nav { display: flex; flex-direction: column; gap: 1rem; align-items: center; }
        @media (min-width: 640px) { .pagination-container nav { flex-direction: row; justify-content: space-between; } }
        .pagination-container svg { width: 1.25rem; height: 1.25rem; display: inline-block; } 
        .pagination-container p { margin: 0; color: #4b5563; }
        .pagination-container span.relative.inline-flex, 
        .pagination-container a.relative.inline-flex { display: inline-flex; align-items: center; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; text-decoration: none; color: #374151; background: #fff; margin-left: -1px; }
        .pagination-container a.relative.inline-flex:hover { background-color: #f3f4f6; }
        .pagination-container span[aria-current="page"] span { background-color: #eff6ff; color: #4f46e5; border-color: #4f46e5; z-index: 1; }
        .pagination-container span[aria-disabled="true"] span { opacity: 0.5; cursor: not-allowed; }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .content-panel { padding: 1rem; }
            .action-container { flex-direction: column; align-items: stretch; }
            .filter-section { flex-direction: column; align-items: stretch; width: 100%;}
            .filter-container { flex-direction: column; margin-top: 8px; }
            .btn { width: 100%; justify-content: center; }
        }
    </style>

    <div id="main-content" class="page-wrapper">
        <div id="ticketsContent">
            <div class="content-panel">

                <div class="header-flex">
                    <h3 class="title">All Tickets</h3>
                </div>

                <div class="action-container">
                    <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">

                        @can('create_ticket')
                        <button id="openModal" class="btn btn-green">
                            <i class="fas fa-plus"></i> Add Ticket
                        </button>
                        @endcan

                        <form action="{{ route('tickets.index') }}" method="GET" style="margin: 0;">
                            <input type="hidden" name="filter" value="allTickets">
                            <button id="allTickets" type="submit" class="btn btn-blue">
                                <i class="fas fa-count"></i> All Tickets <h4 style="margin-left: 0.5rem;">({{ $ticketsCount }})</h4>
                            </button>
                        </form>

                        <form action="{{ route('tickets.index') }}" method="GET" style="margin: 0;">
                            <input type="hidden" name="filter" value="overdue">
                            <button id="overdue" type="submit" class="btn btn-red">
                                <i class="fas fa-clock"></i> Overdue Tickets <h4 style="margin-left: 0.5rem;">({{ $overdueCount }})</h4>
                            </button>
                        </form>

                        <label class="auto-reload-label">
                            <input type="checkbox" id="autoReloadCheckbox" class="auto-reload-checkbox">
                            <span>(<span id="countdown">60</span>s) Auto-Reload</span>
                        </label>
                    </div>

                    @can('search_ticket')
                    <form action="{{ route('tickets.index') }}" method="GET" class="action-btn">
                        <input type="text" name="search_query" value="{{ request('search_query') }}" placeholder="Search..." class="form-input">
                        <button type="submit" class="btn btn-indigo">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    @endcan
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <form action="{{ route('tickets.index') }}" method="GET" class="filter-section">
                        <div class="form-group">
                            <label for="it_area" class="form-label">Filter by Region</label>
                            <select name="it_area" id="it_area" class="form-select">
                                <option value="">All Regions</option>
                                @if($it_area && count($it_area))
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
                </div>

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
                            @forelse ($tickets as $ticket)
                                <tr>
                                    <td class="font-bold">{{ $ticket->ticket_number }}</td>
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
                                            $badgeClass = 'status-default';
                                            if ($status === 'Resolved') $badgeClass = 'status-resolved';
                                            elseif ($status === 'Pending') $badgeClass = 'status-pending';
                                            elseif ($status === 'Pending/Re-Assigned') $badgeClass = 'status-reassigned';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $ticket->status }}
                                        </span>
                                    </td>

                                    <td>
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
                                                <form id="delete-form-{{ $ticket->ticket_id }}" action="{{ route('tickets.destroy', $ticket->ticket_id) }}" method="POST" style="margin: 0;">
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
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>

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
                                    @foreach ($sections_divisions as $division)
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
                                    @foreach ($technical_services as $service)
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
                                    @foreach($it_area as $area)
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
                                @foreach($it_area as $area)
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

            const itMapping = @json($it_mapping);

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